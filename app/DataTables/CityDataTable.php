<?php

namespace App\DataTables;

use App\Models\City;

/**
 * Class CityDataTable
 */
class CityDataTable
{
    /**
     * @return City
     */
    public function get()
    {
        /** @var City $query */
        $query = City::with('state')->select('cities.*');

        return $query;
    }
}
