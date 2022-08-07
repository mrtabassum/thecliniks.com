<?php

use App\Models\City;
use App\Models\Currency;
use App\Models\DoctorSession;
use App\Models\Notification;
use App\Models\PaymentGateway;
use App\Models\Setting;
use App\Models\State;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;

/**
 *
 * @return Authenticatable|null
 */
function getLogInUser()
{
    return Auth::user();
}

/**
 * @return mixed
 */
function getAppName()
{
    static $appName;

    if (empty($appName)) {
        $appName = Setting::where('key', '=', 'clinic_name')->first()->value;
    }

    return $appName;
}

/**
 * @return mixed
 */
function getAppLogo()
{
    static $appLogo;

    if (empty($appLogo)) {
        $appLogo = Setting::where('key', '=', 'logo')->first()->value;
    }

    return $appLogo;
}

/**
 * @return mixed
 */
function getAppFavicon()
{
    static $appFavicon;

    if (empty($appFavicon)) {
        $appFavicon = Setting::where('key', '=', 'favicon')->first()->value;
    }

    return $appFavicon;
}

/**
 *
 * @return int
 */
function getLogInUserId()
{
    return Auth::user()->id;
}

/**
 * @param $countryId
 *
 * @return mixed
 */
function getStates($countryId)
{
    return State::where('country_id', $countryId)->toBase()->pluck('name', 'id')->toArray();
}

/**
 * @param $stateId
 *
 * @return mixed
 */
function getCities($stateId)
{
    return City::where('state_id', $stateId)->pluck('name', 'id')->toArray();
}

/**
 * @return string
 */
function getDashboardURL()
{
    if (Auth::user()->hasRole('clinic_admin')) {
        return 'admin/dashboard';
    } else {
        if (Auth::user()->hasRole('doctor')) {
            return 'doctors/dashboard';
        } else {
            if (Auth::user()->hasRole('patient')) {
                return 'patients/dashboard';
            }
        }
    }

    return RouteServiceProvider::HOME;
}

/**
 * @return string
 */
function getDoctorSessionURL()
{
    if (Auth::user()->hasRole('clinic_admin')) {
        return 'admin/doctor-sessions';
    } elseif (Auth::user()->hasRole('doctor')) {
        return 'doctors/doctor-sessions';
    } elseif (Auth::user()->hasRole('patient')) {
        return 'patients/doctor-sessions';
    }

    return RouteServiceProvider::HOME;
}

/**
 * @param $doctor_id
 */
function getDoctorSessionTime($doctor_id)
{
    $doctorSession = DoctorSession::whereDoctorId($doctor_id)->get();
}

function getSlotByGap($startTime,$endTime)
{
    $period = new CarbonPeriod($startTime, "15 minutes", $endTime); // for create use 24 hours format later change format 
    $slots = [];
    foreach ($period as $item) {
        $slots[$item->format("h:i A")] = $item->format("h:i A");
    }

    return $slots;
}

function getSchedulesTimingSlot()
{
    $period = new CarbonPeriod('00:00', "15 minutes", '24:00'); // for create use 24 hours format later change format 
    $slots = [];
    foreach ($period as $item) {
        $slots[$item->format("h:i A")] = $item->format("h:i A");
    }

    return $slots;
}

/**
 * @param $index
 *
 *
 * @return string
 */
function getBadgeColor($index)
{
    $colors = [
        'primary',
        'danger',
        'success',
        'info',
        'warning',
        'dark',
    ];

    $index = $index % 6;

    return $colors[$index];
}

/**
 *
 * @return string
 */
function getLoginDoctorSessionUrl(): string
{
    return DoctorSession::whereDoctorId(getLogInUser()->doctor->id)->exists() ? route('doctors.doctor.schedule.edit') : route('doctors.doctor-sessions.create');
}

/**
 *
 * @return string
 */
function doctorSessionActiveUrl(): string
{
    return DoctorSession::whereDoctorId(getLogInUser()->doctor->id)->exists() ? 'doctors/doctor-schedule-edit*' : 'doctors/doctor-sessions/create*';
}

/**
 * @param $index
 *
 *
 * @return string
 */
