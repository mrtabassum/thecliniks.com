<?php

namespace App\Http\Controllers;

use App\Models\ClinicSchedule;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClinicScheduleController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $clinicSchedules = ClinicSchedule::all();

        return view('clinic_schedule.index', compact('clinicSchedules'));
    }

    /**
     * Store a newly created ClinicSchedule in storage.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if (isset($input['checked_week_days'])) {
            $oldWeekDays = ClinicSchedule::pluck('day_of_week')->toArray();
            foreach (array_diff($oldWeekDays, $input['checked_week_days']) as $dayOfWeek) {
                ClinicSchedule::whereDayOfWeek($dayOfWeek)->delete();
                DB::table('session_week_days')->where('day_of_week', $dayOfWeek)->delete();
            }

            foreach ($input['checked_week_days'] as $day) {
                $startTime = $input['startTimes'][$day];
                $endTime = $input['endTimes'][$day];
                if (strtotime($startTime) > strtotime($endTime)) {
                    return $this->sendError(ClinicSchedule::WEEKDAY[$day].' day start time is invalid');
                }
                ClinicSchedule::updateOrCreate(['day_of_week' => $day],
                    ['start_time' => $startTime, 'end_time' => $endTime]);
            }

            return $this->sendSuccess('Clinic Schedule saved successfully.');
        }

        ClinicSchedule::query()->delete();
        DB::table('session_week_days')->delete();

        return $this->sendSuccess('Clinic Schedule saved successfully.');
    }

    /**
     * Store a newly created ClinicSchedule in storage.
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function checkRecord(Request $request)
    {
        $input = $request->all();
        $message = 'Some doctors have scheduled their days in given unchecked days, so are you sure you want to perform this operation?';
        if (isset($input['checked_week_days'])) {
            $unCheckedDay = array_diff(array_keys(ClinicSchedule::WEEKDAY), $input['checked_week_days']);
            $checkDayOfWeek = DB::table('session_week_days')->whereIn('day_of_week', $unCheckedDay)->exists();

            if ($checkDayOfWeek) {
                return $this->sendError($message);
            } else {
                return $this->sendSuccess('');
            }
        }

        $checkDayOfWeek = DB::table('session_week_days')->exists();
        if ($checkDayOfWeek) {
            return $this->sendError($message);
        }

        return $this->sendResponse('checkDayOfWeek', 'Data Retrieved Successfully.');
    }

    /**
     * Remove the specified ClinicSchedule from storage.
     *
     * @param  ClinicSchedule  $clinicSchedule
     * @return JsonResponse
     */
    public function destroy(ClinicSchedule $clinicSchedule): JsonResponse
    {
        $clinicSchedule->delete();

        return $this->sendSuccess('ClinicSchedule deleted successfully.');
    }
}
