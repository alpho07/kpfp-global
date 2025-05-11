@extends('layouts.main')

@section('content')
<div class="whole-wrap ">
    <div class="container box_1170" style="margin-top:100px; background:#ECECEC;">
        <div class="section-top-border" style="margin-left: 10px">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <div class="row" style="margin-top: 10px;">
                <div class="col-lg-6 col-md-6">
                    <h3 class="mb-30">Successful Registration & Authentication</h3>
                    <div class="alert alert-info">
                        <p style='color:black;'>
                            Dear {{$user->first_name}},<br><!-- comment -->
                            You have successfully completed your registration and now fully signed in to the portal.
                        </p>
                    </div>
                    <div class="">
                        <h4>Please select an action from below:</h4>
                        <ol>
                            <li>
                                <a href="{{url('apply/0/'.$course->id.'?q=#step-1')}}" class="btn btn-sm btn-success">Continue with my current application for {{@$course->course_manager->name}} at {{@$institution->name}}</a>
                            </li>
                            <li>
                                <a style="margin-top:20px" href="{{url('courses?institution='.$institution->id)}}" class="btn btn-sm btn-warning">Change to a new course at {{@$institution->name}}  </a>
                            </li>
                            
                            <li>
                                <a style="margin-top:20px" href="{{route('home')}}" class="btn btn-sm btn-primary">Change to a new course at another Institution  </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Disable browser back button
    history.pushState(null, '', location.href);
    window.addEventListener('popstate', function () {
        history.pushState(null, '', location.href);
        alert("Back navigation is disabled on this page.");
    });

// Disable right-click context menu
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
        alert("Right-click is disabled on this page.");
    });
</script>

@endsection
