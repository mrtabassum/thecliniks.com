<?php

namespace App\DataTables;

use App\Models\Visit;

/**
 * Class EncounterDataTable
 */
class VisitDataTable
{
    /**
     * @return Visit
     */
    public function get()
    {
        /** @var Visit $query */
        $query = Visit::with(['visitDoctor.user', 'visitPatient.user','visitDoctor.reviews']);

        if (getLoginUser()->hasRole('doctor')) {
            $query->where('doctor_id', getLoginUser()->doctor->id);
        }

        return $query->select('visits.*')->get();
    }
}
