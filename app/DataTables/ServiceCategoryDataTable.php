<?php

namespace App\DataTables;

use App\Models\ServiceCategory;

/**
 * Class ServiceCategoryDataTable
 */
class ServiceCategoryDataTable
{
    /**
     * @return ServiceCategory
     */
    public function get()
    {
        /** @var ServiceCategory $query */
        $query = ServiceCategory::with('services')->withCount('services')->get();

        return $query;
    }
}
