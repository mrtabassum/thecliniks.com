<?php

namespace App\DataTables;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AppointmentDataTable
 */
class AppointmentDataTable
{
    /**
     * @return Appointment
     */
    public function get($input = [])
    {
        /** @var Appointment $query */
        $query = Appointment::with([
            'doctor.user', 'patient.user', 'services', 'transaction','doctor.reviews'
        ])->select('appointments.*');

        $query->when(isset($input['status']) && $input['status'] != Appointment::ALL_STATUS,
            function (Builder $q) use ($input) {
                if ($input['status'] != Appointment::ALL) {
                    $q->where('status', '=', $input['status']);
                }
            });

        $query->when(isset($input['payment_type']) && $input['payment_type'] != Appointment::PAYMENT_TYPE,
            function (Builder $q) use ($input) {
                if ($input['payment_type'] != Appointment::ALL_PAYMENT) {
                    $q->where('payment_type', '=', $input['payment_type']);
                }
            });

        $query->when(isset($input['payment_status']) && $input['payment_status'] != Appointment::PAYMENT_TYPE_ALL,
            function (Builder $q) use ($input) {
                if ($input['payment_status'] != Appointment::ALL_PAYMENT) {
                    if ($input['payment_status'] == Appointment::PENDING) {
                        $q->has('transaction', '=', null);
                    } elseif ($input['payment_status'] == Appointment::PAID) {
                        $q->has('transaction', '!=', null);
                    }
                }
            });

        $query->when(
            isset($input['filter_date']) && ! empty($input['filter_date']),
            function (Builder $q) use ($input) {
                $timeEntryDate = explode(' - ', $input['filter_date']);
                $startDate = Carbon::parse($timeEntryDate[0])->format('Y-m-d');
                $endDate = Carbon::parse($timeEntryDate[1])->format('Y-m-d');
                $q->whereBetween('date', [$startDate, $endDate]);
            }
        );

        if (getLoginUser()->hasRole('patient')) {
            $query->where('patient_id', getLoginUser()->patient->id);
        }

        return $query->get();
    }
}
