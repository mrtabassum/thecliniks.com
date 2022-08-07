<?php

namespace App\Repositories;

use App;
use App\Models\Doctor;

//use App\Models\IpdPatientDepartment;
use App\Models\LiveConsultation;
use App\Models\Notification;

//use App\Models\OpdPatientDepartment;
use App\Models\Patient;
use App\Models\User;

//use App\Models\UserZoomCredential;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class LiveConsultationRepository
 */
class LiveConsultationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'doctor_id',
        'patient_id',
        'consultation_title',
        'consultation_date',
        'consultation_duration_minutes',
        'type',
        'type_number',
        'description',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LiveConsultation::class;
    }

    /**
     * @param $input
     *
     * @return Collection
     */
    public function getTypeNumber($input)
    {
//        if ($input['consultation_type'] == LiveConsultation::OPD) {
//            return OpdPatientDepartment::where('patient_id', $input['patient_id'])->pluck('opd_number', 'id');
//        }
//
//        return IpdPatientDepartment::where('patient_id', $input['patient_id'])->pluck('ipd_number', 'id');
    }

    /**
     * @param  array  $input
     *
     * @throws BindingResolutionException
     *
     * @return bool
     */
    public function store($input)
    {
        /** @var ZoomRepository $zoomRepo */
        $zoomRepo = App::makeWith(ZoomRepository::class, ['createdBy' => getLogInUserId()]);

        try {
            $input['created_by'] = getLogInUserId();
            $startTime = $input['consultation_date'];
            $input['consultation_date'] = Carbon::parse($startTime)->format('Y-m-d H:i:s');
            $zoom = $zoomRepo->create($input);
            $input['password'] = $zoom['data']['password'];
            $input['meeting_id'] = $zoom['data']['id'];
            $input['meta'] = $zoom['data'];
            $input['status'] = LiveConsultation::STATUS_AWAITED;

            $zoomModel = LiveConsultation::create($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     *
     * @param  LiveConsultation  $liveConsultation
     *
     * @return bool
     */
    public function edit($input, $liveConsultation)
    {
        /** @var ZoomRepository $zoomRepo */
        $zoomRepo = App::make(ZoomRepository::class, ['createdBy' => $liveConsultation->created_by]);

        try {
            $zoomRepo->update($liveConsultation->meeting_id, $input);
            $zoom = $zoomRepo->get($liveConsultation->meeting_id, ['meeting_owner' => $liveConsultation->created_by]);
            $input['password'] = $zoom['data']['password'];
            $input['meta'] = $zoom['data'];
            $input['created_by'] = getLogInUserId();
            $input['created_by'] = $liveConsultation->created_by != getLogInUserId() ? $liveConsultation->created_by : getLogInUserId();
            $startTime = $input['consultation_date'];
            $input['consultation_date'] = Carbon::parse($startTime)->format('Y-m-d H:i:s');

            $zoomModel = $liveConsultation->update($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     *
     * @return mixed
     */
    public function createUserZoom($input)
    {
//        try {
//            UserZoomCredential::updateOrCreate([
//                'user_id' => getLogInUserId(),
//            ], [
//                'user_id'         => getLogInUserId(),
//                'zoom_api_key'    => $input['zoom_api_key'],
//                'zoom_api_secret' => $input['zoom_api_secret'],
//            ]);
//
//            return true;
//        } catch (Exception $e) {
//            throw new UnprocessableEntityHttpException($e->getMessage());
//        }
    }

    /**
     * @param  array  $input
     */
    public function createNotification($input = [])
    {
        try {
            $patient = Patient::with('user')->where('id', $input['patient_id'])->first();
            $doctor = Doctor::with('user')->where('id', $input['doctor_id'])->first();

            $patientNotification = Notification::create([
                'title'   => 'Your live consultation has been created by '.$doctor->user->full_name.'.',
                'type'    => Notification::LIVE_CONSULTATION,
                'user_id' => $patient->user->id,
            ]);

            $doctorNotification = Notification::create([
                'title'   => $patient->user->full_name.' live consultation has been booked.',
                'type'    => Notification::LIVE_CONSULTATION,
                'user_id' => $doctor->user->id,
            ]);

        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
