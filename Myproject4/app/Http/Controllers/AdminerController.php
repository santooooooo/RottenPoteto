<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminerAuthForm;
use Illuminate\View\View; 
use Symfony\Component\HttpFoundation\RedirectResponse;

final class AdminerController extends Controller
{
		/**
		 * @var string $gmail
		 * @var string $password
		 * @var bool $auth
		 * @return View | RedirectResponse
		 */
    public function adminerAuth(AdminerAuthForm $request)
    {
	    $gmail = $request->input('gmail');
	    $password = $request->input('password');

	    $auth = $gmail == 'santo.shunsuke@gmail.com' &&
		   			 $password == 'fjhvhervheusheuhjihmnv,klsheish@p-9-0';

	    if($auth)
	    {
		    return view('contribute');
	    }

	    return redirect('/adminer')->with('message', '管理者として認証できませんでした。');
    }
}
