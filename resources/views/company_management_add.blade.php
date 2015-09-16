@extends('layout/pop')
@section('content')
 <?php 
	$manager_session = Session::get('session');
	$lang = 'language.' . $manager_session->manager_language;
  ?>
<section class="content">
  <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=Lang::get($lang . '.company_manager_register');?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="" id="frm_manager" >
                  <div class="box-body">
					<table class="table table-bordered">
                    <tbody>
					<tr STYLE='background-color: #f9f9f9;'><td  colspan='4'>INFORMATION</td></tr>
                    <tr>
						  <td>
							<?=Lang::get($lang . '.name');?>
						  </td>

						  <td>
							<input type="text" class="form-control" name="manager_name" required> 
						  </td>

						  <td>
							<?=Lang::get($lang . '.id');?>
						  </td>
						  
						  <td>
							<p id="manager_validate" style="float:right;"><i></i></p>
							<input type="text" class="form-control" name="manager_id" placeholder="NOTE: ID must be unique." onkeypress="validate_manager(this.value)" onblur="validate_manager(this.value)" required>
						  </td>
                    </tr>
                    
					<tr>
						  <td>
							<?=Lang::get($lang . '.assigned_company');?>
						  </td>

						  <td>
							  <div style="float:left;width:82%;">
								<select name="assigned_company"  class="form-control" required>
									<option></option>
									<?php foreach ($company_list as $row): ?>
									<option value="<?=$row->manager_company_id?>"><?=$row->manager_company_name?></option>
									<?php endforeach; ?>
								</select>
							  </div>
							  <div style="float:right;">
								<a href="" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus-circle" style="padding:5px;"><?=Lang::get($lang . '.add');?></span></a>
							 </div>
						  </td>

						  <td>
							<?php echo Lang::get($lang . '.password');?>
						 </td>

						 <td>
							<input type="text" class="form-control" name="manager_password" required>
						 </td>
                    </tr>

                    <tr>
                      <td><?php echo Lang::get($lang . '.landline');?></td>
                      <td><input type="text" class="form-control" name="landline" ></td>
                      
					  <td><?php echo Lang::get($lang . '.mobile');?></td>
                      <td><input type="text" class="form-control" name="mobile"></td>
                    </tr>

                    <tr>
                      <td><?=Lang::get($lang . '.level');?></td>
                      <td>
							<select name="level"  class="form-control" required>
								<option></option>
								<option value='manager'><?=Lang::get($lang . '.manager');?></option>
								<option value='admin'><?=Lang::get($lang . '.admin');?></option>
							</select>
					  </td>
                     
					  <td><?=Lang::get($lang . '.pay_free');?></td>
                      <td>
							<select name="pay_free"  class="form-control" required>
								<option></option>
								<option value='Pay'><?=Lang::get($lang . '.pay');?></option>
								<option value='Free'><?=Lang::get($lang . '.free');?></option>
							</select>
					  </td>

                    </tr>

					<tr>
                      <td><?php echo Lang::get($lang . '.context');?></td>
                      <td><input type="text" class="form-control" name="context"></td>
                     
					  <td><?php echo Lang::get($lang . '.did');?></td>
                      <td><input type="text" class="form-control" name="did"></td>

                    </tr>

					<tr>
                      <td><?php echo Lang::get($lang . '.assign_extension');?></td>
                      <td><textarea class="form-control" name="assign_extension"></textarea></td>
                     
					  <td colspan="2">ex) 9001/9002/9003</td>
                     
                    </tr>

					<tr>
                      <td><?php echo Lang::get($lang . '.memo');?></td>
                      <td><textarea class="form-control" name="manager_memo"></textarea></td>
                     
					  <td colspan="2"></td>
                     
                    </tr>

                  </tbody></table>

                  </div><!-- /.box-body -->
                  <div class="box-footer">
					<input  type="submit" class="btn btn-info pull-right" value="<?=Lang::get($lang . '.register');?>" name="save_manager"/>
                    <input type="reset" class="btn btn-default pull-left" value="Clear" />
                   
                  </div><!-- /.box-footer -->
                </form>
              </div>

			

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
</section>
@stop
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( ".datepicker" ).datepicker();
  });
  </script>
  
