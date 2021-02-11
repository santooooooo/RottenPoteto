<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InputReviewForm;
use App\Http\Requests\DeleteReviewForm;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Model\User\DeleteReview;
use App\Model\User\GradeCinema;
use App\Model\User\InputReview;

final class ReviewController extends Controller
{
	/**
	 * @var int $contributeId
	 */
		private $contributeId;
	/**
	 * @var int $googleUserId
	 */
		private $googleUserId;
	/**
	 * @var string $title
	 */
		private $title;
	/**
	 * @var string $review
	 */
		private $review;
	/**
	 * @var int $spoiler
	 */
		private $spoiler;
	/**
	 * @var int $satisfaction
	 */
		private $satisfaction;
	/**
	 * @var int $recommended
	 */
		private $recommended;

		/**
		 * @var bool $inputSuccess
		 */
    public function inputReview(InputReviewForm $request): string
    {
	    $this->contributeId = $request->input('contribute_id');
	    $this->googleUserId = $request->input('google_user_id');
	    $this->title = $request->input('title');
	    $this->review = $request->input('review');
	    $this->spoiler = $request->input('spoiler');
	    $this->satisfaction = $request->input('satisfaction');
	    $this->recommended = $request->input('recommended');

	    $inputSuccess = InputReview::input(
		    $this->contributeId,
		    $this->googleUserId,
		    $this->title,
		    $this->review,
		    $this->spoiler,
		    $this->satisfaction,
		    $this->recommended
	    );

	    if(!$inputSuccess)
	    {
		    header('Content-Type: application/json; charset=UTF-8');
		    return json_encode(false);
	    }

	    GradeCinema::grade($this->contributeId);

      header('Content-Type: application/json; charset=UTF-8');
		  return json_encode(true);
    }

		/**
		 * 
		 * @var bool $deleteSuccess
		 */
    public function deleteReview(DeleteReviewForm $request): string
    {
	    $this->contributeId = $request->input('contribute_id');
	    $this->googleUserId = $request->input('google_user_id');

	    $deleteSuccess = DeleteReview::delete($this->contributeId, $this->googleUserId);

	    if(!$deleteSuccess)
	    {
		    header('Content-Type: application/json; charset=UTF-8');
		    return json_encode(false);
	    }

	    GradeCinema::grade($this->contributeId);

	    header('Content-Type: application/json; charset=UTF-8');
	    return json_encode(true);
    }
}
