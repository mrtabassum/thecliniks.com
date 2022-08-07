<?php

namespace App\Http\Controllers\Front;

use App\DataTables\FaqDataTable;
use App\Models\Faq;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Repositories\FaqRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Datatables;

class FaqController extends AppBaseController
{
    /** @var  FaqRepository */
    private $faqRepository;

    public function __construct(FaqRepository $faqRepo)
    {
        $this->faqRepository = $faqRepo;
    }

    /**
     * Display a listing of the Faq.
     *
     * @param  Request  $request
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new FaqDataTable())->get())->make(true);
        }

        return view('fronts.faqs.index');
    }

    /**
     * Show the form for creating a new Faq.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('fronts.faqs.create');
    }

    /**
     * Store a newly created Faq in storage.
     *
     * @param  CreateFaqRequest  $request
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function store(CreateFaqRequest $request)
    {
        $input = $request->all();

        $faq = $this->faqRepository->create($input);

        Flash::success('FAQ created successfully.');

        return redirect(route('faqs.index'));
    }

    /**
     * Show the form for editing the specified Faq.
     *
     * @param  Faq  $faq
     * @return Application|Factory|View
     */
    public function edit(Faq $faq)
    {
        return view('fronts.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified Faq in storage.
     *
     * @param  UpdateFaqRequest  $request
     * @param  Faq  $faq
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {

        $faq = $this->faqRepository->update($request->all(), $faq->id);

        Flash::success('FAQ updated successfully.');

        return redirect(route('faqs.index'));
    }

    /**
     * Remove the specified Faq from storage.
     *
     * @param  Faq  $faq
     * @return Response
     */
    public function destroy(Faq $faq)
    {
        if ($faq->is_default) {
            return $this->sendError('This FAQ used somewhere else.');
        }

        $faq->delete();

        return $this->sendSuccess('FAQ deleted successfully.');
    }
}
