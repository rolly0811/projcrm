@extends('layout/main')
@section('content')
<?php 
$lang = Session::get('session')->manager_language;
$page = 1;
if(Input::get('page')) {
    $page = Input::get('page');
}
$count = ($ringgroups->count() + ($page * 5) - 5) + 1;
?>
   <section class="content-header">
          <h1>
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Ring Group</li>
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
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <i class="fa fa-check"></i> <strong>{{ Session::get('success') }}</strong>
                    </div>
                    @endif
                  <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <td colspan="4">
                                    <form method="POST" onsubmit="add_ring_group(); return false;" id="newringgroup">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="row">
                                                    <div class="col-sm-4 text-right">
                                                        <label>
                                                            {{ Lang::get('language.' . $lang . '.company') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <select class="form-control select2" name="company_id">
                                                            @foreach($companies as $company)
                                                            <option value="{{ $company->manager_company_id }}">{{ $company->manager_company_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="row">
                                                    <div class="col-sm-5 text-right">
                                                        <label>
                                                            {{ Lang::get('language.' . $lang . '.ring_group') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="ring_group" class="form-control input-sm pull-right" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="row">
                                                    <div class="col-sm-5 text-right">
                                                        <label>
                                                            {{ Lang::get('language.' . $lang . '.ring_group_name') }}
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="ring_group_name" class="form-control input-sm pull-right" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-sm btn-success btn-flat">
                                                    <i class="fa fa-plus"></i>
                                                    <span>Add</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </td>
                                <td colspan="2">
                                    <form action="" method="GET">
                                        <div class="input-group" style="width: 150px;float:right;">
                                            <input type="text" name="username" class="form-control input-sm pull-right" placeholder="Search" value="<?= Input::get('username') ?>">

                                            <div class="input-group-btn">
                                                <button type="submit "class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 60px;">Check</th>
                                <th style="width: 60px;">No.</th>
                                <th style="width: 400px">{{ Lang::get('language.' . $lang . '.company') }}</th>
                                <th>{{ Lang::get('language.' . $lang . '.ring_group') }}</th>
                                <th style="width: 250px">{{ Lang::get('language.' . $lang . '.ring_group_name') }}</th>
                                <th>{{ Lang::get('language.' . $lang . '.action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="ringgroup-list">
                            @foreach($ringgroups as $ringgroup)
                            <tr id="rg-{{ $ringgroup->ring_group_id }}">
                                <td><input type="checkbox" name="id[]" value="{{ $ringgroup->ring_group_id }}"></td>
                                <td>{{ $count-=1 }}</td>
                                <td>{{ $ringgroup->manager_company_name }}</td>
                                <td><span class="label label-success">{{ $ringgroup->ring_group }}</span></td>
                                <td>{{ $ringgroup->ring_group_name }}</td>
                                <td>
                                    <a href="" onclick="edit({{ $ringgroup->ring_group_id }}, {{ $count }}); return false;" class="edit-btn btn btn-sm btn-info btn-flat">
                                        <i class="fa fa-edit"></i> 
                                        {{ Lang::get('language.' . $lang . '.edit') }}
                                    </a> &nbsp;
                                    <a href="" onclick="delete_ring_group({{ $ringgroup->ring_group_id }}); return false;" class="btn btn-sm btn-danger btn-flat">
                                        <i class="fa fa-trash"></i> 
                                        {{ Lang::get('language.' . $lang . '.delete') }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
				
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $ringgroups->render() !!}
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
    
        </section><!-- /.content -->

@stop