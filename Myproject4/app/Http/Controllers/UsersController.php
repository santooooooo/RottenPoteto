<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UsersSignOut;
use App\Http\Requests\UserSignOutForm;
use App\Http\Requests\OutputProfileForm;
use App\Http\Requests\UserProfile;
use App\Model\User\SignOut;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Model\User\UpdateProfile;
use App\Model\User\Profile;

final class UsersController extends Controller
{
	/**
	 * @var string $gail
	 * @return RedirectResponse
	 */
    public function userSignOut(UserSignOutForm $request)
    {
	    $gmail = $request->input('gmail');
	    SignOut::signOut($gmail);

	    session(['user' => null]);

	    return redirect('/home');
    }

    /**
     * @return RedirectResponse
     */
    public function userLogOut()
    {
	    session(['user' => null]);

	    return redirect('/home');
    }

    /**
     * @var object $update
     * @return RedirectResponse
     */
    public function updateUserProfile(UserProfile $request)
    {
	    $update = new UpdateProfile($request);
	    $update->update();

	    return redirect('/home');
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
