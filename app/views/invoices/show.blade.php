



<?php $invoices = ToQuickbooks::where('inv_number', $invoice->inv_number)->get();
	  $firstinvoice = ToQuickbooks::where('inv_number', $invoice->inv_number)->first();
	  $lineitems = DB::table('attorney_file_select')->get();
	  $items = DB::table('qbitem_listfull')->get();
?>


<style>

	.createinvoice{
		position: absolute;
		margin-left:400px;
	}


</style>

<div class="createinvoice">

{{Form::open(array('route' => 'remake_pdf', 'method' => 'post')) }}
{{Form::hidden('invnum', $firstinvoice->inv_number)}}

{{Form::submit('Re-make PDF')}}

{{Form::close()}}

</div>
<?php $custlist = DB::table('qbatty')->get();?>

<br><br><br>


<table>



{{Form::open(array('route' => 'update_address', 'method' => 'post')) }}

<select name="pnum">



<option selected="selected" value="{{$firstinvoice->name}}">{{$firstinvoice->name}}</option>
	
	@foreach($custlist as $cust)
	<option value="{{$cust->name}}"=>{{$cust->name}} |||| {{$cust->addr2}}<br>
	@endforeach
</select>


<td>Job Number: {{Form::text('jobnum', $firstinvoice->jobnum)}}<tr>
<td>Date: {{Form::text('date', $firstinvoice->date)}}<tr>
<td>Due: {{Form::text('due', $firstinvoice->due)}}<tr>


</table>






{{Form::hidden('invnum', $firstinvoice->inv_number)}}

{{Form::submit('Update Atty/Job Info')}}

{{Form::close()}}

<br><br>





@foreach($invoices as $inv)

{{Form::open(array('route' => 'update_verbiage', 'method' => 'post', 'id' => $inv->id)) }}

<table>


	<td><select name="rev_acct"  style="max-width:70px">

		<option selected="selected">
					{{$inv->rev_acct}}
		</option>

						 	@foreach($items as $lines)
								<option value="{{  $lines->item   }}"=>{{ $lines->item }}<br>
							@endforeach
							</select>

<td>{{Form::textarea('description', $inv->description, array('style' => 'width:400px;height:70px'))}}
<td>{{Form::text('price', $inv->price)}}<tr>

<table>

{{Form::hidden('id', $inv->id)}}
{{Form::submit('Edit Line Item')}}<br><br><br>
{{Form::close()}}
@endforeach




