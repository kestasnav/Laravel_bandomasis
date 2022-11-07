@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-12 mt-5 mb-5">
            <div class="card">
                <div class="card-header">Naujo viešbučio sukūrimas</div>
                <div class="card-body">
                    <form action="{{ route('hotels.update',$hotel->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Viešbučio pavadinimas</label>
                            <input class="form-control" type="text" name="hotel_name" value="{{$hotel->hotel_name}}">

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Šalis</label>
                            <select class="form-control" name="country_id" >
                                <option selected>Pasirinkti</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" @selected($hotel->country_id==$country->id)  > {{$country->country_name}} </option>

                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label mx-2">Viešbučio nuotrauka</label>
                            <input type="file" class="form-control" name="img">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label mx-2">Kaina</label>
                            <input type="number" class="form-control" name="price" placeholder="EUR" value="{{$hotel->price}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Atostogų pradžia</label>
                            <input class="form-control" type="date" name="start" value="{{$hotel->start}}">

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Atostogų pabaiga</label>
                            <input class="form-control" type="date" name="end" value="{{$hotel->end}}">

                        </div>

                        <button class="btn btn-primary">Update</button>
                        <a class="btn btn-success mx-3 float-end" href="{{ route('hotels.index') }}">Go Back</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection



