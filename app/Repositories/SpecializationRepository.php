<?php

namespace App\Repositories;

use App\Models\Specialization;
use App\Repositories\BaseRepository;

/**
 * Class SpecializationRepository
 * @package App\Repositories
 * @version August 2, 2021, 10:19 am UTC
 */
class SpecializationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return Specialization::class;
    }
}
