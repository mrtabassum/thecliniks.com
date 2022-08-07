<?php

namespace App\Http\Controllers\Front;

use Codesoclock\Alfapay\Alfapay;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;



use App\Models\ClinicSchedule;
use App\Models\Doctor;
use App\Models\DoctorSession;
use App\Models\Faq;
use App\Models\FrontPatientTestimonial;
use App\Models\Patient;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function medical()
    {
        $doctors = Doctor::with('user', 'specializations')->whereHas('user', function (Builder $query) {
            $query->where('status', User::ACTIVE);
        })->latest()->take(10)->get();
        $sliders = Slider::with('media')->first();
        $frontMedicalServices = Service::with('media')->whereStatus(Service::ACTIVE)->latest()->get();
        $frontPatientTestimonials = FrontPatientTestimonial::with('media')->latest()->take(6)->get();
        $appointmentDoctors = Doctor::with('user')->get()->where('user.status', User::ACTIVE)->pluck('user.full_name',
            'id');
        $aboutExperience = Setting::where('key', 'about_experience')->first();

        return view('fronts.medicals.index',
            compact('doctors', 'sliders', 'frontMedicalServices', 'frontPatientTestimonials',
                'appointmentDoctors', 'aboutExperience'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalAboutUs()
    {
        $data = [];
        $data['doctorsCount'] = Doctor::with('user')->get()->where('user.status', true)->count();
        $data['patientsCount'] = Patient::get()->count();
        $data['servicesCount'] = Service::whereStatus(true)->get()->count();
        $data['specializationsCount'] = Specialization::get()->count();
        $clinicSchedules = ClinicSchedule::all();
        $setting = Setting::where('key','about_us_image')->first();
        $frontPatientTestimonials = FrontPatientTestimonial::with('media')->latest()->take(6)->get();
        $doctors = Doctor::with('user', 'appointments','specializations')->whereHas('user',function (Builder $query){
            $query->where('status',User::ACTIVE);
        })->withCount('appointments')->orderBy('appointments_count', 'desc')->take(3)->get();

        return view('fronts.medical_about_us',
            compact('doctors', 'data', 'setting', 'clinicSchedules', 'frontPatientTestimonials'));
    }

      /**
     * @return Application|Factory|View
     */
    public function medicalLabc()
    {
        $data = [];
        $data['doctorsCount'] = Doctor::with('user')->get()->where('user.status', true)->count();
        $data['patientsCount'] = Patient::get()->count();
        $data['servicesCount'] = Service::whereStatus(true)->get()->count();
        $data['specializationsCount'] = Specialization::get()->count();
        $clinicSchedules = ClinicSchedule::all();
        $setting = Setting::where('key','about_us_image')->first();
        $frontPatientTestimonials = FrontPatientTestimonial::with('media')->latest()->take(6)->get();
        $doctors = Doctor::with('user', 'appointments','specializations')->whereHas('user',function (Builder $query){
            $query->where('status',User::ACTIVE);
        })->withCount('appointments')->orderBy('appointments_count', 'desc')->take(3)->get();

        return view('fronts.medical_lab_c',
            compact('doctors', 'data', 'setting', 'clinicSchedules', 'frontPatientTestimonials'));
    }


       /**
     * @return Application|Factory|View
     */
    public function medicalNijjat()
    {
        $data = [];
        $data['doctorsCount'] = Doctor::with('user')->get()->where('user.status', true)->count();
        $data['patientsCount'] = Patient::get()->count();
        $data['servicesCount'] = Service::whereStatus(true)->get()->count();
        $data['specializationsCount'] = Specialization::get()->count();
        $clinicSchedules = ClinicSchedule::all();
        $setting = Setting::where('key','about_us_image')->first();
        $frontPatientTestimonials = FrontPatientTestimonial::with('media')->latest()->take(6)->get();
        $doctors = Doctor::with('user', 'appointments','specializations')->whereHas('user',function (Builder $query){
            $query->where('status',User::ACTIVE);
        })->withCount('appointments')->orderBy('appointments_count', 'desc')->take(3)->get();

        return view('fronts.medical_nijjat',
            compact('doctors', 'data', 'setting', 'clinicSchedules', 'frontPatientTestimonials'));
    }


      /**
     * @return Application|Factory|View
     */
    public function medicalBlood()
    {
        $data = [];
        $data['doctorsCount'] = Doctor::with('user')->get()->where('user.status', true)->count();
        $data['patientsCount'] = Patient::get()->count();
        $data['servicesCount'] = Service::whereStatus(true)->get()->count();
        $data['specializationsCount'] = Specialization::get()->count();
        $clinicSchedules = ClinicSchedule::all();
        $setting = Setting::where('key','about_us_image')->first();
        $frontPatientTestimonials = FrontPatientTestimonial::with('media')->latest()->take(6)->get();
        $doctors = Doctor::with('user', 'appointments','specializations')->whereHas('user',function (Builder $query){
            $query->where('status',User::ACTIVE);
        })->withCount('appointments')->orderBy('appointments_count', 'desc')->take(3)->get();

        return view('fronts.medical_blood',
            compact('doctors', 'data', 'setting', 'clinicSchedules', 'frontPatientTestimonials'));
    }




    /**
     * @return Application|Factory|View
     */
    public function medicalServices()
    {
        $data = [];
        $serviceCategories = ServiceCategory::with('activatedServices')->withCount('services')->get();
        $setting = Setting::pluck('value', 'key')->toArray();
        $services = Service::with('media')->whereStatus(Service::ACTIVE)->latest()->get();
        $data['doctorsCount'] = Doctor::with('user')->get()->where('user.status', true)->count();
        $data['patientsCount'] = Patient::get()->count();
        $data['servicesCount'] = Service::whereStatus(true)->get()->count();
        $data['specializationsCount'] = Specialization::get()->count();

        return view('fronts.medical_services', compact('serviceCategories','setting','services','data'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalAppointment()
    {
        $faqs = Faq::latest()->get();
        $appointmentDoctors = Doctor::with('user')->whereIn('id',
            DoctorSession::pluck('doctor_id')->toArray())->get()->where('user.status',
            User::ACTIVE)->pluck('user.full_name', 'id');

        return view('fronts.medical_appointment', compact('faqs', 'appointmentDoctors'));
    }



     /**
     * @return Application|Factory|View
     */
    public function medicalServicesPayment()
    {
        //Genrate Random Number For order number or transaction 

        // $orderNo = rand(1,17866120);

        // $alfa = new Alfapay();

        // $response = $alfa->setTransactionReferenceNumber($orderNo)->getToken();
     

        // //
        // if($response != null && $response->success == 'true'){

        //     $authToken = $response->AuthToken;
        //     $returnURL = $response->ReturnURL;    

        //     return view('fronts.medical_check_out',compact ('orderNo','authToken','returnURL'));
        // }else{

        //     abort(403, 'Erorr: Toekn Not Genrated');
        // }


        
        $url = "https://payments.bankalfalah.com/HS/HS/HS";

        $HS_TransactionReferenceNumber= rand(1,17866120);

        $Key1= "VaMq3CyVjQw27xvY"; //change Key1
        $Key2= "2416340772155132"; //change Key2
        $HS_ChannelId="1001"; //change Channel ID
        $HS_MerchantId="18714" ; //change Merchant ID
        $HS_StoreId="024124" ; //change Store ID
        $HS_IsRedirectionRequest  = 0;
        $HS_ReturnURL="https://thecliniks.com/"; ////change Return URL
        $HS_MerchantHash="LkqC6nt+PxowqA3IOdQFaMulkwAkUt0uK3rmHktpP0GhVY3FnUDy5r14dAFEjD/BLAvgGPcPSRY="; //change Merchat Hash
        $HS_MerchantUsername="ojygab" ; //change Merchant Username
        $HS_MerchantPassword="q9HM1kX1gjZvFzk4yqF7CA=="; //Merchant Password
        
      

        $cipher="aes-128-cbc";

    
        

    
        // $AuthToken = $input['AuthToken'];
        // $Currency = $input ['Currency'];
        // $TransactionTypeId=$input['TransactionTypeId'];
        // $TransactionReferenceNumber = $input ['TransactionReferenceNumber'];
        // $TransactionAmount  = $input ['TransactionAmount'];
        

        // $alfa = new Alfapay();

        // $alfa->setTransactionReferenceNumber($TransactionReferenceNumber);
        // $alfa->setAuthToken($AuthToken);
        // $alfa->setTransactionType($TransactionTypeId);
        // $alfa->setCurrency($Currency);
        // $alfa->setAmount($TransactionAmount);

        // $hashRequest = $alfa->sendTransactionRequest();
    
        
   
         
    
                
                
        $mapString = 
            "HS_ChannelId=$HS_ChannelId" 
        . "&HS_IsRedirectionRequest=$HS_IsRedirectionRequest" 
        . "&HS_MerchantId=$HS_MerchantId" 
        . "&HS_StoreId=$HS_StoreId" 
        . "&HS_ReturnURL=$HS_ReturnURL"
        . "&HS_MerchantHash=$HS_MerchantHash"
        . "&HS_MerchantUsername=$HS_MerchantUsername"
        . "&HS_MerchantPassword=$HS_MerchantPassword"
        . "&HS_TransactionReferenceNumber=$HS_TransactionReferenceNumber";
        

            $cipher_text = openssl_encrypt($mapString, $cipher, $Key1,   OPENSSL_RAW_DATA , $Key2);
            $hashRequest = base64_encode($cipher_text);
    
    
            //The data you want to send via POST
            $fields = [
                "HS_ChannelId"=>$HS_ChannelId,
                "HS_IsRedirectionRequest"=>$HS_IsRedirectionRequest,
                "HS_MerchantId"=> $HS_MerchantId,
                "HS_StoreId"=> $HS_StoreId,
                "HS_ReturnURL"=> $HS_ReturnURL,
                "HS_MerchantHash"=> $HS_MerchantHash,
                "HS_MerchantUsername"=> $HS_MerchantUsername,
                "HS_MerchantPassword"=> $HS_MerchantPassword,
                "HS_TransactionReferenceNumber"=> $HS_TransactionReferenceNumber,
                "HS_RequestHash"=> $hashRequest
            ];
            
            $fields_string = http_build_query($fields);
            
            //open connection
            $ch = curl_init();
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            //So that curl_exec returns the contents of the cURL; rather than echoing it
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
            //execute post
            $result = curl_exec($ch);
            
            $handshake =  json_decode($result);
        
            $AuthToken = $handshake->AuthToken;


            return view('fronts.medical_check_out',compact ('HS_TransactionReferenceNumber','AuthToken'));
        
    }


    /**
     * @return Application|Factory|View
     */
    public function medicalDoctors()
    {
        $doctors = Doctor::with('specializations', 'user')->whereHas('user', function (Builder $query) {
            $query->where('status', User::ACTIVE);
        })->latest()->take(9)->get();

        return view('fronts.medical_doctors', compact('doctors'));
    }

    /**
     * @return Application|Factory|View
     */
    public function medicalContact()
    {
        $clinicSchedules = ClinicSchedule::all();

        return view('fronts.medical_contact', compact('clinicSchedules'));
    }

    /**
     * @return Application|Factory|View
     */
    public function termsCondition()
    {
        $termConditions = Setting::pluck('value', 'key')->toArray();

        return view('fronts.terms_conditions', compact('termConditions'));
    }

    /**
     * @return Application|Factory|View
     */
    public function privacyPolicy()
    {
        $privacyPolicy = Setting::pluck('value', 'key')->toArray();

        return view('fronts.privacy_policy', compact('privacyPolicy'));
    }

    /**
     *
     * @return Application|Factory|View
     */
    public function faq()
    {
        $faqs = Faq::latest()->get();

        return view('fronts.faq', compact('faqs'));
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function changeLanguage(Request $request)
    {
        Session::put('languageName', $request->input('languageName'));

        return $this->sendSuccess('Language changed successfully');
    }
}


