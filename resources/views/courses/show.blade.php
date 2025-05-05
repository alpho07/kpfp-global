@extends('layouts.main')

@section('content')
<section class="course_details_area section_padding" >
    <div class="container">
        <div class=" text-center">

            <h2 class='mt-3'>{{$course->course->name}} Scholarship Application</h2>

        </div>
        <div class="row ">

            <div class="col-lg-8 course_details_left mt-3" >
                <div class="main_image">
                    <img src="{{ $course->institution->logo->getUrl() }}" height="300px" width="300px" 
                                 alt="{{ $course->institution->name }}" class="institution-logo">
                </div>
                <div class="content_wrapper">

                    @if ($course->id == 4)
                    <h4 class="title_top">A comprehensive guide on how to apply for scholarships</h4>
                    @else
                    <h4 class="title_top">Scholarship details and requirements</h4>
                    <ol>
                        <li>
                            Applicant must be working in a Government Hospital, (priority to KPFP phase 1 beneficiary facilities), faculty in University of Nairobi, Aga Khan University, Moi University, Gertrude’s/other public medical training institution, NEST sites, College of Paediatrics sites, National/County teaching & referral hospitals, FBO hospitals.

                            Eastern Africa region (Uganda, Tanzania, Ethiopia, Sudan, South Sudan) and ELMA supported countries (Malawi, Rwanda) for the paeditricians
                        </li>

                        <li>Must Committed to complete training and bonding without defaulting</li> 	
                        <li>Must not be a previous beneficiary of the Kenya Paediatric Fellowship Program (KPFP)</li> 
                    </ol>
                    @endif
                    <div class="content" id="editor">
                        <p>Other Requirements</p>
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


            <div class="col-lg-4 right-contents mt-2">
                <div class="sidebar_top">
                    <ul>
                        @if ($course->institution)
                        <li>
                            <a class="justify-content-between d-flex">

                                <span class="color">By: {{ $course->institution->name }}</span>
                            </a>
                        </li>
                        @endif
                        <li>
                        <li>
                            <a class="justify-content-between d-flex">                               
                                <p>Course Duration</p>
                                <span>{{$course->course->period->name}}</span>                               
                            </a>
                        </li>
                        <a class="justify-content-between d-flex">

                            @if ($course->id == 4)
                            <p>Application User Guide</p>
                            <span>{{ $course->getPrice() }}</span><br>
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
