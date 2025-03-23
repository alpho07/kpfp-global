@extends('layouts.main')

@section('content')
    <section class="special_cource padding_top">
        <div class="container">


            <!--iv class="row justify-content-center">
                        <div class="col-xl-6">
                            <div class="section_tittle text-center">
                                <h2>Getting Started Guide</h2>
                            </div>
                        </div>
                    </iv>
                    <div-- class="row justify-content-center">

                        <center><iframe width="800" height="400"
                                src="https://www.youtube.com/embed/XhyX2suWB8A?si=Pw8eWDm_qHMW6Wwh" title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe></center>

                    </div-->
            <div class="row justify-content-center mt-0">
                <div class="col-xl-10">
                    <div class="section_tittle text-center">
                        <h3>Available Scholarships</h3>
                        <div class="alert alert-info" role="alert">
                            To Apply for a Scholarship, Select the institution below, then from inside the institution page,
                            select the scholarship you are interested in.
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">

                @foreach ($randomInstitutions as $institution)
                    <div class="col-sm-6 col-lg-4 col-xl-4">
                        <div class="single-home-blog">
                            <div class="card" style="padding: 10px;">
                                <img src="{{ asset('img/defaut_uni.jpg') }}" class="card-img-top"
                                    alt="{{ $institution->name }}">
                                <div class="card-body">
                                    <a href="{{ route('courses.index') }}?institution={{ $institution->id }}">
                                        <h5 class="card-title">{{ $institution->name }}</h5>
                                    </a>
                                    <!--p>{{ Str::limit($institution->description, 15) }}</p-->
                                </div>
                                <div class="card card-footer">
                                    <a href="{{ route('courses.index') }}?institution={{ $institution->id }}"
                                        class="btn btn-primary">View Scholarships Available</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
