@extends('layouts.main')

@section('content')
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        transform: scale(1.03); /* Zoom out just a bit */
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2); /* More raised on hover */
    }

    .institution-logo {
        object-fit: contain;
        max-width: 100%;
    }

</style>
<section class="special_cource padding_top" style="background:#ebebef;">
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
                <div class="section_tittle1 text-center">
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
            <div class="col-sm-4 col-lg-4 col-xl-4">
                <div class="single-home-blog">
                    <div class="card" style="padding: 10px; margin-top: 20px;">
                        <div class="text-center mb-3">
                            <img src="{{ $institution->logo->getUrl() }}" height="180px" width="180px" 
                                 alt="{{ $institution->name }}" class="institution-logo">
                        </div>
                        <div class="card-body">
                            <a href="{{ route('courses.index') }}?institution={{ $institution->id }}">
                                <h6 class="card-title">{{ $institution->name }}</h6>
                            </a>
                            <!--p>{{ Str::limit($institution->description, 15) }}</p-->
                        </div>
                        <div class="card card-footer">
                            <a href="{{ route('courses.index') }}?institution={{ $institution->id }}"
                               class="btn btn-primary">View Scholarships Available ({{ $institution->courses->count()}})</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
