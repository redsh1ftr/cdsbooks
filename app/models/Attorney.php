<?php

class Attorney extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'addr1', 'addr2', 'addr3', 'addr4'];


	protected $table = 'qbatty';

}