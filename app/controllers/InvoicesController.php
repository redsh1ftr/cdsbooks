<?php

class InvoicesController extends \BaseController {

	/**
	 * Display a listing of invoices
	 *
	 * @return Response
	 */

	public function find_invoice(){

		$job = Input::get('jobnum');
		$isolate = ToQuickbooks::where('jobnum', $job)->select('inv_number')->distinct()->get();

		return View::make('invoicelist', compact('isolate'));

	}

	public function new_invoice(){
		

		return View::make('invoiceform');
	}


	public function fix(){

		return View::make('rere');
	}

	public function remakeInvoice(){

		$inv = Input::get('invnum');
		$getinv = ToQuickbooks::where('inv_number', $inv)->get();
		$getoneinv = ToQuickbooks::where('inv_number', $inv)->first();
		$pnum = Input::get('pnum');

		

		$npdf = PDF::loadView('refinalize', array(
			'addr1' => $getoneinv->name,
			'addr2' => $getoneinv->addr1,
			'addr3' => $getoneinv->addr2,
			'addr4' => $getoneinv->addr3,
			'invdate' => $getoneinv->date,
			'jobnum' => $getoneinv->jobnum,
			'duedate' => $getoneinv->due,
			'invnum' => $getoneinv->inv_number,
			'lineitems' => $getinv,
			));

			 $npdf->save("//CDS007/007Data/Record Covers/invoices/$newname - $name.pdf");

		return View::make('invoicelist');
	}

	public function finalize(){

		
		$currentinvoice = DB::table('invoice_defaults')->where('id', '=', 1)->first();

		$today = Carbon::parse('today')->format('m/d/Y');

		$due = Carbon::parse('today')->addDays(30)->format('m/d/Y');

		$newinvnum = Input::get('invnum');

		$newname = Input::get('invnum');

		$name = Input::get('jobnum');


		$npdf = PDF::loadView('finalize', array(
			'addr1' => Input::get('addr1'),
			'addr2' => Input::get('addr2'),
			'addr3' => Input::get('addr3'),
			'addr4' => Input::get('addr4'),
			'invdate' => Input::get('invdate'),
			'jobnum' => Input::get('jobnum'),
			'duedate' => Input::get('duedate'),
			'filename' => Input::get('filename'),
			'invnum' => Input::get('invnum'),
			'prepverb' => Input::get('prepverb'),
			'subpamt' => Input::get('subpamt'),
			'witnessverb' => Input::get('witnessverb'),
			'witnessamt' => Input::get('witnessamt'),
			'finalverbiage' => Input::get('finalverbiage'),
			'postage' => Input::get('postage'),
			'postageamt' => Input::get('postageamt'),
			'lineprice' => Input::get('lineprice'),
			'total' => number_format(Input::get('total'), 2, '.', '')
			));

		$npdf->save("//CDS007/007Data/Record Covers/invoices/$newname - $name.pdf");


		DB::table('invoice_defaults')->where('id', '=', 1)->update(array('invoice_number' => $newinvnum));


		$makeinvL1 = new ToQuickbooks;

		$makeinvL1->date = $today;
		$makeinvL1->due = $due;
		$makeinvL1->name = Input::get('addr1');
		$makeinvL1->addr1 = Input::get('addr2');
		$makeinvL1->addr2 = Input::get('addr3');
		$makeinvL1->addr3 = Input::get('addr4');
		$makeinvL1->inv_number = $newinvnum;
		$makeinvL1->jobnum = Input::get('jobnum');
		$makeinvL1->description = Input::get('filename');
		$makeinvL1->price = '';
		$makeinvL1->rev_acct = Input::get('rev_acct_1');

		$makeinvL1->save();

		if(Input::get('subpamt') > ''){
		$makeinvL2 = new ToQuickbooks;

		$makeinvL2->date = $today;
		$makeinvL2->due = $due;
		$makeinvL2->name = Input::get('addr1');
		$makeinvL2->addr1 = Input::get('addr2');
		$makeinvL2->addr2 = Input::get('addr3');
		$makeinvL2->addr3 = Input::get('addr4');
		$makeinvL2->inv_number = $newinvnum;
		$makeinvL2->jobnum = Input::get('jobnum');
		$makeinvL2->description = Input::get('prepverb');
		$makeinvL2->price = Input::get('subpamt');
		$makeinvL2->rev_acct = Input::get('rev_acct_2');

		$makeinvL2->save();}

		if(Input::get('witnessamt') > ''){
		$makeinvL3 = new ToQuickbooks;

		$makeinvL3->date = $today;
		$makeinvL3->due = $due;
		$makeinvL3->name = Input::get('addr1');
		$makeinvL3->addr1 = Input::get('addr2');
		$makeinvL3->addr2 = Input::get('addr3');
		$makeinvL3->addr3 = Input::get('addr4');
		$makeinvL3->inv_number = $newinvnum;
		$makeinvL3->jobnum = Input::get('jobnum');
		$makeinvL3->description = Input::get('witnessverb');
		$makeinvL3->price = Input::get('witnessamt');
		$makeinvL3->rev_acct = Input::get('rev_acct_3');

		$makeinvL3->save();}

		if(Input::get('lineprice') > ''){

		$makeinvL4 = new ToQuickbooks;

		$makeinvL4->date = $today;
		$makeinvL4->due = $due;
		$makeinvL4->name = Input::get('addr1');
		$makeinvL4->addr1 = Input::get('addr2');
		$makeinvL4->addr2 = Input::get('addr3');
		$makeinvL4->addr3 = Input::get('addr4');
		$makeinvL4->inv_number = $newinvnum;
		$makeinvL4->jobnum = Input::get('jobnum');
		$makeinvL4->description = Input::get('finalverbiage');
		$makeinvL4->price = Input::get('lineprice');
		$makeinvL4->rev_acct = Input::get('rev_acct_4');

		$makeinvL4->save();}

		if(Input::get('postage') > ''){

		$makeinvL5 = new ToQuickbooks;

		$makeinvL5->date = $today;
		$makeinvL5->due = $due;
		$makeinvL5->name = Input::get('addr1');
		$makeinvL5->addr1 = Input::get('addr2');
		$makeinvL5->addr2 = Input::get('addr3');
		$makeinvL5->addr3 = Input::get('addr4');
		$makeinvL5->inv_number = $newinvnum;
		$makeinvL5->jobnum = Input::get('jobnum');
		$makeinvL5->description = Input::get('postage');
		$makeinvL5->price = Input::get('postageamt');
		$makeinvL5->rev_acct = Input::get('rev_acct_5');

		$makeinvL5->save();}

	 	 
		return View::make('invoiceform');
		
	 


		
		
	}

