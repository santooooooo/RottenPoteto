<?php
declare(strict_types=1);

namespace App\Model\User;

use Illuminate\Support\Facades\DB;
use App\Eloquent\Contribute;

final class GradeCinema
{
    static function grade(int $contributeId): void
    {
	    $contributes = DB::table('user_reviews')->where('contribute_id', $contributeId)->get();
	    $allSatisfaction = 0;
	    $allRecommended = 0;

	    foreach($contributes as $contribute)
	    {
		    $allSatisfaction += $contribute->satisfaction;
		    $allRecommended += $contribute->recommended;
	    }
	    unset($contribute);

	    $number = DB::table('user_reviews')->where('contribute_id', $contributeId)->count();
	    if($number != 0)
	    {
		    $satisfactionAverage = round($allSatisfaction / $number, 2);
		    $recommendedAverage = round($allRecommended / $number, 2);
	    } else {
		    $satisfactionAverage = 0;
		    $recommendedAverage = 0;
	    }

	    $eloquent = Contribute::find($contributeId);
	    $eloquent->fill([
		    'satisfaction' => $satisfactionAverage,
		    'recommended' => $recommendedAverage
	    ]);
	    $eloquent->save();

    }
}
