@extends('layout/pop')
@section('content')
 <?php $manager_session = Session::get('session');
	   $language = $manager_session->manager_language; 
	   if($language == 0)
	   {
			$lang = 'language.en';
	   }
	   else if($language == 1)
	   {
			$lang = 'language.kr';
	   }	
?>
<section class="content">
  <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo Lang::get($lang . '.add_company');?>r</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
					<table class="table table-bordered">
                    <tbody>
					
                    <tr>
                      <td><?php echo Lang::get($lang . '.company_name');?></td>
                      <td><input type="text" class="form-control" name="manager_name" ></td>
                    </tr>
               
                  </tbody></table>
                   
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-info pull-right">Save</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>


</div>

</section>
@stop