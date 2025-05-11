@extends('layouts.main')

@section('content')
<div class="whole-wrap ">
    <div class="container box_1170" style="margin-top:100px; background:#ECECEC;">
        <div class="section-top-border">
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
                    <h3 class="mb-30">Registration Process : Verification Code Authentication</h3>
                    @guest
                    <p>To complete your Registration, please check your email's Inbox/Spams for Verification Code.</p>
                    @endguest
                    <form method="POST" action="{{ route('otp.verify', [request('email')]) }}">
                        @csrf
                        <div class="mt-10">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" required
                                   value="{{ request('email') }}" readonly>
                        </div>
                        <div class="mt-10">
                            <label for="otp">Verification Code</label>
                            <input type="number" name="otp" id="otp" class="form-control" required>
                        </div>

                        {{-- <input type="hidden" name="course_id" value="{{ $course->id }}"> --}}
                        <div class="mt-10 pull-right">
                            <input type="submit" class="genric-btn primary" name="submit" value="Verify Code">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
