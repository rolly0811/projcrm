<?php
$page = 1;
if(Input::get('page')) {
    $page = Input::get('page');
}
$number = ($total + 1) - (($page * 10)-10);
?>
@foreach($configs as $c)
<tr id="conf-{{ $c->config_id }}">
    <td><input type="checkbox" name="config_id[]" value="{{ $c->config_id }}"></td>
    <td>{{ $number-=1 }}</td>
    <td>{{ $c->manager_company_name }}</td>
    <td>{{ $c->company_ip }}</td>
    <td>
        <a href="" onclick="editconfig({{ $number }}, {{ $c->config_id }}); return false;" class="btn btn-info btn-sm btn-flat">
            <i class="fa fa-edit"></i> <span>Edit</span>
        </a>
        <a href="" onclick="deleteconfig({{ $c->config_id }}); return false;" class="btn btn-danger btn-sm btn-flat">
            <i class="fa fa-trash"></i> <span>Delete</span>
        </a>
    </td>
</tr>
@endforeach
<tr>
    <td colspan="5">
        {!! $configs->render() !!}
    </td>
</tr>

