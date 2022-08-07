<?php

namespace App\DataTables;

use App\Models\Specialization;

/**
 * Class SpecializationDataTable
 */
class SpecializationDataTable
{
    /**
     * @return Specialization
     */
    public function get()
    {
        /** @var Specialization $query */
        $query = Specialization::query()->select('specializations.*');

        return $query;
    }
}
