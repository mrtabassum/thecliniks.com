<?php

namespace App\DataTables;

use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PatientDataTable
 */
class PatientDataTable
{
    /**
     * @return Patient
     */
    public function get()
    {
        /** @var Patient $query */
        $query = Patient::with(['user', 'appointments'])->withCount('appointments')->get();

        return $query;
    }

    /**
     * @param  array  $input
     *
     *
     * @return mixed
     */
    public function getAppointment($input = [])
    {
        $query = Appointment::with(['doctor.user','doctor.reviews']);

        $query->when(isset($input['status']) && $input['status'] != Appointment::STATUS,
            function (Builder $q) use ($input) {
                if ($input['status'] == Appointment::ALL) {
                    $q->where('patient_id', '=', $input['patientId']);
                } else {
                    $q->where('status', '=', $input['status']);
                    $q->where('patient_id', '=', $input['patientId']);
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

        if (getLogInUser()->hasRole('doctor')) {
            $doctorId = getLoginUser()->doctor->id;
            $query->whereDoctorId($doctorId);
        }

        return $query->get();
    }
}
