@extends('layouts.app')
@section('content')


    <div class="row">
        <div class="col-md-12 mt-5 mb-5">
            <div class="card">
                <div class="card-header"> Užsakymų sąrašas </div>


                <div class="card-body">

                    <table class="table">
                        <thead>

                        <tr>
                            <th>Viešbučio pavadinimas</th>
                            <th>Statusas</th>
                            @can('edit')
                            <th>Užsakovas</th>
                            @endcan
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            @foreach($orders as $order)

                                <td> {{ $order->hotel->hotel_name }}  </td>
                                <td> {{ $order->status}}  </td>
                            @can('edit')
                                <td> {{ $order->user->name}} {{ $order->user->surname}}  </td>
                                @endcan

                                <td>
                                    @can('user')
                                        @if ($order->status == 'pateiktas' )

                                            <form action="{{ route('atsaukti', $order->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="atšauktas">
                                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                <input type="hidden" name="hotel_id" value="{{$order->hotel_id}}">

                                                <button class="btn btn-info">Atšaukti</button>

                                            </form>

                                        @endif
                                    @endcan
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

