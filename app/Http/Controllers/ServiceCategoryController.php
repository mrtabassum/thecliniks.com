<?php

namespace App\Http\Controllers;

use App\DataTables\ServiceCategoryDataTable;
use App\Models\Service;
use App\Models\ServiceCategory;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CreateServiceCategoryRequest;
use App\Http\Requests\UpdateServiceCategoryRequest;
use App\Repositories\ServiceCategoryRepository;
use Response;
use Yajra\DataTables\DataTables;

class ServiceCategoryController extends AppBaseController
{
    /** @var  ServiceCategoryRepository */
    private $serviceCategoryRepository;

    public function __construct(ServiceCategoryRepository $serviceCategoryRepo)
    {
        $this->serviceCategoryRepository = $serviceCategoryRepo;
    }

    /**
     * Display a listing of the ServiceCategory.
     *
     * @param  Request  $request
     *
     * @return Application|Factory|View|Response
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new ServiceCategoryDataTable())->get())->make(true);
        }

        return view('service_categories.index');
    }

    /**
     * Store a newly created ServiceCategory in storage.
     *
     * @param  CreateServiceCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateServiceCategoryRequest $request): JsonResponse
    {
        $input = $request->all();
        $serviceCategory = $this->serviceCategoryRepository->create($input);

        return $this->sendResponse($serviceCategory, 'Service category created successfully.');
    }

    /**
     * Show the form for editing the specified ServiceCategory.
     *
     * @param  ServiceCategory  $serviceCategory
     * @return JsonResponse
     */
    public function edit(ServiceCategory $serviceCategory): JsonResponse
    {
        return $this->sendResponse($serviceCategory, 'Category retrieved successfully.');
    }

    /**
     * Update the specified ServiceCategory in storage.
     *
     * @param  UpdateServiceCategoryRequest  $request
     * @param  ServiceCategory  $serviceCategory
     * @return JsonResponse
     */
    public function update(UpdateServiceCategoryRequest $request, ServiceCategory $serviceCategory): JsonResponse
    {
        $input = $request->all();
        $this->serviceCategoryRepository->update($input, $serviceCategory->id);

        return $this->sendSuccess('Service category updated successfully.');
    }

    /**
     * Remove the specified ServiceCategory from storage.
     *
     * @param  ServiceCategory  $serviceCategory
     * @return JsonResponse
     */
    public function destroy(ServiceCategory $serviceCategory): JsonResponse
    {
        $checkRecord = Service::whereCategoryId($serviceCategory->id)->exists();
        
        if($checkRecord){
            return $this->sendError('Service category used somewhere else.');
        }
        $serviceCategory->delete();

        return $this->sendSuccess('Service category deleted successfully.');
    }
}
