<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserCancelForm;
use App\Http\Requests\OutputProfileForm;
use App\Http\Requests\UserProfile;
use App\Model\User\Cancel;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Model\User\UpdateProfile;
use App\Model\User\Profile;

final class UsersController extends Controller
{
	/**
	 * @var string $gmail
	 * 
	 */
    public function userCancel(UserCancelForm $request): string
    {
	    $gmail = $request->input('gmail');
	    Cancel::Cancel($gmail);

	    session(['user' => null]);

	    return json_encode(True);
    }

    /**
     * @return RedirectResponse
     */
    public function userLogOut()
    {
	    session(['user' => null]);

	    return redirect('/');
    }

    /**
     * @var object $update
     * @return RedirectResponse
     */
    public function updateUserProfile(UserProfile $request)
    {
	    $update = new UpdateProfile($request);
	    $update->update();

	    return redirect('/');
    }

    /**
     * @return void | string
     */
    public function outputInfo(OutputProfileForm $request)
    {
	    $gmail = $request->input('google_user_gmail');

	    $jsonData = Profile::output($gmail);

	    return $jsonData;
    }
}
