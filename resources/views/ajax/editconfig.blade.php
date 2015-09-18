@if(Input::get('action') == 'edit')
<td><input type="checkbox" name="config_id[]" value="{{ $config->config_id }}" disabled=""></td>
<td>{{ $number }}</td>
<td><select id="company_id-{{ $config->config_id }}" class="form-control">
        @foreach($companies as $company)
        <option value="{{ $company->manager_company_id }}" <?php echo $company->manager_company_id == $config->manager_company_id_fk ? 'selected' : ''; ?>>
                {{ $company->manager_company_name }}
        </option>
        @endforeach
    </select>
    </td>
    <td><input type="text" class="form-control" id="company_ip-{{ $config->config_id }}" value="{{ $config->company_ip }}"></td>
<td>
    <a href="" class="btn btn-success btn-sm btn-flat" onclick="updateconfig({{ $number }}, {{ $config->config_id }}); return false;">
        <i class="fa fa-save"></i> <span>Save</span>
    </a>
    <a href="" onclick="cancel_config({{ $number }}, {{ $config->config_id }}); return false;" class="btn btn-warning btn-sm btn-flat">
        <i class="fa fa-close"></i> <span>Cancel</span>
    </a>
</td>
@else
<td><input type="checkbox" name="config_id[]" value="{{ $config->config_id }}"></td>
<td>{{ $number }}</td>
<td>{{ $config->manager_company_name }}</td>
<td>{{ $config->company_ip }}</td>
<td>
    <a href="" class="btn btn-info btn-sm btn-flat" onclick="editconfig({{ $number }}, {{ $config->config_id }}); return false;">
        <i class="fa fa-edit"></i> <span>Edit</span>
    </a>
    <a href="" class="btn btn-danger btn-sm btn-flat">
        <i class="fa fa-trash"></i> <span>Delete</span>
    </a>
</td>
@endif