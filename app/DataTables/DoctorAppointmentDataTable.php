<?php

namespace App\DataTables;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AppointmentDataTable
 */
class DoctorAppointmentDataTable
{
    /**
     * @param  array  $input
     *
     * @return Builder
     */
    public function get($input = [])
    {

        $query = Appointment::with(['patient.user', 'user', 'services']);

        $query->when(isset($input['status']) && $input['status'] != Appointment::ALL_STATUS,
            function (Builder $q) use ($input) {
                if ($input['status'] == Appointment::ALL) {
                    $q->get();
                } else {
                    $q->where('status', '=', $input['status']);
                }
            });

        $query->when(isset($input['payment_type']) && $input['payment_type'] != Appointment::PAYMENT_TYPE,
            function (Builder $q) use ($input) {
                if ($input['payment_type'] != Appointment::ALL_PAYMENT) {
                    $q->where('payment_type', '=', $input['payment_type']);
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

        $query->where('doctor_id', getLoginUser()->doctor->id);

        return $query->get();
    }
}
