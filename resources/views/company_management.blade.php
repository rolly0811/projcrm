@extends('layout/main')
@section('content')

 <?php $manager_session = Session::get('session');
	   $lang = 'language.' . $manager_session->manager_language;
?>

   <section class="content-header">
          <h1>
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Company Management</li>
          </ol>
        </section>
<!-- TABLE: LATEST ORDERS -->

        <!-- Main content -->
        <section class="content">
			
			<table style="width:30%;margin:5px;" >
                      <thead>
					  <form action="" method="GET">
						<tr>
							<td><?=Lang::get($lang . '.search');?></td>
							<td><select name="search_option" class="form-control input-sm">
										
										<option value='name'>Name</option>
										<option value='company'>Companys</option>
										<option value='level'>Level</option>
										
									</select>
							</td>
							<td><input type="text" name="username" class="form-control input-sm pull-right" placeholder="Search" value="<?=Input::get('username')?>"></td>
							<td><button type="submit "class="btn btn-sm btn-default"><i class="fa fa-search"></i></button></td>
						</tr>
					  </form>
				</table>
              

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">LIST</h3>
                  <div class="box-tools pull-right">
                    
					<div class="btn-group">
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><font size='4'><i class="fa fa-wrench"></i> Settings</font></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#" onclick="javascript:window.open('/company_management/add','mywindowtitle','width=1100,height=800,scrollbars=yes, scrollbars=1, toolbar=no, resizable=1,left = 500,top=100')">ADD</a></li>
						<li><a href="#">SHOW ACTIVE</a></li>
						<li><a href="#">SHOW IN-ACTIVE</a></li>
						<li><a href="#">SHOW ALL</a></li>
                        <li class="divider"></li>
                        <li><a href="#"></a></li>
                      </ul>
                    </div>
					
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead style="min-width:40px;">
                        <tr>
						  <th>CHK</th>
                          <th>NO.</th>
                          <th><?=Lang::get($lang . '.level');?></th>
                          <th><?=Lang::get($lang . '.assigned_company');?></th>
                          <th><?=Lang::get($lang . '.pay_free');?></th>
						  <th><?=Lang::get($lang . '.assign_extension');?></th>
						  <th><?=Lang::get($lang . '.name');?></th>
						  <th><?=Lang::get($lang . '.id');?></th>
						  <th><?=Lang::get($lang . '.landline');?></th>
						  <th><?=Lang::get($lang . '.mobile');?></th>
						  <th><?=Lang::get($lang . '.memo');?></th>
						  <th><?=Lang::get($lang . '.status');?></th>
						  <th><?=Lang::get($lang . '.period');?></th>
						  <th><?=Lang::get($lang . '.payment');?></th>
						  <th><?=Lang::get($lang . '.action');?></th>
                        </tr>
                      </thead>
                      <tbody>
					<?php 
						foreach($manager as $row): 
					?>
                        <tr>
                          <td><input type="checkbox" /></td>
                          <td></td>
                          <td><?=$row->manager_level;?></td>
                          <td><?=$row->manager_company_name;?></td>
						  <td><?=$row->free_pay;?></td>
						  <td><?=$row->manager_extensions;?></td>
						  <td><?=$row->manager_name;?></td>
						  <td><?=$row->manager_id;?></td>
						  <td><?=$row->manager_landline;?></td>
						  <td><?=$row->manager_mobile;?></td>
						  <td title="<?=$row->manager_memo?>"><?=substr($row->manager_memo,0,25);?>...</td>
						  <td><?=$row->manager_status;?></td>
						  <td><?=$row->account_start_date;?> - <br/><?=$row->account_end_date;?> </td>
						  <td>
						   
							  <?php if($row->payment_status==''){?>
								<a href="#" onclick="javascript:window.open('/company_management/account/add/<?=$row->manager_idx;?>','edit','width=700,height=400,scrollbars=yes, scrollbars=1, toolbar=no, resizable=1,left = 500,top=100')">
									<span class="badge bg-yellow">No Record</span>
								</a> 
							   <?php ;}else{ ?>
								 <a href="#" onclick="javascript:window.open('/company_management/transaction/add/<?=$row->manager_account_id;?>','add','width=700,height=1000,scrollbars=yes, scrollbars=1,left = 500,top=100')">
									<span class="badge bg-<?php if($row->payment_status == 'Unpaid'){ echo 'red';}else if($row->payment_status == 'Paid'){ echo 'green';}?>"><?=$row->payment_status;?></span>
							   <?php } ?>
							 
						  </td>
						  <td> <a href="/company_management/edit/<?=$row->manager_idx;?>" class="btn btn-sm btn-info btn-flat pull-left">EDIT</a></td>
                        </tr>
					<?php endforeach; ?>
						 
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
				
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
    
        </section><!-- /.content -->

		<!--Modal: ADD COMPANY  -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?=Lang::get($lang . '.add_new_company');?></h4>
      </div>

      <div class="modal-body">
       <form action="" method="POST" >
		<div style="float:left;"><?=Lang::get($lang . '.company_name');?></div><div id="company_validate" style="float:right;"><i>NOTE: Company Name must be unique.</i></div>
		<input type="text" class="form-control" name="company_name" required="true" onkeypress="validate_company(this.value)" onblur="validate_company(this.value)">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=Lang::get($lang . '.close');?></button>
        <input type="submit" class="btn btn-primary" id="company_register" value="<?=Lang::get($lang . '.register');?>"  name="save_company"/>
      </div>
	   </form>
    </div>
  </div>
</div>
</div>

<!-- END MODAL -->

@stop