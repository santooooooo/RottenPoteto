<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UsersSignOut;
use App\Http\Requests\UserSignOutForm;
use App\Model\User\SignOut;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Model\User\UpdateProfile;
use App\Http\Requests\UserProfile;
use Illuminate\Http\Request;

class UsersController extends Controller
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
}
