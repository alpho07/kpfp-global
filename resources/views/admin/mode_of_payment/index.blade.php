@extends('layouts.admin')
@section('content')
    <style>
        .dt-buttons {
            display: none;
        }
    </style>

    @if ($institutions->count() > 0)
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.mode-of-payment.create') }}">
                {{ trans('global.add') }} Payment Details
            </a>
        </div>
    </div>
    @else
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.mode-of-payment.create') }}">
                    {{ trans('global.add') }} Payment Details
                </a>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Payment Details
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Institution">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.institution.fields.id') }}
                            </th>
                            <th>
                                Mobile Provider
                            </th>
                            <th>
                                Number/Paybill
                            </th>
                            <th>
                                Number/Paybill Account
                            </th>
                            <th>
                                Bank Name
                            </th>
                            <th>
                                Bank Branch
                            </th>
                            <th>
                                Bank Account Name
                            </th>
                            <th>
                                Bank Account Number
                            </th>
                            <th>
                                Fee Amount
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($institutions as $key => $institution)
                            <tr data-entry-id="{{ $institution->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $institution->id ?? '' }}
                                </td>
                                <td>
                                    {{ $institution->mobile_name ?? '' }}
                                </td>
                                <td>
                                    {{ $institution->mobile_number ?? '' }}
                                </td>
                                <td>
                                    {{ $institution->mobile_paybill_no ?? '' }}
                                </td>
                                <td>
                                    {{ $institution->bank_name ?? '' }}
                                </td>
                                <td>
                                    {{ $institution->bank_branch ?? '' }}
                                </td>
                                <td>
                                    {{ $institution->account_name ?? '' }}
                                </td>
                                <td>
                                    {{ $institution->account_number ?? '' }}
                                </td>
                                <td>
                                    {{ number_format($institution->amount, 2) ?? ($institution->amount ?? '') }}
                                </td>

                                <td>


                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('admin.mode-of-payment.edit', $institution->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>



                                    <!--form action="{{ route('admin.mode-of-payment.destroy', $institution->id) }}"
                                                method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger"
                                                    value="Delete">
                                            </form-->

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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('institution_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('home') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            $('.datatable-Institution:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endsection
