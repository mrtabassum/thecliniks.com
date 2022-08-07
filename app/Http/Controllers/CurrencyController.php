<?php

namespace App\Http\Controllers;

use App\DataTables\CurrencyDataTable;
use App\Models\Address;
use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Repositories\CurrencyRepository;
use Flash;
use Response;
use Datatables;

class CurrencyController extends AppBaseController
{
    /** @var  CurrencyRepository */
    private $currencyRepository;

    public function __construct(CurrencyRepository $currencyRepo)
    {
        $this->currencyRepository = $currencyRepo;
    }

    /**
     * Display a listing of the Currency.
     *
     * @param  Request  $request
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CurrencyDataTable())->get())->make(true);
        }

        return view('currencies.index');
    }

    /**
     * Show the form for creating a new Currency.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('currencies.create');
    }

    /**
     * Store a newly created Currency in storage.
     *
     * @param  CreateCurrencyRequest  $request
     *
     * @return Response
     */
    public function store(CreateCurrencyRequest $request)
    {
        $input = $request->all();
        $this->currencyRepository->store($input);

        return $this->sendSuccess('Currency created successfully.');
    }

    /**
     * @param  Currency  $currency
     *
     *
     * @return mixed
     */
    public function edit(Currency $currency)
    {
        return $this->sendResponse($currency, 'Currency retrieved successfully.');
    }

    /**
     * Update the specified Currency in storage.
     *
     * @param  UpdateCurrencyRequest  $request
     * @param  Currency  $currency
     * @return JsonResponse
     */
    public function update(UpdateCurrencyRequest $request, Currency $currency)
    {
        $input = $request->all();
        $this->currencyRepository->update($input, $currency->id);

        return $this->sendSuccess('Currency updated successfully.');
    }

    /**
     * Remove the specified Currency from storage.
     *
     * @param  Currency  $currency
     * @return JsonResponse
     */
    public function destroy(Currency $currency)
    {
        $checkRecord = Setting::where('key','currency')->first()->value;
        
        if($checkRecord == $currency->id){
            return $this->sendError('Currency used somewhere else.');
        }
        $currency->delete();

        return $this->sendSuccess('Currency deleted successfully.');
    }
}
