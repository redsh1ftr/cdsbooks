{{Form::open(array('route' => 'find_invoice', 'method' => 'post'))}}

{{Form::text('jobnum', '', array('placeholder' => 'Job Number'))}}

{{Form::submit('Find Invoices')}}

{{Form::close()}}