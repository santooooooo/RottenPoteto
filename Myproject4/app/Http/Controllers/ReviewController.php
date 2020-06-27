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
		 * @return RedirectResponse
		 * @var bool $inputSuccess
		 */
    public function inputReview(InputReviewForm $request)
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
		    return redirect('home');
	    }

	    GradeCinema::grade($this->contributeId);

	    $messageVal = json_encode('レビューの投稿に成功しました。');

	    return redirect('home')->with('message', $messageVal);
    }

		/**
		 * @return RedirectResponse
		 * @var bool $deleteSuccess
		 */
    public function deleteReview(DeleteReviewForm $request)
    {
	    $this->contributeId = $request->input('contribute_id');
	    $this->googleUserId = $request->input('google_user_id');

	    $deleteSuccess = DeleteReview::delete($this->contributeId, $this->googleUserId);

	    if(!$deleteSuccess)
	    {
		    return redirect('/home');
	    }

	    GradeCinema::grade($this->contributeId);

	    $messageVal = json_encode('レビューの削除に成功しました。');

	    return redirect('/home')->with('message', 'レビューの削除に成功しました。');
    }
}
