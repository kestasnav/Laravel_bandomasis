@extends('layouts.app')
@section('content')


    <div class="row">
        <div class="col-md-12 mt-5 mb-5">
            <div class="card">
                <div class="card-header"> Šalių sąrašas </div>


                <div class="card-body">
                    {{--                            @can('create', \App\Models\Course::class)--}}
                    <a class="btn btn-primary float-end " href="{{ route('countries.create') }}"><i class="fa-solid fa-marker"></i> Pridėti šalį</a>
                    {{--                            @endcan--}}
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Šalis</th>
                            <th>Sezonas</th>
                            <th></th>
                            <th></th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            @foreach($countries as $country)

                                <td> {{ $country->country_name }}  </td>
                                <td> {{ $country->season }}  </td>
                                {{--                                        @can('update', $hotel)--}}
                                <td><a class="btn btn-success" href="{{ route('countries.edit', $country->id) }}"><i class="fa-solid fa-pencil"></i></a></td>
                                {{--                                        @endcan--}}

                                <td>
                                    {{--                                            @can('delete', $hotel)--}}
                                    <form action="{{ route('countries.destroy', $country->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                    {{--                                            @endcan--}}
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

