<?php

class ToQuickbooks extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['date', 'due', 'name', 'addr1', 'addr2', 'addr3', 'inv_number', 'rev_acct', 'description', 'price', 'jobnum'];


	protected $table = 'to_quickbooks';



	public function getjob()
	{
		return ToQuickbooks::where('inv_number', $this->inv_number)->pluck('id');
	}

	public function isolate()
	{
		return ToQuickbooks::select('inv_number')->distinct()->get();
	}

	public function getAtty()
	{
		return ToQuickbooks::where('inv_number', $this->inv_number)->pluck('name');
	}



}