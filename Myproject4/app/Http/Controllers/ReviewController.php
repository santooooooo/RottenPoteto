<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InputReviewForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use App\Model\User\DeleteReview;
use App\Model\User\GradeCinema;
use App\Model\User\InputReview;

class ReviewController extends Controller
{
    public function inputReview(InputReviewForm $request)
    {
    }

    public function deleteReview($request)
    {
    }
}
