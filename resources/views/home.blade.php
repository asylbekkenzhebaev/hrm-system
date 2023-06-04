@extends('layouts/app')

@section('content')

    <div class="row">
        <div class="col-6">
            <h3>Вакансии</h3>
        </div>
    </div>

    <form action="{{ route('departments.index') }}" id="search" method="GET">
        <input type="hidden" name="vacancy" value="1">
    </form>

    <div class="row mt-2">
        <table id="vacancy-table" class="table table-stripped table-datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>Должность</th>
                <th>Отдел</th>
            </tr>
            <tr>
                <th>
                    <div class="input-group">
                        <input
                            type="text"
                            name="id"
                            form="search"
                            value="{{ Request::get('id') }}"
                            class="form-control"
                            autocomplete="off"
                            placeholder="Поиск по идентификатору"
                        >
                        <button data-name="id" class="btn btn-outline-danger clean-input">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <div class="input-group">
                        <input
                            type="text"
                            name="name"
                            form="search"
                            value="{{ Request::get('name') }}"
                            class="form-control"
                            autocomplete="off"
                            placeholder="Поиск по должности"
                        >
                        <button data-name="name" class="btn btn-outline-danger clean-input">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <div class="input-group">
                        <select
                            form="search"
                            name="department_id"
                            class="form-select"
                        >
                            <option value="">Выберите отдел</option>
                            @foreach($departments as $id => $department)
                                <option
                                    value="{{ $id }}" @selected($id == Request::get('department_id'))>{{ $department }}</option>
                            @endforeach
                        </select>
                        <button data-name="department_id" class="btn btn-outline-danger clean-input">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </th>
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
