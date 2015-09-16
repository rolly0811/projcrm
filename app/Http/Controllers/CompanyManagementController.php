<?php

namespace App\Http\Controllers;
use App\Models\Manager_tbl;
use App\Models\Manager_Company_tbl;
use App\Models\Manager_account_tbl;
use App\Models\Manager_pay_transaction_tbl;
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

	private function close_refresh()
	{
		echo "<script>	
				window.onunload = refreshParent;
				function refreshParent() {
					alert('DATA UPDATED');
				window.opener.location.reload();
				}
			</script>
			<script>window.close();</script>";
	}

	private function refresh_parent()
	{
		echo "<script>	
				window.onunload = refreshParent;
				function refreshParent() {
					alert('DATA UPDATED');
				window.opener.location.reload();
				}
			</script>";
	}

    function showCompanyManagement() 
	{
		/*
		$result = DB::table('manager_company_tbl')
				  ->JOIN('manager_tbl','manager_company_tbl.manager_company_id', '=' , 'manager_tbl.manager_company_id_fk')
			      ->leftJOIN('manager_account_tbl','manager_tbl.manager_idx','=','manager_account_tbl.manager_idx_fk','WHERE','manager_account_tbl.account_status','=','Active') // ON/AND
				  ->Paginate(10);
		*/
			$result = DB::table('manager_company_tbl')
				  ->JOIN('manager_tbl','manager_company_tbl.manager_company_id', '=' , 'manager_tbl.manager_company_id_fk')
			      ->leftJOIN('manager_account_tbl',function($joins)
						{
								$joins->on('manager_tbl.manager_idx','=','manager_account_tbl.manager_idx_fk');
								$joins->on('manager_account_tbl.account_status','=',DB::raw("'Active'"));
						})// LEFT JOIN ON,WHERE
				  ->Paginate(10);

		//print_r($result);die;
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
			  $manager->manager_company_id_fk = Input::get('assigned_company');
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

			  $this->close_refresh();
			 
			 
			}
		}
	
			return view('company_management_add')->with("company_list",$this->companyList());
	}

	function showCompanyManagement_EDIT($manager_idx) 
	{
			if(Input::get())
			{
				$company_management = manager_tbl::find($manager_idx);
				$company_management->manager_company_id_fk = Input::get('assigned_company');
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
					->JOIN('manager_company_tbl','manager_tbl.manager_company_id_fk', '=' , 'manager_company_tbl.manager_company_id')
					->WHERE('manager_tbl.manager_idx','=', $manager_idx)
					->get();
			return view('company_management_edit')->with("manager_edit",$manager_edit)->with("company_list",$this->companyList());
  		
	}

	function showAccount_ADD($manager_idx)
	{
		if(Input::get())
		{
			$account = new manager_account_tbl;
			$account->manager_idx_fk = $manager_idx;
			$account->account_start_date = Input::get('start_date');
			$account->account_end_date = Input::get('end_date');
			$account->months = Input::get('months');
			$account->total_price = Input::get('total_price');
			$account->payment_status = 'Unpaid';
			$account->account_status = 'Active';
			$account->save();
			
			

			//$this->close_refresh();
		

		}
		return view('account_add');
	}

	function showTransaction_ADD($manager_account_id)
	{
	
	//GET CURRENT MANAGER_IDX 
			$manager_idx = DB::table('manager_account_tbl','manager_idx_fk')
						   ->WHERE('manager_account_id','=', $manager_account_id)
						   ->first();

		if(Input::get('add_transaction'))
		{
			$transaction = new manager_pay_transaction_tbl;
			$transaction ->manager_account_id_fk = $manager_account_id ;
			$transaction ->paid_amount = Input::get('paid_amount');
			$transaction ->payment_date = Input::get('payment_date');
			$transaction ->remarks = Input::get('remarks');
			$transaction->save();

// GET TOTAL AMOUNT PAID
			$total_amount_paid = DB::table('manager_pay_transaction_tbl')
								->WHERE('manager_account_id_fk','=',$manager_account_id)
								->sum('paid_amount'); 

// UPDATE TO PAID WHEN BALANCE IS 0
			$account_status = DB::table('manager_account_tbl')
							  ->WHERE('total_price','<=',$total_amount_paid)
							  ->WHERE('manager_account_id','=',$manager_account_id)
							  ->UPDATE(['payment_status' => 'Paid']);

			//return redirect("company_management/transaction/add/$manager_account_id");

			$this->close_refresh();

		}

		if(Input::get('add_new_account'))
		{
			$account = new manager_account_tbl;
			$account->manager_idx_fk = $manager_idx->manager_idx_fk;
			$account->account_start_date = Input::get('start_date');
			$account->account_end_date = Input::get('end_date');
			$account->months = Input::get('months');
			$account->total_price = Input::get('total_price');
			$account->payment_status = 'Unpaid';
			$account->account_status = 'Active';
			$account->save();

// UPDATE OLD ACCOUNT STATUS TO IN-ACTIVE
			$account_status = DB::table('manager_account_tbl')
							  ->WHERE('manager_account_id','=',$manager_account_id)
							  ->UPDATE(['account_status' => 'Inactive']);

			//return redirect("company_management/transaction/add/$manager_account_id");
			
			$this->close_refresh();

		}
		

		$total = DB::table('manager_account_tbl')
			   ->WHERE('manager_account_id',$manager_account_id)->get();

		$transaction_history = DB::table('manager_account_tbl')
							   ->JOIN('manager_pay_transaction_tbl','manager_account_tbl.manager_account_id','=','manager_pay_transaction_tbl.manager_account_id_fk')
							   ->WHERE('manager_account_tbl.manager_account_id','=',$manager_account_id)
							   ->WHERE('manager_account_tbl.account_status','=','Active')
							   ->get();

		$old_transaction_history = DB::table('manager_account_tbl')
							   ->WHERE('manager_idx_fk','=',$manager_idx->manager_idx_fk)
							   ->WHERE('account_status','=','Inactive')
							   ->get();


		return view('transaction_add')->with("transaction_history",$transaction_history)->with("total",$total)->with("old_history",$old_transaction_history);
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