	public function index()
	{
		$invoices = Invoice::all();

		return View::make('invoices.index', compact('invoices'));
	}

	/**
	 * Show the form for creating a new invoice
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('invoices.create');
	}

	/**
	 * Store a newly created invoice in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Invoice::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Invoice::create($data);

		return Redirect::route('invoices.index');
	}

	/**
	 * Display the specified invoice.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$invoice = ToQuickbooks::findOrFail($id);

		return View::make('invoices.show', compact('invoice'));
	}

	/**
	 * Show the form for editing the specified invoice.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$invoice = Invoice::find($id);

		return View::make('invoices.edit', compact('invoice'));
	}

	public function updateinvoice_address()
	{
		$inv = Input::get('invnum');

		$addr = ToQuickbooks::where('inv_number', $inv)->get();
		$getatty = DB::table('qbatty')->where('name', Input::get('pnum'))->first();

		foreach($addr as $add){

			$add->name = $getatty->addr1;
			$add->addr1 = $getatty->addr2;
			$add->addr2 = $getatty->addr3;
			$add->addr3 = $getatty->addr4;
			$add->jobnum = Input::get('jobnum');
		
			$add->save();
		}	

		return Redirect::back();
	}

	public function updateinvoice_verbiage()
	{
		$id = Input::get('id');

		$verb = ToQuickbooks::find($id);

		$verb->rev_acct = Input::get('rev_acct');
		$verb->description = Input::get('description');
		$verb->price = Input::get('price');

		$verb->save();

		return Redirect::back();
	}

	/**
	 * Update the specified invoice in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$invoice = Invoice::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Invoice::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$invoice->update($data);

		return Redirect::route('invoices.index');
	}

	/**
	 * Remove the specified invoice from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Invoice::destroy($id);

		return Redirect::route('invoices.index');
	}
	

	static function export(){

		$exportdate = Carbon::parse('today')->format('m-d-Y');

		Excel::create("$exportdate Invoices", function($excel) {
				
			    $excel->sheet('sheet1', function($sheet) {
					$firstname = ToQuickbooks::select(array('date', 'due', 'name', 'addr1', 'addr2', 'addr3', 'inv_number', 'rev_acct', 'description', 'price', 'jobnum'))->get();



			$sheet->fromModel($firstname, null, 'A1', false, true);

			    });

			})->export('csv');
	}

}
