<?php

class QbAttorneysController extends \BaseController {

	/**
	 * Display a listing of qbattorneys
	 *
	 * @return Response
	 */
	public function index()
	{
		$qbattorneys = Qbattorney::all();

		return View::make('qbattorneys.index', compact('qbattorneys'));
	}

	/**
	 * Show the form for creating a new qbattorney
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('qbattorneys.create');
	}

	/**
	 * Store a newly created qbattorney in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Qbattorney::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Qbattorney::create($data);

		return Redirect::route('qbattorneys.index');
	}

	/**
	 * Display the specified qbattorney.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$qbattorney = Qbattorney::findOrFail($id);

		return View::make('qbattorneys.show', compact('qbattorney'));
	}

	/**
	 * Show the form for editing the specified qbattorney.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$qbattorney = Qbattorney::find($id);

		return View::make('qbattorneys.edit', compact('qbattorney'));
	}

	/**
	 * Update the specified qbattorney in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$qbattorney = Qbattorney::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Qbattorney::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$qbattorney->update($data);

		return Redirect::route('qbattorneys.index');
	}

	/**
	 * Remove the specified qbattorney from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Qbattorney::destroy($id);

		return Redirect::route('qbattorneys.index');
	}

}
