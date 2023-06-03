@extends('layouts/app')

@section('content')

    <div class="row">
        <div class="col-6">
            <h3>Vacancy</h3>
        </div>
    </div>

    <div class="row mt-2">
        <table id="vacancy-table" class="table table-stripped table-datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>Position</th>
                <th>Department</th>
            </tr>
            </thead>
            <tbody>
            @foreach($positions as $position)
                <tr>
                    <td>{{$position->id}}</td>
                    <td>{{$position->name}}</td>
                    <td>{{$position->department->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
