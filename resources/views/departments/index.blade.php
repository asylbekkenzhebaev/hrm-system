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
            <h3>Отдел</h3>
        </div>
        @if (Auth::check())
            <div class="col-6">
                <a href="{{route('departments.create')}}" class="btn btn-success btn-lg float-end">Создать новый отдел<i
                        class="bi bi-plus-square"></i></a>
            </div>
        @endif
    </div>

    <form action="{{ route('departments.index') }}" id="search" method="GET"></form>

    <div class="row mt-2">
        <table id="departments-table" class="table table-stripped table-datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th><span class="fr-7">***</span></th>
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
                            placeholder="Поиск по названию"
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
                            name="paginate"
                            class="form-select"
                        >
                            <option value="">Показать записей</option>
                            <option value="10" @selected(10 == Request::get('paginate'))>10</option>
                            <option value="25" @selected(25 == Request::get('paginate'))>25</option>
                            <option value="50" @selected(50 == Request::get('paginate'))>50</option>
                            <option value="100" @selected(100 == Request::get('paginate'))>100</option>
                        </select>
                        <button data-name="paginate" class="btn btn-outline-danger clean-input">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </th>
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
                                  title="Удалить отдел">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-lg"><i class="bi bi-trash3"></i></button>
                            </form>
                            <a href="{{route('departments.edit', ['department'=>$department])}}"
                               class="btn btn-light btn-lg float-end" title="Редактировать отдел"><i
                                    class="bi bi-pencil-square"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="3">
                    {{ $departments->links() }}
                </th>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
