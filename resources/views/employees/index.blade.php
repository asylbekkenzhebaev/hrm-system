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
            <h3>Employees</h3>
        </div>
        @if (Auth::check())
            <div class="col-6">
                <a href="{{route('employees.create')}}" class="btn btn-success btn-lg float-end">Create a new employee<i
                        class="bi bi-plus-square"></i></a>

            </div>
        @endif
    </div>

    <div class="row mt-2">
        <table id="employees-table" class="table table-stripped table-datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>Department</th>
                <th>Position</th>
                <th><span class="fr-21">***</span></th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{$employee->id}}</td>
                    <td>{{$employee->fio}}</td>
                    <td>{{date('d-m-Y', strtotime($employee->birthday))}}</td>
                    <td>{{$employee->gender->name ?? 'not found'}}</td>
                    <td>{{$employee->position->department->name ?? 'not found'}}</td>
                    <td>{{$employee->position->name ?? 'not found'}}</td>
                    <td>

                        @if (Auth::check())
                            <form action="{{route('employees.destroy', $employee)}}" method="POST" class="float-end"
                                  title="Delete a employee">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-lg"><i class="bi bi-trash3"></i></button>
                            </form>
                            <a href="{{route('employees.edit', ['employee'=>$employee])}}"
                               class="btn btn-light btn-lg float-end" title="Edit a employee"><i
                                    class="bi bi-pencil-square"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
