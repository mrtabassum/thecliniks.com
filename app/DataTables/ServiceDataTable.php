<?php

namespace App\DataTables;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ServiceDataTable
 */
class ServiceDataTable
{
    /**
     * @return Service
     */
    public function get($input = [])
    {
        /** @var Service $query */
        $query = Service::with('serviceCategory');
        $query->when(isset($input['status']) && $input['status'] != Service::STATUS,
            function (Builder $q) use ($input) {
                if ($input['status'] == Service::ALL) {
                    $q->get();
                } else {
                    $q->where('status', $input['status']);
                }
            });
        
        return $query->get();
    }
}
