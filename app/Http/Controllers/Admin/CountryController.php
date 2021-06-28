<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryStoreRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CountryDataTable $table
     * @return \Illuminate\Http\Response
     */
    public function index(CountryDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.country.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            Country::create($validated);
            flash('Country Saved Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('pages.admin.country.edit',['data'=>$country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        try {
            $country->update($request->all());
            flash('Country Updated Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();
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

    public function delete(Country $country){
        try {
            $country->delete();
            flash('Country deleted Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();
    }
}
