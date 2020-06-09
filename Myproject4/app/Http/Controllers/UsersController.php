<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UsersSignOut;
use App\Model\User\SignOut;

class UsersController extends Controller
{
    public function UserSignOut(UsersSignOut $request)
    {
	    $gmail = $request->input('gmail');
	    SignOut::signOut($gmail);

	    return redirect('home');
    }
}
