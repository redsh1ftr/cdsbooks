@extends('layouts.pdf')

@section('main')



	<div class="logo">
		
		<img src = "C:/xampp/htdocs/img/logo.png"><br>
	
		
			<div class="address">
				{{$addr1}}<br>
				{{$addr2}}<br>
				{{$addr3}}<br>
				{{$addr4}}<br>
			</div>


			<div class="invoice">
				<h1>INVOICE</h1>
			</div>

			<div class="invoicedate">Date</div>

			<div class="invoicenum">Invoice #</div>

			<div class="jobnum">CDS Job Number</div>

			<div class="terms">Terms</div>

			<div class="duedate">Due Date</div>

			<div class="description">Description</div>

			<div class="amount">Amount</div>

			<div class="total"><b>Total</b></div>

			<div class="paymentinstr" style="font-size:14px">
				Federal Tax ID # 38-3258320. Please submit payment and a copy of invoice to insure proper credit to the above address. Should you have any questions regarding this invoice, do not hesitate to call our accounting department for an explanation or correction. Invoices over 30 days delinquent may be subject to late fees and interest charges.
			
				<br><br>

				CD Services now offers credit card payments on a one-time or recurring basis. Please call for details.

				<h2>Thank you for the opportunity to be of service.</h2>

				<br>

				accounting@cdservicesinc.com
			</div>	



			<div class="invoicedatedata">{{$invdate}}</div>
			<div class="invoicenumdata">{{$invnum}}</div>
			<div class="jobnumdata">{{$jobnum}}</div>
			<div class="termsdata">Net 30</div>
			<div class="duedatedata">{{$duedate}}</div><br>
			<div class="filenum"></div>
			


				<div class="lineitems">
			
				@foreach($lineitems as $lines)
					
					@if($lines->price > '')
					<table>
						<tr><td width="453px">{{$lines->description}}</td>
						<td width="130px">&nbsp;<img src = "C:/xampp/htdocs/img/space.png"></td>
						<td width="130px">{{$lines->price}}</td></tr>
					</table>

					@else
						<table width="453px">

						<tr><td>{{$lines->description}}</td>
						
					</table>
					@endif

				@endforeach
		
	</div>

	

<div class="totaldata">{{ number_format(ToQuickbooks::where('inv_number', $invnum)->sum('price'), 2, '.','') }}</div>	

@stop



