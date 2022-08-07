<?php

namespace App\Http\Controllers;

use App\DataTables\CountryDataTable;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Repositories\CountryRepository;
use Flash;
use Illuminate\Routing\Redirector;
use Response;
use Datatables;

class CountryController extends AppBaseController
{
    /** @var  CountryRepository */
    private $countryRepository;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;
    }

    /**
     * Display a listing of the Country.
     *
     * @param  Request  $request
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CountryDataTable())->get())->make(true);
        }

        return view('countries.index');
    }

    /**
     * Store a newly created Country in storage.
     *
     * @param  CreateCountryRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateCountryRequest $request)
    {
        $input = $request->all();

        $country = $this->countryRepository->create($input);

        return $this->sendSuccess('Country created successfully.');
    }

    /**
     * Show the form for editing the specified Country.
     *
     * @param  Country  $country
     * @return JsonResponse
     */
    public function edit(Country $country)
    {
        return $this->sendResponse($country, 'Country retrieved successfully.');
    }

    /**
     * Update the specified Country in storage.
     *
     * @param  UpdateCountryRequest  $request
     * @param  Country  $country
     * @return JsonResponse
     */

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $input = $request->all();
        $input['short_code'] = strtoupper($input['short_code']);

        $this->countryRepository->update($input, $country->id);

        return $this->sendSuccess('Country updated successfully.');
    }

    /**
     * @param  Country  $country
     *
     * @return JsonResponse
     */
    public function destroy(Country $country)
    {
        $checkRecord = Address::whereCountryId($country->id)->exists();
        if ($checkRecord) {
            return $this->sendError('Country used somewhere else.');
        }

        $country->delete();

        return $this->sendSuccess('Country deleted successfully.');
    }
}
