<?php

namespace App\Http\Controllers;

use App\DataTables\ServiceDataTable;
use App\Models\Appointment;
use App\Models\Service;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CreateServicesRequest;
use App\Http\Requests\UpdateServicesRequest;
use App\Repositories\ServicesRepository;
use Laracasts\Flash\Flash;
use Illuminate\Routing\Redirector;
use Yajra\DataTables\DataTables;
use function Symfony\Component\String\s;

class ServiceController extends AppBaseController
{
    /** @var  ServicesRepository */
    private $servicesRepository;

    public function __construct(ServicesRepository $servicesRepo)
    {
        $this->servicesRepository = $servicesRepo;
    }

    /**
     * @param  Request  $request
     *
     * @return Application|Factory|View
     * @throws Exception
     *
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new ServiceDataTable())->get($request->only('status')))->make(true);
        }
        $status = Service::STATUS;

        return view('services.index',compact('status'));
    }

    /**
     * Show the form for creating a new Services.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = $this->servicesRepository->prepareData();

        return view('services.create', compact('data'));
    }

    /**
     * Store a newly created Services in storage.
     *
     * @param  CreateServicesRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateServicesRequest $request)
    {
        $input = $request->all();
        $this->servicesRepository->store($input);

        Flash::success('Service created successfully.');

        return redirect(route('services.index'));
    }

    /**
     * Show the form for editing the specified Services.
     *
     * @param  Service  $service
     * @return Application|Factory|View
     */
    public function edit(Service $service)
    {
        $data = $this->servicesRepository->prepareData();
        $selectedDoctor = $service->serviceDoctors()->pluck('doctor_id')->toArray();

        return view('services.edit', compact('service', 'data', 'selectedDoctor'));
    }

    /**
     * Update the specified Services in storage.
     *
     * @param  UpdateServicesRequest  $request
     * @param  Service  $service
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateServicesRequest $request, Service $service)
    {
        $this->servicesRepository->update($request->all(), $service);

        Flash::success('Service updated successfully.');

        return redirect(route('services.index'));
    }

    /**
     * Remove the specified Services from storage.
     *
     * @param  Service  $service
     * @return JsonResponse
     */
    public function destroy(Service $service): JsonResponse
    {
        $checkRecord = Appointment::whereServiceId($service->id)->exists();
        
        if ($checkRecord) {
            return $this->sendError('Service used somewhere else.');
        }
        $service->delete();

        return $this->sendSuccess('Service deleted successfully.');
    }

    public function getService(Request $request)
    {
  
        $service = Service::all();

        return $this->sendResponse($service, 'Retrieved successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function getCharge(Request $request)
    {
        $chargeId = $request->chargeId;
        $charge = Service::find($chargeId);

        return $this->sendResponse($charge, 'Retrieved successfully.');
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function changeServiceStatus(Request $request)
    {
        $status = Service::findOrFail($request->id);
        $status->update(['status' => ! $status->status]);

        return $this->sendResponse($status, 'Status updated successfully.');
    }
}
