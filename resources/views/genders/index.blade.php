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
            <h3>Пол</h3>
        </div>
        @if (Auth::check())
            <div class="col-6">
                <a href="{{route('genders.create')}}" class="btn btn-success btn-lg float-end">Создать новый пол <i
                        class="bi bi-plus-square"></i></a>

            </div>
        @endif
    </div>

    <form action="{{ route('genders.index') }}" id="search" method="GET"></form>

    <div class="row mt-2">
        <table id="genders-table" class="table table-stripped table-datatable">
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
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($genders as $gender)
                <tr>
                    <td>{{$gender->id}}</td>
                    <td>{{$gender->name}}</td>
                    <td>
                        @if (Auth::check())
                            <form action="{{route('genders.destroy', $gender)}}" method="POST" class="float-end"
                                  title="Удалить пол">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-lg"><i class="bi bi-trash3"></i></button>
                            </form>
                            <a href="{{route('genders.edit', ['gender'=>$gender])}}"
                               class="btn btn-light btn-lg float-end" title="Редактировать пол"><i
                                    class="bi bi-pencil-square"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
