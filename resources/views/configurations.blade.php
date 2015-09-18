@extends('layout/main')
@section('content')
<?php
$lang = Session::get('session')->manager_language;
$page = 1;
if(Input::get('page')) {
    $page = Input::get('page');
}
$number = ($total + 1) - (($page * 10)-10);

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
                                <form action="" method="post" id="config-form" onsubmit="addconfig(); return false;">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>{{ Lang::get('language.' . $lang . '.company') }}</label> 
                                            <select class="form-control" name="company_id">
                                                @foreach($companies as $company)
                                                <option value="{{ $company->manager_company_id }}">{{ $company->manager_company_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ Lang::get('language.' . $lang . '.cti_ip') }}</label> 
                                            <input type="text" name="cti_ip" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-sm btn-flat">
                                                <i class="fa fa-plus"></i> <span>Add</span>
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
                            <th>Check</th>
                            <th>No.</th>
                            <th style="width: 350px;">{{ Lang::get('language.' . $lang . '.company') }}</th>
                            <th style="width: 450px;">{{ Lang::get('language.' . $lang . '.cti_ip') }}</th>
                            <th>{{ Lang::get('language.' . $lang . '.action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="config-list">
                        @foreach($configs as $c)
                        <tr id="conf-{{ $c->config_id }}">
                            <td><input type="checkbox" name="config_id[]" value="{{ $c->config_id }}"></td>
                            <td>{{ $number-=1 }}</td>
                            <td>{{ $c->manager_company_name }}</td>
                            <td>{{ $c->company_ip }}</td>
                            <td>
                                <a href="" class="btn btn-info btn-sm btn-flat" onclick="editconfig({{ $number }}, {{ $c->config_id }}); return false;">
                                    <i class="fa fa-edit"></i> <span>Edit</span>
                                </a>
                                <a href="" onclick="deleteconfig({{ $c->config_id }}); return false;" class="btn btn-danger btn-sm btn-flat">
                                    <i class="fa fa-trash"></i> <span>Delete</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <td colspan="5">
                            {!! $configs->render() !!}
                        </td>
                    </tbody>
                </table>
            </div><!-- /.table-responsive -->

        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
        </div><!-- /.box-footer -->
    </div><!-- /.box -->

</section><!-- /.content -->

@stop