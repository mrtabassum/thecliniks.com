<?php

namespace App\Http\Controllers;

use App\DataTables\CityDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCityRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\State;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCityRequest;
use App\Repositories\CityRepository;
use Flash;
use Response;
use Datatables;

class CityController extends AppBaseController
{
    /** @var  CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
    }

    /**
     * Display a listing of the City.
     *
     * @param  Request  $request
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CityDataTable())->get())->make(true);
        }

        $states = State::orderBy('name','ASC')->pluck('name', 'id');

        return view('cities.index', compact('states'));
    }

    /**
     * Store a newly created City in storage.
     *
     * @param  Requests\CreateCityRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateCityRequest $request)
    {
        $input = $request->all();
        $city = $this->cityRepository->create($input);

        return $this->sendSuccess('City created successfully.');
    }

    /**
     * Show the form for editing the specified City.
     *
     * @param  City  $city
     * @return JsonResponse
     */
    public function edit(City $city)
    {
        return $this->sendResponse($city, 'City retrieved successfully');
    }

    /**
     * Update the specified City in storage.
     *
     * @param  UpdateCityRequest  $request
     * @param  City  $city
     * @return JsonResponse
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $input = $request->all();
        $this->cityRepository->update($input, $city->id);

        return $this->sendSuccess('City updated successfully.');
    }

    /**
     * @param  City  $city
     *
     * @return JsonResponse
     */
    public function destroy(City $city)
    {
        $checkRecord = Address::whereCityId($city->id)->exists();
        
        if ($checkRecord) {
            return $this->sendError('City used somewhere else.');
        }
        $city->delete();

        return $this->sendSuccess('City deleted successfully.');
    }
}
