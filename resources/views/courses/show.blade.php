@extends('layouts.main')

@section('content')
<section class="course_details_area section_padding" >
    <div class="container">
        <div class="row">
            <div class="col-lg-8 course_details_left" >
                <div class="main_image">
                    <img class="img-fluid" src="{{ optional($course->photo)->getUrl() ?? asset('img/no_image.png') }}" style="width:350px;"
                         alt="">
                </div>
                <div class="content_wrapper">

                    @if ($course->id == 4)
                    <h4 class="title_top">A comprehensive guide on how to apply for scholarships</h4>
                    @else
                    <h4 class="title_top">Scholarship details and requirements</h4>
                    @endif
                    <div class="content" id="editor">
                        {!! $course->description ?? 'No description provided' !!}
                    </div>
                    <p></p>
                    <p>
                    <p><strong>Find Getting Started Clip below:</strong></p>



                        <iframe width="560" height="315" src="https://www.youtube.com/embed/XhyX2suWB8A?si=Pw8eWDm_qHMW6Wwh" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </p>
<!--                    <p>

                        @if ($course->id == 4)
                        <a href="{{ route('home') }}?q=#step-1" class="btn_1">Explore
                            Scholarships</a>
                        @else
                        <a href="{{ route('apply.scholarship', $course->id) }}?q=#step-1" class="btn_1">Apply
                            Now</a>
                        @endif
                    </p>-->
                </div>
            </div>


            <div class="col-lg-4 right-contents">
                <div class="sidebar_top">
                    <ul>
                        @if ($course->institution)
                        <li>
                            <a class="justify-content-between d-flex">

                                <span class="color">{{ $course->institution->name }}</span>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a class="justify-content-between d-flex">
                                @if ($course->id == 4)
                                <p>Application User Guide</p>
                                <span>{{ $course->getPrice() }}</span>
                                @else
                                <p>Scholarship Fee </p>
                                <span>FREE</span>
                                @endif
                            </a>
                        </li>

                    </ul>
                    @if ($course->id == 4)
                    <a href="{{ url('KPFP_Gertrude_User_Guide.pdf') }}" class="btn_2">Download User Guide</a>
                    @else
                    <a href="{{ route('apply.scholarship', [0,$course->id]) }}?q=#step-1" class="btn_1">Apply
                        Now</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
