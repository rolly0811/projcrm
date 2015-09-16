<?php $number = Input::get('number')?>
@if($action == 'edit')
<td><input name="id[]" value="{{ $ringgroup->ring_group_id }}" type="checkbox" disabled=""></td>
<td>{{ $number }}</td>
<td>
    <select class="form-control" id="company_id-{{ $ringgroup->ring_group_id }}">
        @foreach($companies as $company)
        <option <?php echo $company->manager_company_id == $ringgroup->manager_company_id_fk ? 'selected' : ''; ?> value="{{ $company->manager_company_id }}">{{ $company->manager_company_name }}</option>
        @endforeach
    </select>
</td>
<td><input type="text" class="form-control" id="ring-group-{{ $ringgroup->ring_group_id }}" value="{{ $ringgroup->ring_group }}"></td>
<td><input type="text" class="form-control" id="ring-group-name-{{ $ringgroup->ring_group_id }}" value="{{ $ringgroup->ring_group_name }}"></td>
<td>
    <a href="" onclick="update({{ $ringgroup->ring_group_id }}, {{ $number }});
                        return false;" class="edit-btn btn btn-sm btn-success btn-flat">
        <i class="fa fa-save"></i> 
        Save
    </a> &nbsp;
    <a href="" onclick="cancel({{ $ringgroup->ring_group_id }}, {{ $number }}); return false;" class="btn btn-sm btn-warning btn-flat">
        <i class="fa fa-close"></i> 
        Cancel
    </a>
</td>

@elseif($action == 'cancel')

<td><input name="id[]" value="{{ $ringgroup->ring_group_id }}" type="checkbox"></td>
<td>{{ $number }}</td>
<td>{{ $ringgroup->manager_company_name }}</td>
<td><span class="label label-success">{{ $ringgroup->ring_group }}</span></td>
<td>{{ $ringgroup->ring_group_name }}</td>
<td>
    <a href="" onclick="edit({{ $ringgroup->ring_group_id }}, {{ $number }}); return false;" class="edit-btn btn btn-sm btn-info btn-flat">
        <i class="fa fa-edit"></i> 
        Edit
    </a> &nbsp;
    <a href="" onclick="delete_ring_group({{ $ringgroup->ring_group_id }}); return false;" class="btn btn-sm btn-danger btn-flat">
        <i class="fa fa-trash"></i> 
        Delete
    </a>
</td>

@endif

