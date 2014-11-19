<?php

class Atty extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['atty', 'pnum', 'fax'];


	protected $table = 'latty';

}