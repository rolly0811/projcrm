@extends('layout/main')
@section('content')
   <section class="content-header">
          <h1>
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">User</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

              <!-- TABLE: LATEST ORDERS -->

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">LIST</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			
					<div class="btn-group">
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-wrench"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="/user/add">Add</a></li>
                        <li class="divider"></li>
                        <li><a href="#"></a></li>
                      </ul>
                    </div>
					
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
						<tr>
						<td colspan="6">
						<form action="" method="GET">
							<div class="input-group" style="width: 150px;float:right;">
							  <input type="text" name="username" class="form-control input-sm pull-right" placeholder="Search" value="<?=Input::get('username')?>">
							  
							  <div class="input-group-btn">
								<button type="submit "class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
							  </div>
						</form>
							 </div>
						</td>
						</tr>
                        <tr>
                          <th>No.</th>
                          <th>Username</th>
                          <th>Password</th>
                          <th>Email</th>
						  <th>Position</th>
						   <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>TEXT HERE</td>
                          <td><span class="label label-success">TEXT HERE</span></td>
                          <td>TEXT HERE</td>
						  <td>TEXT HERE</td>
						  <td> <a href="" class="btn btn-sm btn-info btn-flat pull-left">EDIT</a></td>
                        </tr>
						     <tr>
                          <td>1</td>
                          <td>TEXT HERE</td>
                          <td><span class="label label-success">TEXT HERE</span></td>
                          <td>TEXT HERE</td>
						  <td>TEXT HERE</td>
						  <td> <a href="" class="btn btn-sm btn-info btn-flat pull-left">EDIT</a></td>
                        </tr>
						     <tr>
                          <td>1</td>
                          <td>TEXT HERE</td>
                          <td><span class="label label-success">TEXT HERE</span></td>
                          <td>TEXT HERE</td>
						  <td>TEXT HERE</td>
						  <td> <a href="" class="btn btn-sm btn-info btn-flat pull-left">EDIT</a></td>
                        </tr>

                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
				
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
    
        </section><!-- /.content -->



@stop