<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Hotel;
use App\Models\Uzsakymai;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countryId=$request->session()->get('filter_country_id', null);
        $find=$request->session()->get('find_post',$request->search);
        $orderBy=$request->session()->get('order_by', 'hotel_name');
        $dir=$request->session()->get('order_direction', 'ASC');
        if($countryId!=null){
            $hotels =  Hotel::where('country_id',$countryId )->get();
        }else{
            $hotels=Hotel::filter($countryId)->findPosts($find)->orderBy($orderBy,$dir)->get();
        }
        $uzsakymai=Uzsakymai::all();


        return view('hotels.index',['hotels'=>$hotels, 'countries'=>Country::all(), 'filter_country_id'=>$countryId,'orderBy'=>$orderBy, 'orderDirection'=>$dir, 'uzsakymai'=>$uzsakymai]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=Country::all();
        return view('hotels.create',['countries'=>$countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hotel = new Hotel();
        if($request->file('img')!=null) {
            $foto = $request->file('img');

            $fotoname = $request->id . '_' . rand() . '.' . $foto->extension();
            $foto->storeAs('images',$fotoname);
            $hotel->img=$fotoname;
        }

        $hotel->hotel_name=$request->hotel_name;
        $hotel->country_id=$request->country_id;

        $hotel->price=$request->price;
        $hotel->start=$request->start;
        $hotel->end=$request->end;

        $hotel->save();

        return redirect()->route('hotels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        $countries=Country::all();
        return view('hotels.update',['hotel'=>$hotel,'countries'=>$countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        if($request->file('img')!=null) {
            $foto = $request->file('img');

            $fotoname = $request->hotel_name . '_' . rand() . '.' . $foto->extension();
            $foto->storeAs('images',$fotoname);
            $hotel->img=$fotoname;
        }

        $hotel->hotel_name=$request->hotel_name;
        $hotel->country_id=$request->country_id;

        $hotel->price=$request->price;
        $hotel->start=$request->start;
        $hotel->end=$request->end;

        $hotel->save();

        return redirect()->route('hotels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->back();
    }

    public function display($name){
        $file=storage_path('app/images/'.$name);
        return response()->file( $file );
    }

    public  function pateiktiUzsakyma(Uzsakymai $uzsakymai, Request $request, $add)
    {
        $uzsakymai= new Uzsakymai();
        $uzsakymai->status=$request->status;
        $uzsakymai->user_id=$request->user_id;
        $uzsakymai->hotel_id=$request->hotel_id;
        $uzsakymai->save();
        return redirect()->back();
    }

    public  function atsauktiUzsakyma(Uzsakymai $uzsakymai, Request $request, $add)
    {
        $uzsakymai=Uzsakymai::find($add);

        $uzsakymai->status=$request->status;
        $uzsakymai->user_id=$request->user_id;
        $uzsakymai->hotel_id=$request->hotel_id;
        $uzsakymai->save();
        return redirect()->back();
    }

    public function findPost(Request $request) {
        $request->session()->put('find_post', $request->hotel_name);
        return redirect()->route('hotels.index');
    }

    public function filterHotels(Request $request){
        $request->session()->put('filter_country_id',$request->country_id);

        return redirect()->route('hotels.index');
    }

    public function orderPrice(Request $request, $field){
        if($request->session()->get('order_by')==$field){
            $dir = $request->session()->get('order_direction', 'ASC');
            if($dir=='ASC'){
                $request->session()->put('order_direction','DESC');
            }else{
                $request->session()->put('order_direction', 'ASC');
            }
        }else{
            $request->session()->put('order_direction', 'ASC');
        }
        $request->session()->put('order_by',$field);
        return redirect()->route('hotels.index');
    }

    public function rateHotels(Request $request, $id){
        $rate=Hotel::find($id);
        $rate->rate_count++;
        $rate->rate_sum=$rate->rate_sum+$request->ivertinimas;
        $rate->save();
        return redirect()->back();
    }

}
