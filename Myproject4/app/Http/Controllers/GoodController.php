<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoodForm;
use App\Model\User\PushGood;
use App\Model\User\DeleteGood;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class GoodController extends Controller
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
		    $messageVal = json_encode('レビューへポテトを送りました。');
		    return redirect('/')->with('message', $messageVal);
	    }
		  $messageVal = json_encode('同じレビューへ二つポテトを送ることはできません。');
	    return redirect('/')->with('message', $messageVal);
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
		    $messageVal = json_encode('レビューへのポテトを取り消しました。');
		    return redirect('/')->with('message', $messageVal);
	    }
		  $messageVal = json_encode('レビューへポテトを送っていないため、取り消しができません。');
	    return redirect('/')->with('message', $messageVal);
    }
}
