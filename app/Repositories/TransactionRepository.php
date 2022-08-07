<?php

namespace App\Repositories;

use App\Models\Appointment;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Transaction;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoleRepository
 * @package App\Repositories
 * @version August 5, 2021, 10:43 am UTC
 */
class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Transaction::class;
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function show($id)
    {
        $transaction['data'] = Transaction::with('user', 'appointment.doctor.user')->whereId($id)->first();

        return $transaction;
    }
}
