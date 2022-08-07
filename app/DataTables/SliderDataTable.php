<?php

namespace App\DataTables;

use App\Models\Slider;

/**
 * Class StaffDataTable
 */
class SliderDataTable
{
    /**
     * @return Slider
     */
    public function get()
    {
        /** @var Slider $query */
        $query = Slider::with('media')->select('sliders.*');

        return $query;
    }
}
