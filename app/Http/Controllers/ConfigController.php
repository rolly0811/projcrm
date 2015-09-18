<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Support\Facades\DB;
use \App\Models\Manager_Company_tbl;
use Illuminate\Support\Facades\Input;

class ConfigController extends Controller {

    public function show() {
        if (Input::get('cti_ip')) {
            $config = new Configuration;
            $config->manager_company_id_fk = Input::get('company_id');
            $config->company_ip = Input::get('cti_ip');
            $config->save();

            $configs = DB::table('configuration_tbl')
                    ->leftJoin('manager_company_tbl', 'configuration_tbl.manager_company_id_fk', '=', 'manager_company_tbl.manager_company_id')
                    ->where('configuration_tbl.status', 'Active')
                    ->orderBy('configuration_tbl.config_id', 'DESC');
            $Allconfigs = DB::table('configuration_tbl')
                    ->leftJoin('manager_company_tbl', 'configuration_tbl.manager_company_id_fk', '=', 'manager_company_tbl.manager_company_id')
                    ->where('configuration_tbl.status', 'Active');
            return view('ajax/configs')->with('configs', $configs->paginate(10))->with('total', $Allconfigs->count());
        } else {
            $configs = DB::table('configuration_tbl')
                    ->leftJoin('manager_company_tbl', 'configuration_tbl.manager_company_id_fk', '=', 'manager_company_tbl.manager_company_id')
                    ->where('configuration_tbl.status', 'Active')
                    ->orderBy('configuration_tbl.config_id', 'DESC');
            $Allconfigs = DB::table('configuration_tbl')
                    ->leftJoin('manager_company_tbl', 'configuration_tbl.manager_company_id_fk', '=', 'manager_company_tbl.manager_company_id')
                    ->where('configuration_tbl.status', 'Active');
            $companies = new Manager_Company_tbl();
            return view('configurations')->with('configs', $configs->paginate(10))->with('companies', $companies->get())->with('total', $Allconfigs->count());
        }
    }

    public function editconfig() {
        if(Input::get()){
            if(Input::get('action') == 'edit'){
                $config = Configuration::find(Input::get('config_id'));
                $company = new Manager_Company_tbl();
                $number = Input::get('number');
                return view('ajax/editconfig')->with('number', $number)->with('companies', $company->get())->with('config', $config);
            }
            else {
                if(Input::get('action') == "update"){
                    $config = Configuration::find(Input::get('config_id'));
                    $config->manager_company_id_fk = Input::get('company_id');
                    $config->company_ip = Input::get('company_ip');
                    $config->save();
                }
                
                $number = Input::get('number');
                $configs = DB::table('configuration_tbl')
                    ->leftJoin('manager_company_tbl', 'configuration_tbl.manager_company_id_fk', '=', 'manager_company_tbl.manager_company_id')
                    ->where('configuration_tbl.config_id', Input::get('config_id'))
                    ->get();
                
                return view('ajax/editconfig')->with('number', $number)->with('config', $configs[0]);
            }
           
        }
    }
    
    public function delete() {
        $id = Input::get('id');
        $config = Configuration::find($id);
        $config->status = "In-Active";
        $config->save();
        
        $configs = DB::table('configuration_tbl')
                    ->leftJoin('manager_company_tbl', 'configuration_tbl.manager_company_id_fk', '=', 'manager_company_tbl.manager_company_id')
                    ->where('configuration_tbl.status', 'Active')
                    ->orderBy('configuration_tbl.config_id', 'DESC');
        $Allconfigs = DB::table('configuration_tbl')
                ->leftJoin('manager_company_tbl', 'configuration_tbl.manager_company_id_fk', '=', 'manager_company_tbl.manager_company_id')
                ->where('configuration_tbl.status', 'Active');
        $companies = new Manager_Company_tbl();
        return view('ajax/configs')->with('configs', $configs->paginate(10))->with('companies', $companies->get())->with('total', $Allconfigs->count());
    }

}
