<?php

namespace App\DataTables;

use App\Models\Visit;

/**
 * Class PatientVisitDataTable
 */
class PatientVisitDataTable
{
    /**
     * @return Visit
     */
    public function get()
    {
        /** @var Visit $query */
        $query = Visit::with(['visitDoctor.user','visitDoctor.reviews'])->where('patient_id', getLoginUser()->patient->id);

        return $query->select('visits.*')->get();
    }
}
