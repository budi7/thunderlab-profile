<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Auth;

class UACController extends Controller {
	protected $redirectTo = '/dashboard';

	public function login ()
	{
		if (Auth::check()) {
			return $this->generateRedirect(route('backend.dashboard'));
		}

		$this->view     = view('pages.backend.uac.login');
		return $this->generateView();
	}

	public function logging (Request $request)
	{

		if (Auth::attempt(['username' => $request->get('email'), 'password' => $request->get('password')]))  {			
			return redirect()->intended('dashboard');
		} else {
			$this->page_attributes->msg['error']    = ["Invalid Password / Email"];
				
			return $this->generateRedirect(route('backend.login'));
		}
	}

	public function logout ()
	{
		// for logout
		Auth::logout();

		return $this->generateRedirect(route('backend.login'));
	}

	public function reset ()
	{
		// reset password & generate new password
	}

	public function forgot ()
	{
		// request reset password  & get reqeust code
	}

}