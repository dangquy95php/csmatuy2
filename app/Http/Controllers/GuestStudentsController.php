<?php

namespace App\Http\Controllers;

use App\Models\GuestStudents;
use App\Http\Requests\StoreGuestStudentsRequest;
use App\Http\Requests\UpdateGuestStudentsRequest;

class GuestStudentsController extends Controller
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
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGuestStudentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGuestStudentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GuestStudents  $guestStudents
     * @return \Illuminate\Http\Response
     */
    public function show(GuestStudents $guestStudents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GuestStudents  $guestStudents
     * @return \Illuminate\Http\Response
     */
    public function edit(GuestStudents $guestStudents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGuestStudentsRequest  $request
     * @param  \App\Models\GuestStudents  $guestStudents
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGuestStudentsRequest $request, GuestStudents $guestStudents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GuestStudents  $guestStudents
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuestStudents $guestStudents)
    {
        //
    }
}
