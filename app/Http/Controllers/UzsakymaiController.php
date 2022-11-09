<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Uzsakymai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UzsakymaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Uzsakymai::all()->where('user_id', Auth::user()->id);


       return view('orders.index',['orders'=>$orders]);
    }

    public function adminindex()
    {

        $orders = Uzsakymai::all();

        return view('orders.adminindex',['orders'=>$orders]);
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
        //
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
    public function destroy(Uzsakymai $uzsakymai, $id)
    {
        $uzsakymai=Uzsakymai::find($id);
        $uzsakymai->delete();
        return redirect()->back();
    }
}
