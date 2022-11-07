@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-12 mt-5 mb-5">
            <div class="card">
                <div class="card-header">Naujos šalies sukūrimas</div>
                <div class="card-body">
                    <form action="{{ route('countries.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Šalies pavadinimas</label>
                            <input class="form-control" type="text" name="country_name" >

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sezonas</label>
                            <select class="form-control" name="season" >
                                <option selected>Pasirinkti</option>
                                <option value="Vasara" > Vasara </option>
                                <option value="Žiema" > Žiema </option>
                                <option value="Vasara" > Ruduo </option>
                                <option value="Vasara" > Pavasaris </option>

                            </select>

                        </div>

                        <button class="btn btn-primary">Add</button>
                        <a class="btn btn-success mx-3 float-end" href="{{ route('countries.index') }}">Go Back</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection


