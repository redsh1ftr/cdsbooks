




@foreach($isolate as $getem)

<table>

		<td width="150px">{{link_to_route('invoices.show', $getem->inv_number, $getem->getjob())}}<td>{{$getem->getAtty()}}<tr>

</table>


@endforeach

