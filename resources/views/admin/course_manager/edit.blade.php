@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Course
    </div>

    <div class="card-body">
        <form action="{{ route("admin.course-manager.update", $discipline->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.discipline.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($discipline) ? $discipline->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.discipline.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                <label for="name">Category*</label>
                <select name="category_id" required class="form-control">
                    <option value="{{$discipline->category->id}}">{{$discipline->category->name}}</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <em class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.discipline.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('month') ? 'has-error' : '' }}">
                <label for="name">Duration Available*</label>
                <select name="month_id" required class="form-control">
                    <option value="{{$discipline->period->id}}">{{$discipline->period->name}}</option>
                    @foreach ($months as $month)
                        <option value="{{$month->id}}">{{$month->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('month'))
                    <em class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.discipline.fields.name_helper') }}
                </p>
            </div>


            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection
