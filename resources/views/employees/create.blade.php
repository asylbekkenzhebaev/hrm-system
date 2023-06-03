@extends('layouts/app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new employee</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employees.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('fio') is-invalid @enderror"
                                       name="fio" value="{{ old('fio') }}" required autocomplete="fio" autofocus>

                                @error('fio')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="birthday"
                                   class="col-md-4 col-form-label text-md-end">{{ __('Birthday') }}</label>

                            <div class="col-md-6">
                                <input id="birthday" type="date"
                                       class="form-control @error('birthday') is-invalid @enderror"
                                       name="birthday" value="{{ old('birthday') }}" required autocomplete="birthday">

                                @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender"
                                   class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" name="gender_id"
                                        class="form-select @error('gender_id') is-invalid @enderror" required
                                        autocomplete="gender" data-live-search="true">
                                    <option value="0">Select gender</option>
                                    @foreach($genders as $gender)
                                        <option
                                            value="{{ $gender->id }}" {{ old('gender_id') == $gender->id ? "selected" : "" }}>{{ $gender->name }}</option>
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
                                   class="col-md-4 col-form-label text-md-end">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                <select id="department" name="department_id"
                                        class="form-select @error('department_id') is-invalid @enderror department_event"
                                        required autocomplete="department">
                                    <option value="0">Select department</option>
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
                            <label for="position"
                                   class="col-md-4 col-form-label text-md-end">{{ __('Position') }}</label>

                            <div class="col-md-6">
                                <select id="position" name="position_id"
                                        class="form-select @error('position_id') is-invalid @enderror" required
                                        autocomplete="position" data-position-id="{{old('position_id') ?? 0}}">
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
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
