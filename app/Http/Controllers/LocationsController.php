<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationsCountry;
use App\Models\LocationsRegion;
use http\Env\Response;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locations = Location::where('region_id', $id)->get();

        /*$response = new Response($regions, Response::HTTP_OK);*/
        return \response()->json(['locations' => $locations]);
    }
    /**
     * Display the regions
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRegions($id)
    {
        $regions = LocationsRegion::where('country_id', $id)->get();

        /*$response = new Response($regions, Response::HTTP_OK);*/
        return \response()->json(['regions' => $regions]);
    }
    /**
     * Display the countries
     *
     * @return \Illuminate\Http\Response
     */
    public function showCountries()
    {
        $countries = LocationsCountry::all();

        /*$response = new Response($regions, Response::HTTP_OK);*/
        return \response()->json(['countries' => $countries]);
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