function getStatusBadgeColor($index)
{
    $colors = [
        'danger',
        'primary',
        'success',
        'warning',
    ];

    $index = $index % 4;

    return $colors[$index];
}

/**
 * @param $index
 *
 *
 * @return string
 */
function getStatusColor($index)
{
    $colors = [
        '#F46387',
        '#399EF7',
        '#50CD89',
        '#FAC702',
    ];

    $index = $index % 4;

    return $colors[$index];
}

/**
 * @param $index
 *
 *
 * @return string
 */
function getStatusClassName($status)
{
    $classNames = [
        'bg-status-canceled',
        'bg-status-booked',
        'bg-status-checkIn',
        'bg-status-checkOut',
    ];

    $index = $status % 4;

    return $classNames[$index];
}

/**
 * @param $key
 *
 * @return mixed
 */
function getSettingValue($key)
{
    return Setting::where('key', $key)->value('value');
}

/**
 * @param $key
 *
 * @return mixed
 */
function setEmailLowerCase($email)
{
    return strtolower($email);
}

/**
 *
 * @return string[]
 */
function getUserLanguages()
{
    $language = User::LANGUAGES;
    asort($language);

    return $language;
}

/**
 *
 * @return mixed
 */
function getCurrencyIcon()
{
    $currencyId = Setting::where('key', 'currency')->value('value');
    $currency = Currency::whereId($currencyId)->first();
    $currencyIcon = $currency->currency_icon ?? '$';

    return $currencyIcon;
}

function setStripeApiKey()
{
    Stripe::setApiKey(config('services.stripe.secret_key'));
}

/**
 * @return HigherOrderBuilderProxy|mixed|string
 */
function getCurrencyCode()
{
    $currencyId = Setting::where('key', 'currency')->value('value');
    $currencyCode = Currency::whereId($currencyId)->first();

    return $currencyCode->currency_code;
}

function version()
{
    $composerFile = file_get_contents('../composer.json');
    $composerData = json_decode($composerFile, true);
    $currentVersion = $composerData['version'];


    return $currentVersion;
}

if (! function_exists('getNotification')) {
    function getNotification()
    {
        return Notification::whereReadAt(null)->where('user_id',
            getLogInUserId())->orderByDesc('created_at')->get();
    }
}

function getNotificationIcon($notificationFor)
{
    switch ($notificationFor) {
        case $notificationFor == Notification::CHECKOUT:
            return 'fas fa-check-square fs-4 text-warning';
        case $notificationFor == Notification::PAYMENT_DONE:
            return 'fas fa-money-bill-wave fs-4 text-success';
        case $notificationFor == Notification::BOOKED:
            return 'fas fa-calendar-alt fs-4 text-primary';
        case $notificationFor == Notification::CANCELED:
            return 'fas fa-calendar-times text-danger fs-4';
        case $notificationFor == Notification::REVIEW:
            return 'fas fa-star text-warning fs-4';
        case $notificationFor == Notification::LIVE_CONSULTATION:
            return 'fas fa-video text-primary fs-4';
    }
}

/**
 * @return mixed|null
 */
function checkLanguageSession()
{
    if (Session::has('languageName')) {
        return Session::get('languageName');
    }

    return 'en';
}

/**
 * @return mixed|null
 */
function getCurrentLanguageName()
{
    return User::LANGUAGES[checkLanguageSession()];
}

function getMonth()
{
    $months = array(
        1  => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep',
        10 => 'Oct', 11 => 'Nov', 12 => 'Dec',
    );

    return $months;
}

/**
 *
 * @return string[]
 */
function getAllPaymentStatus()
{
    $paymentGateway = \App\Models\Appointment::PAYMENT_METHOD;
    $selectedPaymentGateway = $selectedPaymentGateways = PaymentGateway::pluck('payment_gateway')->toArray();

    return array_intersect($paymentGateway, $selectedPaymentGateway);
}

/**
 *
 * @return string[]
 */
function getPaymentGateway()
{
    $paymentGateway = \App\Models\Appointment::PAYMENT_GATEWAY;
    $selectedPaymentGateway = $selectedPaymentGateways = PaymentGateway::pluck('payment_gateway')->toArray();

    return array_intersect($paymentGateway, $selectedPaymentGateway);
}
