<?php

namespace App\DataTables;

use App\Models\DoctorSession;
use Illuminate\Support\Facades\Auth;

/**
 * Class DoctorSessionDataTable
 */
class DoctorSessionDataTable
{
    /**
     * @return DoctorSession
     */
    public function get()
    {
        /** @var DoctorSession $query */
        $query = DoctorSession::with(['doctor.user','doctor.reviews']);

        if (getLoginUser()->hasRole('doctor')) {
            $query->where('doctor_id', getLoginUser()->doctor->id);
        }

        return $query->select('doctor_sessions.*')->get();
    }
}
