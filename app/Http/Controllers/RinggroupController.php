<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ringgroup;
use App\Models\Manager_Company_tbl;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RinggroupController extends Controller {

        public function show() {
            $ringgroups = DB::table('ring_group_tbl')
                    ->leftJoin('manager_company_tbl','manager_company_tbl.manager_company_id', '=', 'ring_group_tbl.manager_company_id_fk')
                    ->orderBy('ring_group_tbl.ring_group_id', 'DESC');
            $companies = new Manager_Company_tbl;
            return view('ringgroup')->with('ringgroups', $ringgroups->paginate(5))->with('companies', $companies->get());
        }
        
        public function add() {
            $ringgroups = new Ringgroup();
            $ringgroups->manager_company_id_fk = Input::get('company_id');
            $ringgroups->ring_group = Input::get('ring_group');
            $ringgroups->ring_group_name = Input::get('ring_group_name');
            $ringgroups->save();
            
            $ringgroup = Ringgroup::find($ringgroups->ring_group_id);
            $company = Manager_Company_tbl::find($ringgroup->manager_company_id_fk);
            
            $number = 0;
            if($ringgroups) {
                $number = $ringgroup->count();
            }
            $newringgroup = array(
                'number' => $number + 1,
                'company' => $company->manager_company_name,
                'ring_group' => $ringgroup->ring_group,
                'ring_group_name' => $ringgroup->ring_group_name
            );
            Session::flash('success', 'Added Successfully');
            return json_encode($newringgroup);
            
        }
        function edit($id) {
            $ringgroup = DB::table('ring_group_tbl')
                    ->leftJoin('manager_company_tbl', 'manager_company_tbl.manager_company_id', '=', 'ring_group_tbl.manager_company_id_fk')
                    ->where('ring_group_tbl.ring_group_id', $id)
                    ->get();
            $company = new Manager_Company_tbl();
            return view('ajax/ringgroup-edit')
                    ->with('ringgroup', $ringgroup[0])
                    ->with('companies', $company->get())
                    ->with('action', 'edit');
        }
        function cancel($id){
            $ringgroup = DB::table('ring_group_tbl')
                    ->leftJoin('manager_company_tbl', 'manager_company_tbl.manager_company_id', '=', 'ring_group_tbl.manager_company_id_fk')
                    ->where('ring_group_tbl.ring_group_id', $id)
                    ->get();
            $company = new Manager_Company_tbl();
            return view('ajax/ringgroup-edit')
                    ->with('ringgroup', $ringgroup[0])
                    ->with('companies', $company->get())
                    ->with('action', 'cancel');
        }
        
        function update($id) {
            $ringgroup = Ringgroup::find($id);
            $ringgroup->manager_company_id_fk = Input::get('company_id');
            $ringgroup->ring_group = Input::get('ring_group');
            $ringgroup->ring_group_name = Input::get('ring_group_name');
            $ringgroup->save();
            
            return $this->cancel($id);
        }
        
        function delete($id) {
            $ringgroup = Ringgroup::find($id);
            $ringgroup->delete();
            return "Successfully Deleted!";
        }

}
