@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Course
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.discipline.fields.id') }}
                        </th>
                        <td>
                            {{ $discipline->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $discipline->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Category
                        </th>
                        <td>
                            {{ $discipline->category->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Course Duration
                        </th>
                        <td>
                            {{ $discipline->period->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection
