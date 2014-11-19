<?php

class AttorneysController extends \BaseController {

	/**
	 * Display a listing of attorneys
	 *
	 * @return Response
	 */
	public function index()
	{
		$attorneys = Attorney::all();

		return View::make('attorneys.index', compact('attorneys'));
	}

	/**
	 * Show the form for creating a new attorney
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('attorneys.create');
	}

	/**
	 * Store a newly created attorney in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		Attorney::create(array(
			'name' => Input::get('name'),
			'addr1' => Input::get('addr1'),
			'addr2' => Input::get('addr2'),
			'addr3' => Input::get('addr3'),
			'addr4' => Input::get('addr4')));

		return Redirect::route('new_invoice');
	}

	/**
	 * Display the specified attorney.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$attorney = Attorney::findOrFail($id);

		return View::make('attorneys.show', compact('attorney'));
	}

	/**
	 * Show the form for editing the specified attorney.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$attorney = Attorney::find($id);

		return View::make('attorneys.edit', compact('attorney'));
	}

	/**
	 * Update the specified attorney in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$attorney = Attorney::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Attorney::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$attorney->update($data);

		return Redirect::route('attorneys.index');
	}

	/**
	 * Remove the specified attorney from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Attorney::destroy($id);

		return Redirect::route('attorneys.index');
	}

}
