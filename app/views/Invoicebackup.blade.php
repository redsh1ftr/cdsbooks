@extends('layouts.master')

@section('main')

<?php 
	$pagetotal = 0;
	$pages = 0;
?>

{{--SPECIAL INVOICES LOGIC --}}

	<?php 
		$nrscheck = Input::get('nrs');
		$includedcheck = Input::get('included');
		$cancelledcheck = Input::get('cancelled');
		$settledcheck = Input::get('settled');

	if($nrscheck == 1){
		$shipping = 6.00;
	} else {
		$shipping = Input::get('ship');
	};

	if($includedcheck == 1){
		$shipping = 6.00;
		$includedjob = Input::get('incjob');
	} else {
		$shipping = Input::get('ship');
	};

	if($cancelledcheck == 1){
		$shipping = 6.00;
	} else {
		$shipping = Input::get('ship');
	};

	if($settledcheck == 1){
		$shipping = 6.00;
	} else {
		$shipping = Input::get('ship');
	};

	?>


{{-- END SPECIAL INVOICE LOGIC --}}


{{-- CHECK FOR SUBPOENA FEE--}}

@if(Input::get('subp') > '')
	
	<?php $subpfee = '';?>
	
		@elseif(Input::get('suppages') > '')

			<?php $subpfee = '';?>
		
		@else

			<?php $subpfee = '39.50';?>

		@endif


{{-- END SUBPOENA FEE CHECK --}}



{{-- BEGIN PAPER PAGES PRICE LOGIC --}}



@if(Input::get('digitalpaper') == 'paper')

	<?php 
	$pages = Input::get('pages');
	?>

	@if($pages > '')
		<?php $pagescount = "$pages Pages";?>
	@else <?php $pagescount = '';?>
	@endif

	@if($pages <= 0)
	<?php $pagetotal = 0;?>
	@elseif($pages < 10)
	<?php $pagetotal = 10.00;?>
	@elseif($pages <= 20)
	<?php $pagetotal = ($pages * 1.17);?>
	@elseif($pages <= 50)
	<?php $pagetotal = (23.40 + (($pages - 20) * .59));?>
	@elseif($pages > 50)
	<?php $pagetotal = (41.1 + (($pages - 50) * .25));?>

	@endif



{{-- END PAPER PAGES PRICE LOGIC --}}


@elseif(Input::get('digitalpaper') == 'digital')


{{-- BEGIN DIGITAL PAGES PRICE LOGIC --}}

	<?php 
		$pages = Input::get('pages');
	?>

	@if($pages > '')

		<?php $pagescount = "$pages Pages";
			if($pages < 10){
				$pagetotal = 10.00;
			} else {
			  $pagetotal = $pages * .3;
			}

		?>

	@else <?php $pagescount = "";?>

	@endif


@endif


{{-- END DIGITAL PAGES PRICE LOGIC --}}




{{-- BEGIN SUPPLEMENTAL PAPER PAGES PRICE LOGIC --}}





@if(Input::get('digitalpaper') == 'paper')

<?php 
	  $ogpages = Input::get('ogpages');
	  $ogpagecount = Input::get('suppages');
	  $totalsup = $ogpages + $ogpagecount;
?>



	@if($ogpages <= 0)
	<?php $ogpagetotal = 0;?>

	@elseif($ogpages < 10)
	<?php $ogpagetotal = 10.00;?>

	@elseif($ogpages <= 20)
	<?php $ogpagetotal = ($ogpages * 1.17);?>

	@elseif($ogpages <= 50)
	<?php $ogpagetotal = (23.40 + (($ogpages - 20) * .59));?>

	@elseif($ogpages > 50)
	<?php $ogpagetotal = (41.1 + (($ogpages - 50) * .25));?>

	@endif




	@if($totalsup <= 0)
	<?php $ogtotal = 0;?>

	@elseif($totalsup < 10)
	<?php $ogtotal = 10.00;?>

	@elseif($totalsup <= 20)
	<?php $ogtotal = ($totalsup * 1.17);?>

	@elseif($totalsup <= 50)
	<?php $ogtotal = (23.40 + (($totalsup - 20) * .59));?>

	@elseif($totalsup > 50)
	<?php $ogtotal = (41.1 + (($totalsup - 50) * .25));?>

	@endif

	@if($totalsup < 10)

		<?php $supline = 10.00;?>

	@elseif($ogpages < 10)

	 	<?php $supline = 10 + ($ogtotal - $ogpagetotal) - ($ogpages * 1.17);?>

	@else

	<?php $supline = $ogtotal - $ogpagetotal;?>

	@endif


{{-- END SUPPLEMENTAL PAPER PAGES PRICE LOGIC --}}


@elseif(Input::get('digitalpaper') == 'digital')


{{-- BEGIN SUPPLEMENTAL DIGITAL PAGES PRICE LOGIC --}}

<?php 
	  $ogpages = Input::get('ogpages');
	  $ogpagecount = Input::get('suppages');
	  $totalsup = $ogpages + $ogpagecount;
?>


	@if($totalsup < 10)

		<?php $supline = 10.00;?>

	@else

		<?php $supline = $ogpagecount * .3;?>

	@endif

@endif


{{-- END SUPPLEMENTAL DIGITAL PAGES PRICE LOGIC --}}


{{-- BEGIN CD PRICE LOGIC --}}

<?php
	$cdcount = Input::get('cds');
	$cdprice = $cdcount * 10;
?>


{{-- END CD PRICE LOGIC --}}



{{-- BEGIN DVD PRICE LOGIC --}}

<?php 
	$dvdcount = Input::get('dvds'); 
	$dvdprice = $dvdcount * 10;
?>


{{-- END DVD PRICE LOGIC --}}




