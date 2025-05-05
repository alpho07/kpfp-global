@extends('layouts.main')

@section('content')
    <section class="special_cource mt-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="section_tittle text-center">
                        <h3><a href="{{ route('home') }}" class="btn btn-primary">Back</a> | {{$inst->name}} / Scholarship(s)</h3>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <ol class="course-list">
                        @foreach ($courses as $course)
                            <li class="course-item" onclick="selectCourse(this)">
                                <a href="{{ route('courses.show', $course->id) }}">
                                    <h4>{{ $course->course->name .' - '.$course->course->category->name .' ('.$course->course->period->name .')' }}</h4>
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </div>

                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="float-right">
                            {{ $courses->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .course-list {
            list-style-type: decimal;
            padding-left: 20px;
        }

        .course-item {
            border: 2px solid blue;
            padding: 2px;
            margin: 5px 0;
            border-radius: 10px;
            transition: transform 0.3s ease, background-color 0.3s ease;
            cursor: pointer;
        }

        .course-item:hover {
            transform: scale(0.95);
            /* Zoom out effect */
        }

        .course-item.selected {
            background-color: lightblue;
            border-color: darkblue;
        }
    </style>

    <script>
        function selectCourse(element) {
            // Remove 'selected' class from all items
            document.querySelectorAll('.course-item').forEach(item => {
                item.classList.remove('selected');
            });

            // Add 'selected' class to the clicked item
            element.classList.add('selected');
        }
    </script>
@endsection
