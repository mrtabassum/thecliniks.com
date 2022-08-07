<?php

namespace App\DataTable;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserDataTable
 */
class UserDataTable
{
    /**
     * @return Builder[]|Collection
     */
    public function get($input = [])
    {
        /** @var Doctor $query */
        $query = Doctor::with(['user', 'specializations','reviews']);
        $query->when(isset($input['status']) && $input['status'] != User::STATUS,
            function (Builder $q) use ($input) {
                if ($input['status'] == User::ALL) {
                    $q->get();
                } else {
                    $q->whereHas('user', function (Builder $builder) use ($input) {
                        $builder->where('status', $input['status']);
                    });
                }
            });

        return $query->get();
    }

    /**
     * @param $doctorId
     *
     * @return mixed
     */
    public function getAppointment($input = [])
    {
        $todayDate = Carbon::now()->format('Y-m-d');

        $query = Appointment::with(['patient.user']);

        $query->when(isset($input['status']) && $input['status'] != Appointment::ALL_STATUS,
            function (Builder $q) use ($input) {
                if ($input['status'] == Appointment::ALL) {
                    $q->where('doctor_id', '=', $input['doctorId']);
                } else {
                    $q->where('status', '=', $input['status']);
                    $q->where('doctor_id', '=', $input['doctorId']);
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

        return $query->get();
    }
}