{{-- BEGIN FILM PRICE LOGIC --}}

<?php 
	$filmcount = Input::get('films');
	$filmcoe = Input::get('filmcoe');

	if($filmcount > ''){

	$filmprice = ($filmcount * $filmcoe) + 15.71;

}else{


	$filmprice = 0;
}?>


{{-- END FILM PRICE LOGIC --}}



{{-- BEGIN EXTRA LINE ITEMS --}}


<?php 
	$witnessfee = Input::get('witness');
	$other = Input::get('other');
	$otherquantity = Input::get('otherquantity');
	$othercalc = Input::get('otherquantity') * Input::get('otherprice');
?>


{{-- END EXTRA LINE ITEMS --}}


{{-- BEGIN SUPPLEMENTAL PRICE TOTALS --}}


<?php 	



	if(Input::get('suppages') > '') {

		$reproductionline = $othercalc + $supline + $filmprice + $cdprice + $dvdprice;

		$linetotal = $reproductionline + $shipping + $subpfee + $witnessfee;

	}else{

	$reproductionline = $othercalc + $pagetotal + $filmprice + $cdprice + $dvdprice;


	$linetotal = $reproductionline + $shipping + $subpfee + $witnessfee;
}?>





@if($pages > '')
	<?php $pagescount = " $pages Pages ";?>
@else <?php $pagescount = "";?>
@endif

@if($ogpagecount > '')
	<?php $suppagescount = " $ogpagecount Supplemental Pages ";?>
@else <?php $suppagescount = "";?>
@endif

@if($dvdcount > '')
	<?php $dvdverbiage = " $dvdcount X-ray DVDs ";?>
@else <?php $dvdverbiage = "";?>
@endif


@if($cdcount > '')
	<?php $cdverbiage = " $cdcount X-ray CDs ";?>
@else <?php $cdverbiage = "";?>
@endif

@if($filmcount > '')
	<?php $filmverbiage = " $filmcount X-ray Films ";?>
@else <?php $filmverbiage = "";?>
@endif


@if($other > '')
	<?php $otherverbiage = " $otherquantity $other ";?>
@else <?php $otherverbiage = "";?>
@endif

<?php $jobinfo = DB::table('lojob')->where('jobnum', '=', Input::get('jnum'))->first();?>
<?php $caseinfo = DB::table('locases')->where('casenum', '=', $jobinfo->casenum)->first();?>



	<div class="logo">
		
		<img src = "//localhost/img/logo.png">
	
		<?php 
			$getatty = DB::table('qbatty')->where('name', '=', Input::get('pnum'))->first();
		?>
			<div class="address">
				{{$getatty->addr1}}<br>
				{{$getatty->addr2}}<br>
				{{$getatty->addr3}}<br>
				{{$getatty->addr4}}<br>
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



			<div class="invoicedatedata">{{Carbon::parse('today')->format('m/d/Y')}}</div>
			<div class="invoicenumdata">235253</div>
			<div class="jobnumdata">{{Input::get('jnum')}}</div>
			<div class="termsdata">Net 30</div>
			<div class="duedatedata">{{Carbon::parse('today')->addDays('30')->format('m/d/Y')}}</div>
			<div class="filenum">YOUR FILE # 22-5563-444
				<div class="subpdata">
				@if($subpfee == 39.50)	
					<table>
						<td width="450px">Preparation of Subpoena and Notice regarding {{$jobinfo->deponent}}
						<td width="140px">
						<td>{{$subpfee}}
					</table>
				@endif
				
				@if($witnessfee > 0)	
					<table>
						<td width="450px">Witness Fee
						<td width="140px">
						<td>{{$witnessfee}}
					</table>
				@endif



{{-- BEGIN VERBIAGE LOGIC --}}




	<?php if($nrscheck == 1) {

		$finalverbiage = "Preparation of No Records Statement received from Deponent $jobinfo->deponent regarding $jobinfo->nor.";


	} elseif($includedcheck == 1) {

		$includedjobinfo = DB::table('lojob')->where('jobnum', '=', $includedjob)->first();

		$finalverbiage = "Cancellation of Request from Deponent $jobinfo->deponent regarding $jobinfo->nor. 
		Closing as records will be included with $includedjobinfo->deponent (CDSJOB $includedjob).";


	} elseif($cancelledcheck == 1) {

		$finalverbiage = "Cancellation of Request from Deponent $jobinfo->deponent regarding $jobinfo->nor. 
		Closing per attorney request.";


	} elseif($settledcheck == 1) {

	$finalverbiage = "Cancellation of Request from Deponent $jobinfo->deponent regarding $jobinfo->nor. 
	Closing as case has settled.";
	

	} else {


		$finalverbiage = "Reproduction of Records received from Deponent $jobinfo->deponent
											regarding $jobinfo->nor ($pagescount $cdverbiage $dvdverbiage $filmverbiage $suppagescount $otherverbiage) - $caseinfo->caption";
	};?>


	<?php if($nrscheck == 1){
		$reproductionline = 7.50;
	};?>

	<?php if($includedcheck == 1){
		$reproductionline = 7.50;
	};?>

	<?php if($cancelledcheck == 1){
		$reproductionline = 7.50;
	};?>

	<?php if($settledcheck == 1){
		$reproductionline = 7.50;
	};?>

				<div class="jobdata">
					<table>
						<td width="450px">{{$finalverbiage}}
						<td width="140px">
						<td>{{number_format($reproductionline, 2, '.', '')}}
						<tr>
						<td width="450px">Postage and Handling
						<td width="140px">
						<td>{{number_format($shipping, 2, '.', '')}}
					</table>

				</div>	



			</div>
		
	</div>
<div class="totaldata">{{number_format($linetotal, 2, '.', '')}}</div>	




@stop



