<?php

namespace App\Http\Controllers\Api;

use App\Cafe;
use App\Utilities\Maps\Gaode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CafesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Cafe::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Gaode $gaode)
    {
        //
        $cafe = new Cafe();
        $cafe->name = $request->get('name');
        $cafe->address = $request->get('address');
        $cafe->city = $request->get('city');
        $cafe->state = $request->get('state');
        $cafe->zip = $request->get('zip');

        $location = $gaode->geocode($cafe->address, $cafe->city, $cafe->state);
        if ($location) {
            $cafe->latitude = $location['lat'];
            $cafe->longitude = $location['lng'];
        }

        $cafe->save();

        return response()->json($cafe, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return response()->json(Cafe::where(['id' => $id])->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
