@extends('layouts.admin')
@section('content')
@can('course_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.courses.create") }}">
            {{ trans('global.add') }} Scholarship
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        Active {{ trans('cruds.course.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Course">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.course.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.course.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.course.fields.description') }}
                        </th>
                        <th>
                            Duration
                        </th>

                        <th>
                            {{ trans('cruds.course.fields.institution') }}
                        </th>

                        <th>
                            Date Open
                        </th>
                        <th>
                            Date Closing
                        </th>
                        <th>
                            Days Left
                        </th>
                        <th>
                            Status
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $key => $course)
                    <tr data-entry-id="{{ $course->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $course->id ?? '' }}
                        </td>
                        <td>
                            {{ $course->course->name ?? '' }}
                        </td>
                        <td>
                            {!! \Str::words($course->description,20,'...') ?? '' !!}
                        </td>
                        <td>
                            {{$course->course->period->name}}
                        </td>
                        <td>
                            {{ $course->institution->name ?? '' }}
                        </td>
                        <td>
                            @if($course->application_start_date)
                            {{ \Carbon\Carbon::parse($course->application_start_date)->format('l, F jS, Y') }}
                            @endif
                        </td>
                        <td>
                            @if($course->application_start_date)
                            {{ \Carbon\Carbon::parse($course->application_start_date)->format('l, F jS, Y') }}
                            @endif
                        </td>
                        <td>
                            @if($course->application_start_date)
                            {{ $course->days_left ?? '-' }} 
                            @endif
                        </td>
                        <td>
                            {{ $course->status ?? '' }}
                        </td>

                        <td>
                            @can('course_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.courses.show', $course->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('course_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.courses.edit', $course->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('course_delete')
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="Deactivate">
                            </form>
                            @endcan

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="card">
    <div class="card-header">
        Inactive {{ trans('cruds.course.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Course">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.course.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.course.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.course.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.course.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.course.fields.institution') }}
                        </th>
                        <th>
                            {{ trans('cruds.course.fields.price') }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inactiveCourses as $key => $course)
                    <tr data-entry-id="{{ $course->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $course->id ?? '' }}
                        </td>
                        <td>
                            {{ $course->name ?? '' }}
                        </td>
                        <td>
                            {!! \Str::words($course->description,20,'...') ?? '' !!}
                        </td>
                        <td>
                            @if($course->photo)
                            <a href="{{ $course->photo->getUrl() }}" target="_blank">
                                <img src="{{ $course->photo->getUrl('thumb') }}" width="50px" height="50px">
                            </a>
                            @endif
                        </td>
                        <td>
                            {{ $course->institution->name ?? '' }}
                        </td>
                        <td>
                            {{ $course->price ?? '' }}
                        </td>

                        <td>


                            @can('course_delete')
                            <form action="{{ route('admin.courses.restore', $course->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="GET">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-warning" value="Activate Scholarship">
                            </form>
                            @endcan

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('course_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
            text: deleteButtonTrans,
                    url: "{{ route('admin.courses.massDestroy') }}",
                    className: 'btn-danger',
                    action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id')
                    });
                    if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                    headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                    }
            }
    dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
            order: [[ 1, 'desc' ]],
                    pageLength: 100,
            });
    $('.datatable-Course:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
    $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    })

</script>
@endsection
