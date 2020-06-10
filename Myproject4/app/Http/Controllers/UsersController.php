<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UsersSignOut;
use App\Model\User\SignOut;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class UsersController extends Controller
{
	/**
	 * @var string $gail
	 * @return RedirectResponse | Redirector
	 */
    public function userSignOut(UsersSignOut $request)
    {
	    $gmail = $request->input('gmail');
	    SignOut::signOut($gmail);

	    session(['user' => null]);

	    return redirect('/home');
    }

    /**
     * @return RedirectResponse | Redirector
     */
    public function userLogOut()
    {
	    session(['user' => null]);

	    return redirect('/home');
    }
}
