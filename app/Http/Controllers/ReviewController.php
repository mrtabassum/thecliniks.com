<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Review;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ReviewController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $patient = Patient::whereUserId(getLogInUserId())->first();
        $doctorIds = Appointment::wherePatientId($patient['id'])->whereStatus(Appointment::CHECK_OUT)->pluck('doctor_id')->toArray();
        $doctors = Doctor::with('user','specializations','reviews')
            ->whereIn('id',$doctorIds)
            ->get();

        return view('reviews.index', compact('doctors'));
    }

    /**
     * @param  CreateReviewRequest  $request
     * @return mixed
     */
    public function store(CreateReviewRequest $request)
    {
        $input = $request->all();
        $patient = Patient::whereUserId(getLogInUserId())->first();
        $input['patient_id'] = $patient['id'];
        Review::create($input);
        Notification::create([
            'title'   => getLogInUser()->full_name.' just added '.$input['rating'].' star review for you.',
            'type'    => Notification::REVIEW,
            'user_id' => Doctor::whereId($input['doctor_id'])->first()->user_id,
        ]);

        return $this->sendSuccess('Review add successfully.');
    }

    /**
     * @param  Review  $review
     * @return mixed
     */
    public function edit(Review $review)
    {
        return $this->sendResponse($review, 'Review retrieved successfully');
    }

    /**
     * @param  UpdateReviewRequest  $request
     * @param  Review  $review
     * @return mixed
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $data = $request->all();
        $review->update($data);

        return $this->sendSuccess('Review edited successfully.');
    }

}
