<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

class ManageUsersController extends Controller
{
    function showManageUsers() 
	{
		return view('manage_users');
  	
	}
}

?>

