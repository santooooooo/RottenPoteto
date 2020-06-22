<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoodForm;
use App\Model\User\PushGood;
use App\Model\User\DeleteGood;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoodController extends Controller
{
	/**
	 * @return RedirectResponse
	 */
    public function pushGood(GoodForm $request)
    {
	    $userId = $request->input('google_user_id');
	    $reviewId = $request->input('user_review_id');

	    $success = PushGood::push($userId, $reviewId);

	    if($success)
	    {
		    return redirect('/home')->with('message', 'レビューへGoodを送りました。');
	    }
	    return redirect('/home');
    }

	/**
	 * @return RedirectResponse
	 */
    public function deleteGood(GoodForm $request)
    {
	    $userId = $request->input('google_user_id');
	    $reviewId = $request->input('user_review_id');

	    $success = DeleteGood::delete($userId, $reviewId);

	    if($success)
	    {
		    return redirect('/home')->with('message', 'レビューへGoodを送りました。');
	    }
	    return redirect('/home');
    }
}
