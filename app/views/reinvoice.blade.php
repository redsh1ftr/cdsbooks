@extends('layouts.master')


<?php include 'C:\xampp\htdocs\cdsbooks\app\views\layouts\invoices.php';?>



{{-- CHECK FOR SUBPOENA + WITNESS FEE--}}

@if(Input::get('subp') > '')
	
	<?php $subpfee = '';?>
	
@elseif(Input::get('suppages') > '')

			<?php $subpfee = '';?>
	
@else

			<?php $subpfee = '39.50';?>

@endif

<?php $witnessfee = Input::get('witness');?>



@section('main')
<?php
	$lineitems = DB::table('attorney_file_select')->get();
	$items = DB::table('qbitem_listfull')->get();
?>


<div style="margin-left:150px">



{{Form::open(array('url' => '/makeinvoicenow'))}}







<?php $jobinfo = DB::table('lojob')->where('jobnum', '=', Input::get('jobnum'))->first();?>
<?php $caseinfo = DB::table('locases')->where('casenum', '=', $jobinfo->casenum)->first();?>



	<div class="logo">
		<?php $linetotal = CreateInvoice::reproduction_price() + CreateInvoice::postage() + $subpfee + $witnessfee;?>
		
		<img src = "http://10.0.1.7:8080/img/logo.png">
		

			<div class="address">
				{{ Form::text('addr1', Input::get('addr1'))}}<br>
				{{ Form::text('addr2', Input::get('addr2'))}}<br>
				{{ Form::text('addr3', Input::get('addr3'))}}<br>
				{{ Form::text('addr4', Input::get('addr4'))}}<br>
			</div>

			<div class="invoice">
				<h1>INVOICE</h1>
			</div>

			<div class="invoicedate">Date</div>

			<div class="invoicenum">Invoice #</div>

			<div class="jobnum">Job Number</div>

			<div class="terms">Terms</div>

			<div class="duedate">Due Date</div>

			<div class="description">Description</div>

			<div class="amount">Amount</div>

			<div class="total"><b>Total</b></div>

			<div class="paymentinstr">
				Federal Tax ID # 38-3258320. Please submit payment and a copy of invoice to insure proper credit to the above address. Should you have any questions regarding this invoice, do not hesitate to call our accounting department for an explanation or correction. Invoices over 30 days delinquent may be subject to late fees and interest charges.
			
				<br><br>

				CD Services now offers credit card payments on a one-time or recurring basis. Please call for details.

				<h2>Thank you for the opportunity to be of service.</h2>

				<br>

				accounting@cdservicesinc.com
			</div>	



			<div class="invoicedatedata">{{ Form::text('invdate', Carbon::parse('today')->format('m/d/Y'), array('style' => 'width:65px'))}}</div>
			<div class="invoicenumdata">{{ Form::text('invnum', CreateInvoice::get_invoicenum(), array('style' => 'width:70px'))}}</div>
			<div class="jobnumdata">{{Input::get('jnum')}}</div>
			<div class="termsdata">Net 30</div>
			<div class="duedatedata">{{ Form::text('duedate', Carbon::parse('today')->addDays('30')->format('m/d/Y'), array('style' => 'width:65px'))}}</div>
			<div class="filenum">
				


	


<table>
					<td>
					 	<select name="rev_acct_1"  style="max-width:70px"> 

					 		

					 		@foreach($lineitems as $lines)
					 		
							<option value="{{  $lines->description   }}"=>{{ $lines->item }}<br>
							@endforeach
						</select>
					<td>{{Form::textarea('filename', "YOUR FILE # $caseinfo->claim 44", array('style' => 'height:20px'))}}
				
				</table>

				<div class="subpdata">
				@if($subpfee == 39.50)	
					<table>
						<td>
						 	<select name="rev_acct_2"  style="max-width:70px">

						 	@foreach($items as $lines)
								<option value="{{  $lines->item   }}"=>{{ $lines->item }}<br>
							@endforeach
							</select>
						<td width="450px">{{ Form::textarea('prepverb', Input::get('prepverb'), array('style' => 'max-height:40px'))}}
						<td width="120px">
						<td>{{ Form::text('subpamt', $subpfee, array('style' => 'width:50px'))}}
					</table>
				@endif
				
				@if($witnessfee > 0)	
					<table>
						<td>
						 	<select name="rev_acct_3"  style="max-width:70px"> 
						 		<option selected="selected">
					 				40004 - Facility Fee
								</option>
						 		@foreach($lineitems as $lines)
								<option value="{{  $lines->item   }}"=>{{ $lines->item }}<br>
								@endforeach
							</select>
						<td width="470px">{{ Form::text('witnessverb', "Facility Fee")}}
						<td width="120px">
						<td>{{ Form::text('witnessamt', number_format($witnessfee, 2, '.', ''), array('style' => 'width:50px'))}}
					</table>
				@endif


				<div class="jobdata">
					<table>

					 <td><select name="rev_acct_4"  style="max-width:70px"> 
					 			<option selected="selected">
					 				{{CreateInvoice::revenue()}}
								</option>

					 	@foreach($lineitems as $lines)



						<option value="{{  $lines->item   }}"=>{{ $lines->item }}<br>
						@endforeach</select>
					 <td>{{Form::textarea('finalverbiage', CreateInvoice::verbiage(), array('style' => 'height:100px'))}}
					 <td>{{ Form::text('lineprice', number_format(CreateInvoice::reproduction_price(), 2, '.', ''), array('style' => 'width:50px; padding-left:75px'))}}
					 </table>

					 <table>
					 	<td>
						 	<select name="rev_acct_5"  style="max-width:70px"> @foreach($lineitems as $lines)
						 		<option selected="selected">
					 				40015 - Postage and Handling
								</option>

						 		
								<option value="{{  $lines->item   }}"=>{{ $lines->item }}<br>
								@endforeach
							</select>
						<td style="width:450px">{{ Form::text('postage', 'Postage and Handling', array('style' => 'width:150px'))}}
						
						<td>{{ Form::text('postageamt', number_format(CreateInvoice::postage(), 2, '.', ''), array('style' => 'width:50px'))}}
						
					</table>



					</div>
				</div>	



		
	</div>
<div class="totaldata">{{ number_format($linetotal, 2, '.', '')}}</div>	







{{Form::hidden('jobnum', Input::get('jnum'))}}
{{Form::hidden('total', Input::get('newtotal'))}}


<div class="createinvoice">
{{Form::submit('CREATE INVOICE')}}<br><br>
<a href="./newinv" class="submit">START OVER</a>


{{Form::close()}}

<table>


</div>



@stop











