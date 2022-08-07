<?php

namespace App\DataTables;

use App\Models\Faq;

/**
 * Class FaqDataTable
 */
class FaqDataTable
{
    /**
     * @return Faq
     */
    public function get()
    {
        /** @var Faq $query */
        $query = Faq::query()->select('faqs.*');

        return $query;
    }
}
