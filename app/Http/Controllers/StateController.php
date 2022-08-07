<?php

namespace App\Http\Controllers;

use App\DataTables\StateDataTable;
use App\Http\Requests;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CreateStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Repositories\StateRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Datatables;

class StateController extends AppBaseController
{
    /** @var  StateRepository */
    private $stateRepository;

    public function __construct(StateRepository $stateRepo)
    {
        $this->stateRepository = $stateRepo;
    }

    /**
     * Display a listing of the State.
     *
     * @param  Request  $request
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new StateDataTable())->get())->make(true);
        }

        $countries = Country::orderBy('name','ASC')->pluck('name', 'id');

        return view('states.index', compact('countries'));
    }

    /**
     * Store a newly created State in storage.
     *
     * @param  CreateStateRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateStateRequest $request)
    {
        $input = $request->all();

        $state = $this->stateRepository->create($input);

        return $this->sendSuccess('State created successfully.');
    }

    /**
     * Show the form for editing the specified State.
     *
     * @param  State  $state
     * @return JsonResponse
     */
    public function edit(State $state)
    {
        return $this->sendResponse($state, 'State retrieved successfully.');
    }

    /**
     * Update the specified State in storage.
     *
     * @param  UpdateStateRequest  $request
     * @param  State  $state
     * @return JsonResponse
     */
    public function update(UpdateStateRequest $request, State $state)
    {
        $input = $request->all();
        $this->stateRepository->update($input, $state->id);

        return $this->sendSuccess('State updated successfully.');
    }

    /**
     * @param  State  $state
     *
     * @return JsonResponse
     */
    public function destroy(State $state)
    {
        $checkRecord = Address::whereStateId($state->id)->exists();
        if ($checkRecord) {
            return $this->sendError('State used somewhere else.');
        }

        $state->delete();

        return $this->sendSuccess('State deleted successfully.');
    }
}
