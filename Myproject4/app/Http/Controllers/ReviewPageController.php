<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewPageForm;
use App\Model\User\ReviewPageInfo;

class ReviewPageController extends Controller
{
    public function outputInfo(ReviewPageForm $request): string
    {
	    $contributeId = $request->input('contribute_id');

	    $viewInfo = ReviewPageInfo::outputInfo($contributeId);

	    return $viewInfo;
    }
}
