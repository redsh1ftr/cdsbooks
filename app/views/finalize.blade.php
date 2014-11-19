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
			<div class="duedatedata" style="max-width:450px">{{$duedate}}</div><br>
			<div class="filenum"><table width="453px"><tr><td>{{$filename}}</td></tr></table>

				<div class="subpdata">
			@if($prepverb > '')
					<table>
						<tr><td width="450px">{{$prepverb}} </td>
							<td> </td>
						<td style="width:145px">&nbsp;<img src = "C:/xampp/htdocs/img/space.png">{{$subpamt}}</td></tr>
					</table>
			@endif	
				
			@if($witnessverb > '')
					<table>
						<tr><td width="450px">{{$witnessverb}}</td>
						<td></td>
						<td width="145px">&nbsp;<img src = "C:/xampp/htdocs/img/space.png">{{$witnessamt}}</td></tr>
					</table>
			@endif
 



				<div class="jobdata">
					<table><tr>
						<td width="450px">{{$finalverbiage}}</td>
						<td></td>
						<td width="145px">&nbsp;<img src = "C:/xampp/htdocs/img/space.png">{{$lineprice}}</td>
						</tr><tr>

						<td width="450px">{{$postage}}</td>
						<td></td>
						<td>&nbsp;<img src = "C:/xampp/htdocs/img/space.png">{{$postageamt}}</td>
					</table>

				</div>	



			</div>
		
	</div>

	

<div class="totaldata">{{$total}}</div>	

@stop



