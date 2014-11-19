@extends('layouts.master')


<?php include 'C:\xampp\htdocs\cdsbooks\app\views\layouts\invoices.php';?>



@section('main')

<div style="margin-left:150px">



{{Form::open(array('url' => '/makeinvoicenow'))}}




{{-- CHECK FOR SUBPOENA + WITNESS FEE--}}

<?php 
$subpfee = Input::get('subpamt');
$witnessfee = CreateInvoice::witnessamt();?>




{{-- END SUBPOENA FEE CHECK --}}









	<div class="logo">
		
		<img src = "//10.0.1.7:8080/img/logo.png">
		<?php 

		$lineitems = DB::table('attorney_file_select')->get();
		$items = DB::table('qbitem_listfull')->get();
			$getatty = DB::table('qbatty')->where('name', '=', Input::get('pnum'))->first();
		?>
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
			<div class="invoicenumdata">{{ Form::text('invnum', Input::get('invnum'), array('style' => 'width:70px'))}}</div>
			<div class="jobnumdata">{{Input::get('jobnum')}}</div>
			<div class="termsdata">Net 30</div>
			<div class="duedatedata">{{ Form::text('duedate', Input::get('duedate'), array('style' => 'width:65px'))}}</div>
			<div class="filenum">
				


	


<table>
					<td>
					 	<select name="rev_acct_1"  style="max-width:70px"> 

					 		<option selected="selected">
					 				{{Input::get('rev_acct_1')}}
								</option>

					 		

					 		@foreach($lineitems as $lines)
					 		
							<option value="{{  $lines->description   }}"=>{{ $lines->item }}<br>
							@endforeach
						</select>
					@if(Input::get('julietaylor') == 'jt')
					<td>{{Form::text('filename', "YOUR FILE # $caseinfo->claim", array('style' => 'height:20px'))}}
				@else
					<td>{{Form::text('filename', "", array('style' => 'height:20px'))}}
				@endif
				
				</table>

				<div class="subpdata">
				@if($subpfee == 39.50)	
					<table>
						<td>
						 	<select name="rev_acct_2"  style="max-width:70px">
						 		<option selected="selected">
					 				{{Input::get('rev_acct_2')}}
								</option>
						 	@foreach($items as $lines)
								<option value="{{  $lines->item   }}"=>{{ $lines->item }}<br>
							@endforeach
							</select>
						<td width="450px">{{ Form::textarea('prepverb', Input::get('prepverb'), array('style' => 'max-height:40px'))}}
						<td width="120px">
						<td>{{ Form::text('subpamt', Input::get('subpamt'), array('style' => 'width:50px'))}}
					</table>
				@endif
				
				@if($witnessfee > '')	
					<table>
						<td>
						 	<select name="rev_acct_3"  style="max-width:70px"> 
						 		<option selected="selected">
					 				{{Input::get('rev_acct_3')}}
								</option>
						 		@foreach($lineitems as $lines)
								<option value="{{  $lines->item   }}"=>{{ $lines->item }}<br>
								@endforeach
							</select>
						<td width="470px">{{ Form::text('witnessverb', Input::get('witnessverb'))}}
						<td width="120px">
						<td>{{ Form::text('witnessamt', Input::get('witnessamt'), array('style' => 'width:50px'))}}
					</table>
				@endif


				<div class="jobdata">
					<table>

					 <td><select name="rev_acct_4"  style="max-width:70px"> 
					 			<option selected="selected">
					 				{{Input::get('rev_acct_4')}}
								</option>

					 	@foreach($lineitems as $lines)



						<option value="{{  $lines->item   }}"=>{{ $lines->item }}<br>
						@endforeach</select>
					 <td>{{Form::textarea('finalverbiage', Input::get('finalverbiage'), array('style' => 'height:100px'))}}
					 <td>{{ Form::text('lineprice', Input::get('lineprice'), array('style' => 'width:50px; padding-left:75px'))}}
					 </table>

					 <table>
					 	<td>
						 	<select name="rev_acct_5"  style="max-width:70px"> @foreach($lineitems as $lines)
						 		<option selected="selected">
					 				{{Input::get('rev_acct_5')}}
								</option>

						 		
								<option value="{{  $lines->item   }}"=>{{ $lines->item }}<br>
								@endforeach
							</select>
						<td style="width:450px">{{ Form::text('postage', Input::get('postage'), array('style' => 'width:150px'))}}
						
						<td>{{ Form::text('postageamt', Input::get('postageamt'), array('style' => 'width:50px'))}}
						
					</table>



					</div>
				</div>	



		
	</div>

	<?php 
		$retotal = CreateInvoice::retotal();
	?>

