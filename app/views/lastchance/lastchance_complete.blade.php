@extends('lastchance.layout')

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
<?php $linetotal = CreateInvoice::lastchance_repro() + CreateInvoice::postage() + $subpfee + $witnessfee;?>




{{-- END SUBPOENA FEE CHECK --}}


<?php 

$iso_pnum = substr(Input::get('pnum'), 0, 5);
$findatty = Atty::where('pnum', $iso_pnum)->pluck('fax');
$jobinfo = DB::table('lojob')->where('jobnum', '=', Input::get('jobnum'))->first();
$caseinfo = DB::table('locases')->where('casenum', '=', $jobinfo->casenum)->first();
$getatty = DB::table('qbatty')->where('name', '=', Input::get('pnum'))->first();
?>


@section('main')



<div class="logo">
	<img src = "//10.0.1.7:8080/img/logo.png">
</div>

<div class="title">
	FACSIMILE COVER SHEET
</div>

<div class="legalese"><br>
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>
<div style="margin-left:10px;margin-right:10px;">
This message is intended only for the use of the individual or entity which it is addressed, and may contain information that is privileged, confidential and exempt from disclosure under applicable laws.  If the reader of this message is not the intended recipient, or the employee or agent responsible for delivering the message to the intended recipient, you are hereby notified that any dissemination, distribution or copying of this communication is strictly prohibited.  If you have received this communication in error, please notify us immediately by telephone and return the original message to at the above address via the U.S. Postal Service.  Thank you.</div>
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div>

<div class="infobox">
<table>
	<td width="150px">DELIVER TO:<td> {{$getatty->addr1}}<tr>
	<td colspan="2">&nbsp<tr>
	<td>FROM: <td> CD Services Records Department<tr>
	<td colspan="2">&nbsp<tr>
	<td>DATE: <td> {{Carbon::parse('today')->format('M d, Y')}}<tr>
	<td colspan="2">&nbsp<tr>
	<td>REGARDING: <td> {{$caseinfo->caption}}, CDS Job# {{$jobinfo->jobnum}}
</table><br>

COMMENTS:   Previously you were sent a copy order form with a Notice of Taking Deposition regarding the following Deponent.  We have either had no response from your office or you have requested an estimate of the cost of the record.  In an effort to ensure that you have an opportunity to obtain these records, we are sending you this communication.
<br><br>

We are about to release the records from the Deponent, <b><u>{{$jobinfo->deponent}}</b></u> concerning <b><u>{{$jobinfo->nor}}</b></u> to the requesting party. 
The cost will be approximately <b>${{number_format($linetotal, 2, '.', '')}}</b> for <b>{{CreateInvoice::lastchance_verbiage()}}</b>.<br><br>
Please advise whether you wish to order a copy of the records by circling below and email your response to the address listed above or fax it to our office at (248) 476-6600. Thank you in advance for your cooperation.<br>


</div><br>

<div class="format">
	<div style="margin-left:30px"><h3>Please circle the format in which you would like to receive records</h3></div><table>
	<td width="120px">&nbsp<td width="180px"><h3>Paper Hardcopy</h3><td><h3>Digital CD</h3><tr>
</table>
</div>

<div class="dowant">
	<table>
	<td width="80px"> <b> I Do   <td width="30px"><b> / <td width="80px"> <b> Do Not <td> want to order a copy of the above mentioned records</table><br><br>

<table>
	<td width="250px">______________________________________<td width="25px">&nbsp<td> _____________________________<tr><td>Signature<td><td>Date</table>
<br><br>
NUMBER OF PAGES TO FOLLOW (INCLUDING COVER): 1<br><br>


	FAX NUMBER: {{$findatty}}<br>
</div>


@stop