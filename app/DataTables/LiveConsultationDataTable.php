<?php

namespace App\DataTables;

use App\Models\IpdPatientDepartment;
use App\Models\LiveConsultation;
use App\Models\OpdPatientDepartment;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CityDataTable
 */
class LiveConsultationDataTable
{
    /**
     * @return LiveConsultation
     */
    public function get($input = [])
    {
        /** @var LiveConsultation $query */
        $query = LiveConsultation::with([
            'patient.user', 'doctor.user', 'user',
        ]);

        $query->when(isset($input['status']) && $input['status'] != LiveConsultation::status,
            function (Builder $q) use ($input) {
                $q->where('status', $input['status']);
            });
//
        if (getLogInUser()->hasRole('patient')) {
            $query->where('patient_id', getLoginUser()->patient->id)->select('live_consultations.*');
        }
        if (getLogInUser()->hasRole('doctor')) {
            $query->where('doctor_id', getLoginUser()->doctor->id)->select('live_consultations.*');
        }

        $query->select('live_consultations.*');

        return $query;
    }
}
