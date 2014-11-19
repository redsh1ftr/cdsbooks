@extends('layouts.master')

@section('main')

<?php include 'C:\xampp\htdocs\cdsbooks\app\views\layouts\invoices.php';?>

{{-- CHECK FOR SUBPOENA + WITNESS FEE--}}

@if(Input::get('subp') > '')
	
	<?php $subpfee = '';?>
	
@elseif(Input::get('suppages') > '')

			<?php $subpfee = '';?>
	
@else

			<?php $subpfee = '39.50';?>

@endif

<?php $witnessfee = CreateInvoice::witnessamt();?>

	<div class="logo">
		
		<img src = "//10.0.1.7:8080/img/logo.png">
	
		<?php 
			$getatty = DB::table('qbatty')->where('name', '=', Input::get('pnum'))->first();
		?>
			<div class="address">
				{{Input::get('addr1')}}<br>
				{{Input::get('addr2')}}<br>
				{{Input::get('addr3')}}<br>
				{{Input::get('addr4')}}<br>
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



			<div class="invoicedatedata">{{Input::get('invdate')}}</div>
			<div class="invoicenumdata">{{Input::get('invnum')}}</div>
			<div class="jobnumdata">{{Input::get('jobnum')}}</div>
			<div class="termsdata">Net 30</div>
			<div class="duedatedata">{{Input::get('duedate')}}</div>
			<div class="filenum"><table width="453px"><td>{{Input::get('filename')}}</td></table>
				<div class="subpdata">
					<table>
						<td width="450px">{{Input::get('prepverb')}}
						<td width="140px">
						<td>{{Input::get('subpamt')}}
					</table>
				
				
			
					<table>
						<td width="450px">{{Input::get('witnessverb')}}
						<td width="140px">
						<td>{{Input::get('witnessamt')}}
					</table>
				




				<div class="jobdata">
					<table>
						<td width="450px">{{Input::get('finalverbiage')}}
						<td width="140px">
						<td>{{number_format(Input::get('lineprice'), 2, '.', '')}}
						<tr>
						<td width="450px">{{Input::get('postage')}}
						<td width="140px">
						<td>{{Input::get('postageamt')}}
					</table>

				</div>	



			</div>
		
	</div>

	<?php 
		$retotal = CreateInvoice::retotal();
	?>

<div class="totaldata">{{number_format($retotal, 2, '.', '')}}</div>	



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



<div class="createinvoice">


{{Form::submit('FIX ISSUES')}}<br><br>


{{Form::close()}}


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
{{Form::hidden('duedate', Input::get('duedate'))}}
{{Form::hidden('duedate', Input::get('duedate'))}}


{{Form::submit('SEND TO SERVER', array('onclick' => 'disableButton(this)'))}}<br><br>

{{Form::close()}}




@stop



