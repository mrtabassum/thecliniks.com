<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Transaction;
use Flash;
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;

class PaypalController extends Controller
{
    public function onBoard(Request $request)
    {
        $appointment = Appointment::whereId($request->appointmentId)->first();
        
        $clientId = config('payments.paypal.client_id');
        $clientSecret = config('payments.paypal.client_secret');

        $mode = config('payments.paypal.mode');


        if ($mode == 'live') {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        } else {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }
        
        $client = new PayPalHttpClient($environment);

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent"              => "CAPTURE",
            "purchase_units"      => [
                [
                    "reference_id" => $appointment->id,
                    "amount"       => [
                        "value"         => $appointment->payable_amount,
                        "currency_code" => getCurrencyCode(),
                    ],
                ],
            ],
            "application_context" => [
                "cancel_url" => route('paypal.failed'),
                "return_url" => route('paypal.success'),
            ],
        ];

        $order = $client->execute($request);

        return response()->json($order);
    }

    public function failed()
    {
        Flash::error('Appointment created successfully and Payment is not completed.');

        if (! getLogInUser()) {
            return redirect(route('medicalAppointment'));
        }

        if (getLogInUser()->hasRole('patient')) {
            return redirect(route('patients.appointments.index'));
        }

        return redirect(route('appointments.index'));
    }

    public function success(Request $request)
    {
        $clientId = config('payments.paypal.client_id');
        $clientSecret = config('payments.paypal.client_secret');
        $mode = config('payments.paypal.mode');
        
        if ($mode == 'live') {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        } else {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }
        $client = new PayPalHttpClient($environment);

        // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
// $response->result->id gives the orderId of the order created above
        $request = new OrdersCaptureRequest($request->get('token'));
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            $appointmentID = $response->result->purchase_units[0]->reference_id;
            $transactionID = $response->result->id;
            $appointment = Appointment::whereId($appointmentID)->first();
            $patient = Patient::with('user')->whereId($appointment->patient_id)->first();
            
            $transaction = [
                'user_id'        => $patient->user->id,
                'transaction_id' => $transactionID,
                'appointment_id' => $appointment['appointment_unique_id'],
                'amount'         => intval($appointment['payable_amount']),
                'type'           => Appointment::PAYPAL,
                'meta'           => json_encode($response),
            ];

            Transaction::create($transaction);

            $appointment->update([
                'payment_method' => Appointment::PAYPAL,
                'payment_type'   => Appointment::PAID,
            ]);

            Flash::success('Appointment created successfully and Payment is completed.');
            
            Notification::create([
                'title'   => Notification::APPOINTMENT_PAYMENT_DONE_PATIENT_MSG,
                'type'    => Notification::PAYMENT_DONE,
                'user_id' => $patient->user->id,
            ]);

            if (! getLogInUser()) {
                return redirect(route('medicalAppointment'));
            }

            if (getLogInUser()->hasRole('patient')) {
                return redirect(route('patients.appointments.index'));
            }

            return redirect(route('appointments.index'));
                        
            
        }catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }
}
