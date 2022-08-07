<?php

namespace App\DataTables;

use App\Models\Currency;

/**
 * Class CurrencyDataTable
 */
class CurrencyDataTable
{
    /**
     * @return Currency
     */
    public function get()
    {
        /** @var Currency $query */
        $query = Currency::query()->select('currencies.*');

        return $query;
    }
}
