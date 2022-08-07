<?php

namespace App\DataTables;

use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class EnquiryDataTable
 */
class EnquiryDataTable
{
    /**
     * @return Enquiry
     */
    public function get($input = [])
    {
        /** @var Enquiry $query */
        $query = Enquiry::query();
        $query->when(isset($input['status']) && $input['status'] != Enquiry::VIEW_NAME,
            function (Builder $q) use ($input) {
                if ($input['status'] == Enquiry::ALL) {
                    $q->get();
                } else {
                    $q->where('view', $input['status']);
                }
            });

        return $query->get();
    }
}
