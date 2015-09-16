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
			
			<table style="width:100%;margin:5px;" >
                      <thead>
					  <form action="" method="GET">
						<tr style='float:right'>
							<td>
								<select class='form-control' name='manager_status'>
									<option value='' <?php if(Input::get('manager_status') == 'all'){ echo 'selected';}?>>All</option>
									<option value='Active' <?php if(Input::get('manager_status') == 'Active'){ echo 'selected';}?>>Active</option>
									<option value='In-Active' <?php if(Input::get('manager_status') == 'In-Active'){ echo 'selected';}?>>In-Active</option>
								</select>
							</td>
							<td><input type="text" name="search" class="form-control" placeholder="By Name or Company" value="<?=Input::get('search')?>"</td>
							<td><button type="submit "class="btn  btn-default" name="btn_search"><i class="fa fa-search"></i></button></td>
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
					
               
						 
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
				
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
					
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
    
        </section><!-- /.content -->



<!-- END MODAL -->


@stop