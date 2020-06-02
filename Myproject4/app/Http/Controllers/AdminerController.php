<?php

namespace App\Http\Controllers;

use App\Model\Adminer\CheckAdminer;
use App\Http\Requests\AdminerAuthForm;
use Illuminate\Http\Request;
use Illuminate\View\View; 
use Illuminate\Http\RedirectResponse;
use App\Model\Adminer\ChangeSafety;
use App\Model\Adminer\UsersData;

class AdminerController extends Controller
{
		/**
		 * @var string $email
		 * @var string $password
		 * @var bool $auth
		 * @return View | RedirectResponse
		 */
    public function adminerAuth(AdminerAuthForm $request)
    {
	    $email = $request->input('gmail');
	    $password = $request->input('password');

	    $auth = CheckAdminer::check($email) && $password == 'fjhvhervheusheuhjihmnv,klsheish@p-9-0';

	    if($auth)
	    {
		    return view('adminerHome');
	    }

	    return redirect('/adminer')->with('message', '管理者として認証できませんでした。');
    }

    /**
     * @var string $email
     * @return View
     */
    public function controllUser(Request $request)
    {
	    $email = $request->input('gmail');
	    ChangeSafety::change($email);

	    return view('adminerHome');
    }

    /**
     * @var string $usersData
     */
    public function getUsersData(): string
    {
	    $usersData = UsersData::jsonData();

	    return $usersData;
    }
}
