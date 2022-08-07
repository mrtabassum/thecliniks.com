<?php

namespace App\DataTables;

use App\Models\FrontPatientTestimonial;

/**
 * Class FrontPatientTestimonialDataTable
 */
class FrontPatientTestimonialDataTable
{
    /**
     * @return FrontPatientTestimonial
     */
    public function get()
    {
        /** @var FrontPatientTestimonial $query */
        $query = FrontPatientTestimonial::query()->with('media')->select('front_patient_testimonials.*');

        return $query;
    }
}
