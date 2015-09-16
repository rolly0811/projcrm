<?php

namespace App\Http\Controllers;
use App\Models\Manager_tbl;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

class CompanyController extends Controller
{
    function showCompany_ADD() 
	{
		//$result = DB::table('manager_tbl') ->Paginate(10);
		return view('company_add');
  	
	}

	
}

?>

