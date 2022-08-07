<?php

namespace App\DataTables;

use App\Models\Country;

/**
 * Class CountryDataTable
 */
class CountryDataTable
{
    /**
     * @return Country
     */
    public function get()
    {
        /** @var Country $query */
        $query = Country::query()->select('countries.*');

        return $query;
    }
}
