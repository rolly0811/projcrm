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

<!--ACCOUNT -->
				  <table class="table table-bordered">
                    <tbody>
					
					<tr STYLE='background-color: #f9f9f9;'><td  colspan='4'>ACCOUNT</td></tr>
                    <tr>
						  <td>
							<?=Lang::get($lang . '.start_date');?>
						  </td>

						  <td>
							<input type='date' class='datepicker' name="start_date" class="form-control" required/>
						  </td> 

						  <td>
							<?=Lang::get($lang . '.end_date');?>
						  </td>
						  
						  <td>
							<input type='date' class='datepicker' name="end_date" class="form-control" required/>
						  </td>
                    </tr>
                    
					<tr>
						 <td><?=Lang::get($lang . '.months');?></td>
						 <td><input type="text" class="form-control" name="months" required></td>
						
						 <td><?php echo Lang::get($lang . '.total_price');?></td> 
						 <td><input type="text" class="form-control" name="total_price" required></td>
                    </tr>
                  </tbody>
				 </table>  
                  </div><!-- /.box-body -->
                  <div class="box-footer">
					<input  type="submit" class="btn btn-info pull-right" value="<?=Lang::get($lang . '.register');?>" name="save_manager"/>
                    <input type="reset" class="btn btn-default pull-left" value="Clear" />
                   
                  </div><!-- /.box-footer -->
                </form>
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
  
