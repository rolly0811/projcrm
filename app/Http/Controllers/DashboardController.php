<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; // For redirect to page
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

class DashboardController extends Controller
{
	public function __construct()
	{
	   if(!Session::has('session'))
	   {
		   Redirect::to('/login')->send();
	   }
	}

	function showDashboard()
	{
		return view('dashboard');
	}


}