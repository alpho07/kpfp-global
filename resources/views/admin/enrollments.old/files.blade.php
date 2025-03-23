@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Files Manager
        </div>

        <div class="card-body">
            <iframe src="{{$url}}" width="100%" height="500px;" scrolling="no" style="overflow:hidden; margin-top:-4px; margin-left:-4px; border:none;"></iframe>
        </div>
    </div>


@endsection

