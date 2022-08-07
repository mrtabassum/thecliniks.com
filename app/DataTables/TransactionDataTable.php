<?php

namespace App\DataTables;

use App\Models\Patient;
use App\Models\Transaction;

/**
 * Class PatientDataTable
 */
class TransactionDataTable
{
    /**
     * @return Patient
     */
    public function get()
    {
        /** @var Patient $query */
        $query = Transaction::with(['user.patient']);

        if (getLogInUser()->hasRole('patient')) {
            $query->where('user_id', '=', getLogInUserId());
        }

        return $query->get();
    }
}
