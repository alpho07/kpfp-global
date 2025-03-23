@extends('layouts.main')

@section('content')
    <style>
        /* Apply a shadow to the outer border of the table */

        /* Apply blue outline border to all input elements */
        input[type=text],
        input[type=number],
        textarea {
            border: 1px solid #3498db;
            /* Set the border color to blue */
            outline: none;
            /* Remove the default outline */
            padding: 8px;
            /* Add padding for better appearance */
        }

        /* Add a subtle box shadow on focus to indicate interaction */
        input:focus {
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.7);
            /* Add a blue box shadow on focus */
        }


        input[type="checkbox"]::before {
            content: "";
            width: 0.65em;
            height: 0.65em;
            transform: scale(0);
            transition: 120ms transform ease-in-out;
            box-shadow: inset 1em 1em var(--form-control-color);
            background-color: CanvasText;
        }

        input[type="checkbox"]:checked::before {
            transform: scale(1);
        }




        .paper-style {

            background-color: #fff;
            border: 1px solid #0397D6;

        }

        .sw-btn {
            display: none !important;
        }
    </style>
    <section class=" section_padding_1" style="background: #E6E6E6;margin-top:150px;">
        <div class="container">
            <div class="alert alert-success" style="color:black;font-weight: bold;">
                <p>Great Work {{Auth::user()->name}}, Please download your completed form at <a href="{{route('enroll.myCourses')}}">My Scholarships</a> to take to your County for pre-authorization</p>
            </div>
        </div>

        </div>
    </section>
@endsection
