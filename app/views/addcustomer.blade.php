





{{Form::open(array('url' => '/addatty', 'method' => 'post'))}}

<table>

<td>{{Form::label('name', "Customer (don't include P before):")}}<td>{{Form::text('name')}}<tr>

<td>{{Form::label('addr1', 'Address 1 (Name w/ P number):')}}<td>{{Form::text('addr1')}}<tr>

<td>{{Form::label('addr2', 'Address 2: (ATTN)')}}<td>{{Form::text('addr2')}}<tr>

<td>{{Form::label('addr3', 'Address 3: (Street)')}}<td>{{Form::text('addr3')}}<tr>

<td>{{Form::label('addr4', 'Address 4: (City, State, Zip)')}}<td>{{Form::text('addr4')}}<tr>


</table>





{{Form::submit('Create')}}

{{Form::close()}}