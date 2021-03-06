<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoodForm;
use App\Model\User\PushGood;
use App\Model\User\DeleteGood;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class GoodController extends Controller
{
    public function pushGood(GoodForm $request): string
    {
	    $userId = $request->input('google_user_id');
	    $reviewId = $request->input('user_review_id');

	    $success = PushGood::push($userId, $reviewId);

	    if($success)
	    {
		    header('Content-Type: application/json; charset=UTF-8');
		    return json_encode(true);
	    }
	    header('Content-Type: application/json; charset=UTF-8');
		  return json_encode(false);
    }

    public function deleteGood(GoodForm $request): string
    {
	    $userId = $request->input('google_user_id');
	    $reviewId = $request->input('user_review_id');

	    $success = DeleteGood::delete($userId, $reviewId);

	    if($success)
	    {
	     header('Content-Type: application/json; charset=UTF-8');
		   return json_encode(true);
	    }
	    header('Content-Type: application/json; charset=UTF-8');
		  return json_encode(false);
    }
}
