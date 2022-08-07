<?php

namespace App\Http\Controllers\Front;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use App\Repositories\SliderRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Datatables;
use Flash;

class SliderController extends AppBaseController
{
    /** @var SliderRepository */
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepository = $sliderRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new SliderDataTable)->get())->make('true');
        }

        return view('fronts.sliders.index');
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return Application|Factory|View
//     */
//    public function create()
//    {
//        return view('fronts.sliders.create');
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  CreateSliderRequest  $request
//     * @return Application|Redirector|RedirectResponse
//     */
//    public function store(CreateSliderRequest $request)
//    {
//        $input = $request->all();
//        $slider = $this->sliderRepository->store($input);
//
//        Flash::success('Slider created successfully');
//
//        return redirect(route('sliders.index'));
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Slider  $slider
     * @return Application|Factory|View
     */
    public function edit(Slider $slider)
    {
        return view('fronts.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSliderRequest  $request
     * @param  Slider  $slider
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $input = $request->all();
        $slider = $this->sliderRepository->update($input, $slider->id);

        Flash::success('Slider updated successfully');

        return redirect(route('sliders.index'));
    }

//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  Slider  $slider
//     * @return Application|RedirectResponse|Response|Redirector
//     */
//    public function destroy(Slider $slider)
//    {
//        if ($slider->is_default) {
//            return $this->sendError('This slider used somewhere else.');
//        }
//
//        $slider->delete();
//
//        return $this->sendSuccess('Slider deleted successfully.');
//    }
}
