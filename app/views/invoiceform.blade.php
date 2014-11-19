<table><td>
{{link_to('/makeatty', 'ADD CUSTOMER')}}<td>{{link_to('/locateinv', 'FIX INVOICES')}}</table><br><br>



<?php $custlist = DB::table('qbatty')->get();
      $defaults = DB::table('invoice_defaults')->first();?>

<div style="margin:50px">

{{Form::open(array('url' => '/makepreinvoice'))}}



<table>
<td>{{Form::label('jobnum', 'Job Number:')}}<td>{{Form::text('jobnum')}}<tr>
<td>{{Form::label('pnum', 'P Number:')}} <td>

<select name="pnum">


	
	@foreach($custlist as $cust)
	<option value="{{$cust->name}}"=>{{$cust->name}} |||| {{$cust->addr2}}<br>
	@endforeach
</select>
</table>


<table width="50%"><tr>

          <td>{{ Form::label('julietaylor','JT') }}
          {{ Form::radio('julietaylor','jt','jt',array('id'=>'jt')) }}
          
          <td>{{ Form::label('notjt','Not Requestor') }}
          {{ Form::radio('julietaylor','notjt','',array('id'=>'notjt')) }}

          <td>{{ Form::label('julietaylor','Requestor') }}
          {{ Form::radio('julietaylor','requestor','',array('id'=>'requestor')) }}
          <td>{{ Form::label('julietaylor','Ken Williams') }}
          {{ Form::radio('julietaylor','kenwilliams','',array('id'=>'kenwilliams')) }}
</table><table>  <tr>

<td>{{ Form::label('digital','Digital') }}
          {{ Form::radio('digitalpaper','digital','digital',array('id'=>'digital')) }}
          <td>{{ Form::label('paper','Paper') }}
          {{ Form::radio('digitalpaper','paper','',array('id'=>'paper')) }}<tr>

<td>{{Form::label('witnessamt', 'Witness Fee:')}}<td>{{Form::text('witnessamt')}}<tr>

<td>{{Form::label('pages', 'Pages Count:')}}<td>{{Form::text('pages')}}<tr>

<td>{{Form::label('ship', 'Shipping:')}}<td>{{Form::text('ship', 18.00)}}<tr>

<td>{{Form::checkbox('subp', '1')}} <td>DONT INCLUDE SUBPOENA FEE<tr>

<td>{{Form::label('cds', 'CD Count:')}}<td>{{Form::text('cds')}}<tr>

<td>{{Form::label('dvds', 'DVD Count:')}}<td>{{Form::text('dvds')}}<tr>

<td>{{Form::label('date', 'Date: ')}}<td>{{Form::text('date', $defaults->date)}}<tr>





</table><br><br>
<table>

<td>{{Form::label('suppages', 'Supplemental Count:')}}<td>{{Form::text('suppages')}}
<td>{{Form::label('ogpages', 'Pages Already Billed (Not JT, Paper only)')}}<td>{{Form::text('ogpages')}}<tr><tr>
<td>{{Form::label('films', 'Film Count:')}}<td>{{Form::text('films')}}<td>{{Form::label('filmcoe', 'Cost for Films')}}<td>{{Form::text('filmcoe')}} 
<td>{{Form::label('filmfac', 'Facility Cost for Films')}}<td>{{Form::text('filmfac')}}<td>{{Form::checkbox('digitized', '1')}} DIGITIZED
<tr>
	
<td>{{Form::label('other', 'Other:')}}<td>{{Form::text('other')}}
<td>{{Form::label('otherquantity', 'Quantity:')}}<td>{{Form::text('otherquantity')}}
<td>{{Form::label('otherprice', 'Price each:')}}<td>{{Form::text('otherprice')}}<tr>
</table>

<table>
<td>{{Form::checkbox('nrs', '1')}}<td> NO RECORDS STATEMENT<tr><tr>


<td>{{Form::checkbox('included', '1')}}
	<td>{{Form::label('includedjob', 'RECORDS INCLUDED WITH:')}}
		<td>{{Form::text('incjob', '', array('placeholder' => 'Job Number...'))}}<tr><tr>



<td>{{Form::checkbox('cancelled', '1')}} <td>{{Form::label('jobcancelled', 'JOB CANCELLED')}} <tr><tr>

<td>{{Form::checkbox('settled', '1')}}<td> CASE SETTLED<tr><tr>

<td>{{Form::checkbox('abstract', '1')}}<td> ABSTRACTED/AMENDED SUBPOENA<tr><tr>



</table>
{{Form::submit('Create')}}

{{Form::close()}}

</div>