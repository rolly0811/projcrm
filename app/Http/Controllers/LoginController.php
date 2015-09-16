<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

class LoginController extends Controller
{
	function showLogin()
	{
      if(Input::get())
	  {
		$result = DB::table('manager_tbl')
				  ->where('manager_id', Input::get("id"))
			      ->where('manager_password',Input::get('password'))
			      ->get();
		if($result)
		{
			Session::put('session', $result[0]);
			return redirect('/dashboard');
		}
		else
		{
			 return view('login')->with('manager',$result);;
		}
	  }
	  else
	  {
			return view('login');
	  }
	}

	function showLogout()
	{
		Auth::logout();
		Session::flush();
		return redirect('/login');
	}


}