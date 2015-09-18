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
            <li class="active"><?=Lang::get($lang . '.company_management');?></li>
			 <li class="active">Edit</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

              <!-- TABLE: LATEST ORDERS -->

			   <table class="table no-margin">
                      <thead>
						<tr>
						<td colspan="100%">
						<form action="" method="GET" >
							<div class="input-group" style="width: 150px;float:right;">
							  <input type="text" name="username" class="form-control input-sm pull-right" placeholder="Search" value="<?=Input::get('username')?>">
							  
							  <div class="input-group-btn">
								<button type="submit "class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
							  </div>
						</form>
							 </div>
						</td>
						</tr>
				</table>

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">EDIT</h3>
                  <div class="box-tools pull-right">
					<a href='/company_management'><i class='fa fa-long-arrow-left'> Back to List</i></a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">

					<?php 
				
						foreach($manager_edit as $row): 

					?>
								
						 <form class="form-horizontal" method="POST" action="" id="frm_manager">
                  <div class="box-body">
					<table class="table table-bordered">
                    <tbody>
					
                    <tr>
						  <td><?=Lang::get($lang . '.name');?></td>
						  <td><input type="text" class="form-control" name="manager_name" value="<?=$row->manager_name;?>" required> </td>

						  <td><?=Lang::get($lang . '.id');?></td>
						  <td><input type="text" class="form-control" name="manager_id" placeholder="NOTE: ID must be unique." value="<?=$row->manager_id;?>" required disabled></td>
                    </tr>
                    
					<tr>
						  <td><?=Lang::get($lang . '.assigned_company');?> </td>
						  <td>
								<select name="assigned_company"  class="form-control" required>
									<option></option>
									<?php foreach ($company_list as $rows): ?>
									<option value="<?=$rows->manager_company_id?>" <?php if($row->manager_company_id == $rows->manager_company_id){ echo 'selected';}?>><?=$rows->manager_company_name?></option>
									<?php endforeach; ?>
								</select>
						  </td>

						  <td><?php echo Lang::get($lang . '.password');?></td>
						  <td><input type="text" class="form-control" name="manager_password" value="<?=$row->manager_password?>" required></td>
                    </tr>

                    <tr>
                      <td><?php echo Lang::get($lang . '.landline');?></td>
                      <td><input type="text" class="form-control" name="landline" value="<?=$row->manager_landline;?>" ></td>
                      
					  <td><?php echo Lang::get($lang . '.mobile');?></td>
                      <td><input type="text" class="form-control" name="mobile" value="<?=$row->manager_mobile;?>"></td>
                    </tr>

                    <tr>
                      <td><?=Lang::get($lang . '.level');?></td>
                      <td>
							<select name="level"  class="form-control" required>
								<option></option>
								<option value='manager' <?php if($row->manager_level == 'manager'){ echo 'selected';}?>><?=Lang::get($lang . '.manager');?></option>
								<option value='admin' <?php if($row->manager_level == 'admin'){ echo 'selected';}?>><?=Lang::get($lang . '.admin');?></option>
							</select>
					  </td>
                     
					  <td><?=Lang::get($lang . '.pay_free');?></td>
                      <td>
							<select name="pay_free"  class="form-control" required>
								<option></option>
								<option value='Pay' <?php if($row->free_pay == 'Pay'){ echo 'selected';}?>><?=Lang::get($lang . '.pay');?></option>
								<option value='Free' <?php if($row->free_pay == 'Free'){ echo 'selected';}?>><?=Lang::get($lang . '.free');?></option>
							</select>
					  </td>

                    </tr>

					<tr>
                      <td><?php echo Lang::get($lang . '.context');?></td>
                      <td><input type="text" class="form-control" name="context" value="<?=$row->manager_context?>"></td>
                     
					  <td><?php echo Lang::get($lang . '.did');?></td>
                      <td><input type="text" class="form-control" name="did" value="<?=$row->did?>"></td>

                    </tr>

					<tr>
                      <td><?php echo Lang::get($lang . '.assign_extension');?></td>
                      <td><textarea class="form-control" name="assign_extension"><?=$row->manager_extensions?></textarea></td>
                     
					  <td colspan="2">ex) 9001/9002/9003</td>
                     
                    </tr>

					<tr>
                      <td><?php echo Lang::get($lang . '.memo');?></td>
                      <td><textarea class="form-control" name="manager_memo"><?=$row->manager_memo?></textarea></td>
                     
					  <td><?=Lang::get($lang . '.status');?></td>
					   <td>
							<select name="manager_status"  class="form-control" required>
								<option></option>
								<option value='Active' <?php if($row->manager_status == 'Active'){ echo 'selected';}?>><?=Lang::get($lang . '.active');?></option>
								<option value='In-Active' <?php if($row->manager_status == 'In-Active'){ echo 'selected';}?>><?=Lang::get($lang . '.in-active');?></option>
							</select>
					  </td>
                     
                    </tr>

                  </tbody>
				</table>
                   
                  </div><!-- /.box-body -->
                  <div class="box-footer">
					<input  type="submit" class="btn btn-info pull-right" value="<?=Lang::get($lang . '.register');?>" name="save_manager" id='updated'/>
                    <input type="reset" class="btn btn-default pull-left" value="Reset" />
                   
                  </div><!-- /.box-footer -->
                </form>



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


  <script>
        $("#frm_manager").submit(function(){
			swal('Data Updated!', 'Updated', 'success');
	  });
  </script>

@stop