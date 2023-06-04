@extends('layouts/app')

@section('content')

    <div class="row justify-content-center" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактировать сотрудника</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employees.update', $employee) }}">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">ФИО</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('fio') is-invalid @enderror"
                                       name="fio"
                                       value="@if(old('fio')) {{old('fio')}} @else {{$employee->fio }} @endif"
                                       required autocomplete="fio" autofocus>

                                @error('fio')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="birthday"
                                   class="col-md-4 col-form-label text-md-end">День рождения</label>

                            <div class="col-md-6">

                                <input id="birthday" type="date"
                                       class="form-control @error('birthday') is-invalid @enderror"
                                       name="birthday"
                                       value="{{date_format(date_create($employee->birthday), 'Y-m-d')}}" required
                                       autocomplete="birthday">

                                @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender"
                                   class="col-md-4 col-form-label text-md-end">Пол</label>

                            <div class="col-md-6">
                                <select id="gender" name="gender_id"
                                        class="form-select @error('gender_id') is-invalid @enderror" required
                                        autocomplete="gender" data-live-search="true">
                                    <option value="0">Выбрать пол</option>
                                    @foreach($genders as $gender)
                                        <option value="{{ $gender->id }}"
                                        @if(old('gender_id') == $gender->id or $employee->gender_id == $gender->id)
                                            {{ "selected" }}
                                            @endif
                                        >{{ $gender->name }}</option>
                                    @endforeach
                                </select>

                                @error('gender_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="department"
                                   class="col-md-4 col-form-label text-md-end">Отдел</label>

                            <div class="col-md-6">
                                <select id="department" name="department_id"
                                        class="form-select @error('department_id') is-invalid @enderror department_event"
                                        required autocomplete="gender" data-live-search="true"
                                        data-aa="{{old('department_id')}}">
                                    <option value="0">Выбрать отдел</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}"
                                        @if(old('department_id') == $department->id)
                                            {{ "selected" }}
                                            @elseif(empty(old('department_id')) && !empty($employee_position))
                                            {{ $employee_position->department_id == $department->id ? "selected" : "" }}
                                            @endif
                                        >{{ $department->name }}</option>
                                    @endforeach
                                </select>

                                @error('department_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="position"
                                   class="col-md-4 col-form-label text-md-end">Должность</label>
                            <div class="col-md-6">
                                <select id="position" name="position_id"
                                        class="form-select @error('position_id') is-invalid @enderror" required
                                        autocomplete="position"
                                        data-position-id="{{old('position_id') ?? $employee_position->id ?? 0}}">
                                    <option value="">Выбрать должность</option>
                                </select>

                                @error('position_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Применить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
