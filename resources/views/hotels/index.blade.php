@extends('layouts.app')
@section('content')


            <div class="row">
                <div class="col-md-12 mt-5 mb-5">
                    <div class="card">
                        <div class="card-header"> Viešbučių sąrašas </div>


                        <div class="card-body">
                         @can('edit')
                                <a class="btn btn-primary float-end " href="{{ route('hotels.create') }}"><i class="fa-solid fa-marker"></i> Pridėti viešbutį</a>
                            @endcan
                            <table class="table">
                                <thead>

                                <h5>Viešbučių filtravimas</h5>
                                <form method="post" action="{{ route('hotels.filter') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Pasirinkite viešbutį</label>
                                        <select class="form-select" name="country_id">
                                            <option value="" {{ isset($filter_country_id)&&($filter_country_id==null)?'selected':'' }}>-</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" {{isset($filter_country_id)&&($filter_country_id==$country->id)?'selected':'' }}>{{ $country->country_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn btn-outline-success">Filtruoti</button>
                                </form>

                                <tr>
                                    <th>Nuotrauka</th>
                                    <th>Viešbučio pavadinimas</th>
                                    <th>Šalis</th>

                                    <th>Atostogų pradžia</th>
                                    <th>Atostogų pabaiga</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead> <th><a href="{{ route('price.order','price') }}">Kaina
                                        @if(isset($orderBy)&&$orderBy=='price')
                                            {!!($orderDirection=='DESC')?'&uparrow;':'&downarrow;' !!}
                                        @endif</a></th>
                                <tbody>
                                <tr>

                                    @foreach($hotels as $hotel)

                                        <td><img src="{{ route('images',$hotel->img)}}" style=" width: 324px; height: 216px;"></td>
                                        <td> {{ $hotel->hotel_name }}  </td>
                                        <td> {{ $hotel->country_id}}  </td>
                                        <td> {{ $hotel->price }} EUR </td>
                                        <td> {{ $hotel->start }}  </td>
                                        <td> {{ $hotel->end }}  </td>
                                        @can('edit')
                                            <td><a class="btn btn-success" href="{{ route('hotels.edit', $hotel->id) }}"><i class="fa-solid fa-pencil"></i></a></td>
                                        @endcan

                                        <td>
                                            @can('edit')
                                                <form action="{{ route('hotels.destroy', $hotel->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            @endcan
                                        </td>
                                        <td>
                                        @foreach($uzsakymai as $uzsakymas)
                                            @if(Auth::user()->id == $uzsakymas->user_id && $hotel->id == $uzsakymas->hotel_id && $uzsakymas->status == "pateiktas")

                                                <p>Užsakymas pateiktas</p>

                                            @else
                                                <form action="{{ route('pateikti', $hotel->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="pateiktas">
                                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                    <input type="hidden" name="hotel_id" value="{{$hotel->id}}">

                                                    <button class="btn btn-info">Užsisakyti</button>

                                                </form>
                                                    @break
                                            @endif
                                            @endforeach
                                        </td>

                                </tr>


                                @endforeach

                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>

            </div>
@endsection
