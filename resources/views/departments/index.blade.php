@extends('layouts/app')

@section('content')

    @if(session('status'))
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <div class="alert alert-{{session('status')['color']}}" role="alert">
                    {{session('status')['text']}}
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-6">
            <h3>Departments</h3>
        </div>
        @if (Auth::check())
            <div class="col-6">
                <a href="{{route('departments.create')}}" class="btn btn-success btn-lg float-end">Create a new
                    department<i
                        class="bi bi-plus-square"></i></a>
            </div>
        @endif
    </div>

    <div class="row mt-2">
        <table id="departments-table" class="table table-stripped table-datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th><span class="fr-7">***</span></th>
            </tr>
            </thead>
            <tbody>
            @foreach($departments as $department)
                <tr>
                    <td>{{$department->id}}</td>
                    <td>{{$department->name}}</td>
                    <td>
                        @if (Auth::check())
                            <form action="{{route('departments.destroy', $department)}}" method="POST" class="float-end"
                                  title="Delete a department">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-lg"><i class="bi bi-trash3"></i></button>
                            </form>
                            <a href="{{route('departments.edit', ['department'=>$department])}}"
                               class="btn btn-light btn-lg float-end" title="Edit a department"><i
                                    class="bi bi-pencil-square"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
