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

<!-- TOTAL -->

  <table class="table table-striped">
					<tr>
							<?php foreach($total as $row1):?>
								<td>Total Price: <?=number_format($row1->total_price)?></td>
								<td></td>
							    <td><span class="badge bg-<?php if($row1->payment_status == 'Unpaid'){ echo 'red';}else{ echo 'green';}?> pull-right"><font size='4'><?=$row1->payment_status?></span></font></td>
							<?php endforeach; ?>
					</tr>
				  </table>

				  <br/>


<!--PAYMENT-->
<?php if($row1->payment_status == 'Unpaid'){ ?>
			 <table class="table table-bordered">
                    <tbody>
						<tr STYLE='background-color: #f9f9f9;'><td  colspan='4'>PAYMENT</td></tr>
						<tr>
							  <td>AMOUNT PAID</td>
							  <td><input type="text" class="form-control" name="paid_amount" required></td> 

							  <td>DATE OF PAYMENT</td>
							  <td><input type="date" class="form-control" name="payment_date" required></td> 
						</tr>
						<tr>
							  <td>REMARKS</td>
							  <td>
								
								<select name='remarks' class='form-control' required>
									<option>CHOOSE MODE OF PAYMENT</option>
									<option value='full'>Full Payment</option>
									<option value='down'>Down Payment</option>
									<option value='partial'>Partial Payment</option>
							  </td> 

							  <td></td>
							  <td></td> 
						</tr>
						
						<TR>
						
							<TD COLSPAN='4'><input  type="submit" name="add_transaction" class="btn btn-info pull-right" value="<?=Lang::get($lang . '.register');?>" /></TD>
							
						</TR>
					
                  </tbody>
			</table>
<?php } ?>
<?php if($row1->payment_status == 'Paid'){ ?>
			 

			<div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                            MAKE NEW PAYMENT
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="box-body">
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
						<TR>
						
							<TD COLSPAN='4'><input  type="submit" class="btn btn-info pull-right" value="<?=Lang::get($lang . '.register');?>" name="add_new_account"/></TD>
							
						</TR>
					
                  </tbody>
			</table>
                        </div>
                      </div>
                    </div>
<?php } ?>
<br/>
<!--HISTORY -->
				
				  <table class="table table-bordered">
                    <tbody>
					

					<tr STYLE='background-color: #f9f9f9;'><td  colspan='3'>Transaction History</td></tr>
					
					<tr>
						<th>Paid Amount</th>
						<th>Payment Date</th>
						<th>Remarks</th>
					</tr>
                   <?php 
						$total_paid = 0;
						
						foreach($transaction_history as $row):
						
							$total_paid = $total_paid + $row->paid_amount;
				   ?>
					<tr>
						  <td><?=$row->paid_amount;?></td>
						  <td><?=$row->payment_date;?></td>
						  <td><?=$row->remarks;?></td>
                    </tr>
					<?php endforeach; ?>
					<tr  style='background-color:#FFE1D8;'>
						<td>Balance</td>
						<td colspan='2'><?=number_format($row1->total_price - $total_paid) ?>
					</tr>

                    
				
                  </tbody>
				 </table>
<BR/><BR/>
				 <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                            VIEW OLDER PAYMENT HISTORY
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="box-body">
								
							<table class="table table-bordered">
							 <tbody>
								<tr>
									<th><?=Lang::get($lang . '.start_date');?></th>
									<th><?=Lang::get($lang . '.end_date');?></th>
									<th><?=Lang::get($lang . '.months');?></th>
									<th><?=Lang::get($lang . '.total_price');?></th>
									<th><?=Lang::get($lang . '.date_of_receipt');?></th>
									<th><?=Lang::get($lang . '.payment_status');?></th>
									
								</tr>
							  <?php foreach($old_history as $row2): ?>
								<tr>
									<td><?=$row2->account_start_date ?></td>
									<td><?=$row2->account_end_date ?></td>
									<td><?=$row2->months ?></td>
									<td><?=number_format($row2->total_price) ?></td>
									<td><?=$row2->register_date ?></td>
									<td><?=$row2->payment_status ?></td>
								</tr>
							  <?php endforeach;?>

						   </tbody>
						 </table>
                        </div>
                      </div>
                    </div>

                  </div><!-- /.box-body -->
                  <div class="box-footer">
					
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
  
