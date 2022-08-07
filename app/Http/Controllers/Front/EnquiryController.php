<?php

namespace App\Http\Controllers\Front;

use App\DataTables\EnquiryDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateEnquiryRequest;
use App\Mail\EnquiryMails;
use App\Models\Enquiry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use DataTables;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class EnquiryController extends AppBaseController
{
    /**
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new EnquiryDataTable())->get($request->only('status')))->make('true');
        }
        $status = Enquiry::VIEW_NAME;

        return view('fronts.enquiries.index',compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEnquiryRequest  $request
     * @return void
     */
    public function store(CreateEnquiryRequest $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();
            $input['email'] = setEmailLowerCase($input['email']);
            Enquiry::create($input);
            $input['appName'] = getAppName();

            Mail::to($input['email'])
                ->send(new EnquiryMails('emails.enquiry.enquiry', 'Enquiry Sent Successfully', $input));

            DB::commit();

            return $this->sendSuccess('Message Send Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

    }

    /**
     *
     * @return Application|Factory|View
     */
    public function show(Enquiry $enquiry)
    {
        $enquiry->update(['view' => isset($enquiry->view) ?? true]);

        return view('fronts.enquiries.show', compact('enquiry'));
    }

    /**
     * @param  Enquiry  $enquiry
     *
     * @return mixed
     */
    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return $this->sendSuccess('Enquiry deleted successfully.');
    }
}
