<?php

namespace App\DataTables;

use App\Models\State;

/**
 * Class StateDataTable
 */
class StateDataTable
{
    /**
     * @return State
     */
    public function get()
    {
        /** @var State $query */
        $query = State::with('country')->select('states.*');

        return $query;
    }
}
