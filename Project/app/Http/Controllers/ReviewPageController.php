<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewPageForm;
use App\Http\Requests\OutputUserInfoForm;
use App\Model\User\ReviewPageInfo;
use App\Model\User\UserInfo;

final class ReviewPageController extends Controller
{
    public function outputInfo(ReviewPageForm $request): string
    {
	    $contributeId = $request->input('contribute_id');

	    $viewInfo = ReviewPageInfo::outputInfo($contributeId);

	    header('Content-Type: application/json; charset=UTF-8');
	    return $viewInfo;
    }

    public function outputUserInfo(OutputUserInfoForm $request): string
    {
	    $userId = $request->input('google_user_id');

	    $userInfo = UserInfo::output($userId);

	    header('Content-Type: application/json; charset=UTF-8');
	    return $userInfo;
    }
}
