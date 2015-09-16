<?php

namespace App\Http\Controllers;
use App\Models\Manager_tbl;
use App\Models\Manager_Company_tbl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; // For redirect to page
use Illuminate\Support\Facades\Validator; // For validation
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

class CompanyManagementController extends Controller
{
	
	
	public function __construct()
	{
	   if(!Session::has('session'))
	   {
		   Redirect::to('/login')->send();
	   }

	}

	private function companyList()
	{
		 $company_list = DB::table('manager_company_tbl')
					    ->where('manager_company_status','active')->get();
		 return $company_list;
	}

    function showCompanyManagement() 
	{
		$result = DB::table('manager_tbl')
				->JOIN('manager_company_tbl','manager_tbl.manager_company_id', '=' , 'manager_company_tbl.manager_company_id')	  
				->Paginate(10);
		return view('company_management')->with("manager",$result);
  	
	}

	
	 function showCompanyManagement_ADD() 
	{
		 


		if(Input::get("save_company"))
		{
			$input['company_name'] = Input::get('company_name');
			$rules = array('company_name' => 'unique:manager_company_tbl,manager_company_name'); // Must not already exist in the `manager_company_name` column of `manager_company_tbl` table

			$validator = Validator::make($input, $rules);

			if ($validator->fails()) 
			{
				 echo 'That Company Name is already registered.';
			}
			else 
			{
			  // Register the new company
			  $company = new manager_company_tbl;
			  $company->manager_company_name = Input::get('company_name');
			  $company->manager_company_status = 'Active';
			  $company->save();
			  return redirect('/company_management/add');
			 
			}
		}

		if(Input::get("save_manager"))
		{
			$input['manager_id'] = Input::get('manager_id');

			// Must not already exist in the `manager_company_name` column of `manager_company_tbl` table
			$rules = array('manager_id' => 'unique:manager_tbl,manager_id');

			$validator = Validator::make($input, $rules);

			if ($validator->fails()) {
				 echo 'That ID is already registered.';
			}
			else {
			  // Register the new company
			  $manager = new manager_tbl;
			  $manager->manager_company_id = Input::get('assigned_company');
			  $manager->manager_name = Input::get('manager_name');
			  $manager->manager_id = Input::get('manager_id');
			  $manager->manager_password = Input::get('manager_password');
			  $manager->manager_landline = Input::get('landline');
			  $manager->manager_level = Input::get('level');
			  $manager->manager_context = Input::get('context');
			  $manager->manager_extensions = Input::get('assign_extension');
			  $manager->manager_memo = Input::get('manager_memo');
			  $manager->manager_mobile= Input::get('mobile');
			  $manager->free_pay= Input::get('pay_free');
			  $manager->did = Input::get('did');
			  $manager->manager_status = 'Active';
			  $manager->manager_language = 'kr';
			  $manager->save();
			  return redirect('/company_management/add');
			 
			}
		}
	
			return view('company_management_add')->with("company_list",$this->companyList());
	}

	function showCompanyManagement_EDIT($manager_idx) 
	{
			if(Input::get())
			{
				$company_management = manager_tbl::find($manager_idx);
				$company_management->manager_company_id = Input::get('assigned_company');
				$company_management->manager_name = Input::get('manager_name');
				$company_management->manager_password = Input::get('manager_password');
				$company_management->manager_landline = Input::get('landline');
				$company_management->manager_level = Input::get('level');
				$company_management->manager_context = Input::get('context');
				$company_management->manager_extensions = Input::get('assign_extension');
				$company_management->manager_memo = Input::get('manager_memo');
				$company_management->manager_mobile = Input::get('mobile');
				$company_management->free_pay = Input::get('pay_free');
				$company_management->did = Input::get('did');
				$company_management->manager_status = Input::get('manager_status');
				$company_management->save();
			}
			$manager_edit = DB::table('manager_tbl')
					->JOIN('manager_company_tbl','manager_tbl.manager_company_id', '=' , 'manager_company_tbl.manager_company_id')
					->WHERE('manager_tbl.manager_idx','=', $manager_idx)
					->get();
			return view('company_management_edit')->with("manager_edit",$manager_edit)->with("company_list",$this->companyList());
  		
	}

	function validate_company()
	{
		 if(Input::get()) {
            $company_name = Input::get('company_name');
            $data = array();
            $checkcompany = DB::table('manager_company_tbl')->select()->where("manager_company_name", $company_name)->get();
            if(!$checkcompany) {
                $data['exist'] = 0;
            }
            else {
                $data['exist'] = 1;
            }
			//alert('hello');
			//$data['url'] = "facebook.com";
            return json_encode($data);
        }

	}

	function validate_manager()
	{
		 if(Input::get()) {
            $manager_id = Input::get('manager_id');
            $data = array();
            $checkmanager = DB::table('manager_tbl')->select()->where("manager_id", $manager_id)->get();
            if(!$checkmanager) {
                $data['exist'] = 0;
            }
            else {
                $data['exist'] = 1;
            }
			//alert('hello');
			//$data['url'] = "facebook.com";
            return json_encode($data);
        }

	}

}

?>

