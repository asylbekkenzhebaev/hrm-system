@extends('layouts/app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создать новую должность</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('positions.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="department"
                                   class="col-md-4 col-form-label text-md-end">Отдел</label>

                            <div class="col-md-6">
                                <select id="department" name="department_id"
                                        class="form-select @error('department_id') is-invalid @enderror" required
                                        autocomplete="department">
                                    <option value="0">Выбрать отдел</option>
                                    @foreach($departments as $department)
                                        <option
                                            value="{{ $department->id }}" {{ old('department_id') == $department->id ? "selected" : "" }}>{{ $department->name }}</option>
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
                            <label for="name" class="col-md-4 col-form-label text-md-end">Название</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Создать
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
