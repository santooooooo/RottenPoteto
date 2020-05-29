<?php

namespace App\Http\Controllers;

use App\Model\Adminer\CheckAdminer;
use App\Http\Requests\AdminerAuthForm;

class AdminerController extends Controller
{
	/*
	 * @var string $email
	 * @var string $password
	 * @var bool $auth
	 */
    public function adminerAuth(AdminerAuthForm $request)
    {
	    $email = $request->input('email');
	    $password = $request->input('password');

	    $auth = CheckAdminer::check($email) && $password == 'fjhvhervheusheuhjihmnv,klsheish@p-9-0';

	    if($auth)
	    {
		    return view('adminerHome');
	    }

	    return redirect('/adminer')->with('message', '管理者として認証できませんでした。');
    }
}