<div class="totaldata">{{ number_format($retotal, 2, '.', '')}}</div>	






{{Form::hidden('total', Input::get('total'))}}
{{Form::hidden('jobnum', Input::get('jobnum'))}}


<div class="createinvoice">
{{Form::submit('CREATE INVOICE')}}<br><br>



{{Form::close()}}

<br>
{{Form::open(array('route' => 'fix_invoice', 'method' => 'POST'))}}
{{Form::hidden('pnum', Input::get('pnum'))}}
{{Form::hidden('jobnum', Input::get('jobnum'))}}
{{Form::hidden('postageamt', Input::get('postageamt'))}}
{{Form::hidden('finalverbiage', Input::get('finalverbiage'))}}
{{Form::hidden('lineprice', Input::get('lineprice', 2, '.', ''))}}
{{Form::hidden('postage', Input::get('postage'))}}
{{Form::hidden('addr1', Input::get('addr1'))}}
{{Form::hidden('addr2', Input::get('addr2'))}}
{{Form::hidden('addr3', Input::get('addr3'))}}
{{Form::hidden('addr4', Input::get('addr4'))}}
{{Form::hidden('lineprice', Input::get('lineprice'))}}
{{Form::hidden('prepverb', Input::get('prepverb'))}}
{{Form::hidden('subpamt', Input::get('subpamt'))}}
{{Form::hidden('total', $retotal)}}
{{Form::hidden('invdate', Input::get('invdate'))}}
{{Form::hidden('filename', Input::get('filename'))}}
{{Form::hidden('invnum', Input::get('invnum'))}}
{{Form::hidden('rev_acct_1', Input::get('rev_acct_1'))}}
{{Form::hidden('rev_acct_2', Input::get('rev_acct_2'))}}
{{Form::hidden('rev_acct_3', Input::get('rev_acct_3'))}}
{{Form::hidden('rev_acct_4', Input::get('rev_acct_4'))}}
{{Form::hidden('rev_acct_5', Input::get('rev_acct_5'))}}
{{Form::hidden('witnessverb', Input::get('witnessverb'))}}
{{Form::hidden('witnessamt', Input::get('witnessamt'))}}
{{Form::hidden('duedate', Input::get('duedate'))}}


{{Form::submit('FIX ISSUES')}}<br><br>

{{Form::close()}}
{{link_to_route('new_invoice', 'START OVER')}}


<br><br>
{{Form::open(array('route' => 'finalize', 'method' => 'POST'))}}
{{Form::hidden('pnum', Input::get('pnum'))}}
{{Form::hidden('jobnum', Input::get('jobnum'))}}
{{Form::hidden('postageamt', Input::get('postageamt'))}}
{{Form::hidden('finalverbiage', Input::get('finalverbiage'))}}
{{Form::hidden('lineprice', Input::get('lineprice', 2, '.', ''))}}
{{Form::hidden('postage', Input::get('postage'))}}
{{Form::hidden('addr1', Input::get('addr1'))}}
{{Form::hidden('addr2', Input::get('addr2'))}}
{{Form::hidden('addr3', Input::get('addr3'))}}
{{Form::hidden('addr4', Input::get('addr4'))}}
{{Form::hidden('lineprice', Input::get('lineprice'))}}
{{Form::hidden('prepverb', Input::get('prepverb'))}}
{{Form::hidden('subpamt', Input::get('subpamt'))}}
{{Form::hidden('total', $retotal)}}
{{Form::hidden('invdate', Input::get('invdate'))}}
{{Form::hidden('filename', Input::get('filename'))}}
{{Form::hidden('invnum', Input::get('invnum'))}}
{{Form::hidden('witnessverb', Input::get('witnessverb'))}}
{{Form::hidden('witnessamt', Input::get('witnessamt'))}}
{{Form::hidden('rev_acct_1', Input::get('rev_acct_1'))}}
{{Form::hidden('rev_acct_2', Input::get('rev_acct_2'))}}
{{Form::hidden('rev_acct_3', Input::get('rev_acct_3'))}}
{{Form::hidden('rev_acct_4', Input::get('rev_acct_4'))}}
{{Form::hidden('rev_acct_5', Input::get('rev_acct_5'))}}
{{Form::hidden('duedate', Input::get('duedate'))}}


{{Form::submit('SEND TO SERVER', array('onclick' => 'disableButton(this)'))}}<br><br>

{{Form::close()}}


</div>


@stop










