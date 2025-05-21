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
        box-shadow: inset 1em 1em var(--nice-input-color);
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

    textarea {
        word-break: break-all !important;
    }

    select option {
        text-transform: capitalize;
    }

    .error {
        border: 1px solid red;
    }


    .upload-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 400px;
    }

    .upload-wrapper input[type="file"] {
        display: none;
    }

    .file-label {
        flex: 1;
        padding: 12px 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fff;
        font-size: 14px;
        color: #666;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .upload-btn {
        padding: 12px 20px;
        background-color: #4a90e2;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .upload-btn:hover {
        background-color: #357ac8;
    }

    .raised-box {
        background-color: white;
        border: 1px solid #ccc;
        box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
        padding: 1rem;
        border-radius: 5px;
    }
    /* Base style for nice input boxes */
    .nice-input {
        width: 100%;
        padding: 12px 16px;
        font-size: 16px;
        font-family: 'Segoe UI', sans-serif;
        color: #333;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .nice-input:focus {
        border-color: #4a90e2;
        box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.2);
    }

    /* Optional: Input with icon inside */
    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #888;
    }

    .input-wrapper .nice-input {
        padding-left: 36px;
    }


    .checkbox-wrapper {
        display: flex;
        align-items: center;
        cursor: pointer;
        user-select: none;
        gap: 8px;
    }

    .checkbox-wrapper input[type="checkbox"] {
        appearance: none;
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }

    .checkbox-wrapper input[type="checkbox"]:checked {
        background-color: #4a90e2;
        border-color: #4a90e2;
    }

    .checkbox-wrapper input[type="checkbox"]::after {
        content: '';
        position: absolute;
        width: 6px;
        height: 10px;
        border: solid #fff;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
        top: 2px;
        left: 6px;
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .checkbox-wrapper input[type="checkbox"]:checked::after {
        opacity: 1;
    }

    .checkbox-label {
        font-size: 16px;
        color: #333;
    }

    .upload-form {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
        max-width: 500px;
    }

    .upload-form input[type="file"] {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
    }

    .upload-form button {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .upload-form button:hover {
        background-color: #218838;
    }

    .nice-select {
        appearance: none; /* Remove default arrow */
        -webkit-appearance: none;
        -moz-appearance: none;

        width: 100%;
        padding: 12px 16px;
        font-size: 16px;
        font-family: 'Segoe UI', sans-serif;
        color: #333;
        background-color: #fff;

        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        outline: none;

        background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg fill='%23666' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px 16px;
    }

    .nice-select:focus {
        border-color: #4a90e2;
        box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.2);
    }

    .styled-textarea {
        width: 100%;
        max-width: 600px;
        min-height: 120px;
        padding: 12px 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
        line-height: 1.5;
        resize: vertical;
        background-color: #fff;
        color: #333;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .styled-textarea:focus {
        border-color: #4a90e2;
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
        outline: none;
    }

    .radio-group {
        display: flex;
        flex-direction: column;
        gap: 12px;
        font-family: sans-serif;
    }

    .custom-radio {
        position: relative;
        padding-left: 36px;
        cursor: pointer;
        user-select: none;
        display: inline-flex;
        align-items: center;
        font-size: 16px;
        color: #333;
    }

    .custom-radio input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .checkmark {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        height: 20px;
        width: 20px;
        background-color: #fff;
        border: 2px solid #ccc;
        border-radius: 50%;
        transition: border-color 0.3s ease;
    }

    .custom-radio input:checked ~ .checkmark {
        border-color: #4caf50;
        animation: pulse 0.3s ease;
    }

    .custom-radio input:checked ~ .checkmark::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(1);
        font-size: 14px;
        color: #4caf50;
        transition: transform 0.3s ease;
    }

    .checkmark::after {
        content: '';
        transform: scale(0);
    }

    @keyframes pulse {
        0% {
            transform: scale(1.3);
        }
        100% {
            transform: scale(1);
        }
    }

</style>
<section class=" section_padding_1" style="background: #E6E6E6; margin-top: 120px;">
    <div class="container">
        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
        </div>
        <!-- SmartWizard html -->
        <div id="smartwizard">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="#step-1">
                        <div class="num">1</div>
                        Completing Checklist
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-2">
                        <span class="num">2</span>
                        Document Upload
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-3">
                        <span class="num">3</span>
                        Making Application
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-4">
                        <span class="num">4</span>
                        Consent Request & Submission
                    </a>
                </li>

            </ul>

            <div class="tab-content" style="">
                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                    <section class="">
                        <div class="content-wrapper1 ">
                            <div class="row ">
                                <form enctype="multipart/form-data" method="post"
                                      action="{{ route('save.checklist', [0, $course->id]) }}?q=#step=2"
                                      id="ChecklistForm">
                                    <table class="paper-style table  table-responsive" style="background:#F9F9F9">
                                        {{ @csrf_field() }}
                                        <input type="hidden" value="{{ $course->id }}" name="scholarship_id" />
                                        <thead>
                                            <tr>
                                                <th colspan="4">
                                        <center>
                                            KENYA PAEDIATRIC FELLOWSHIP PROGRAM (KPFP) SPONSORSHIP
                                            APPLICATION
                                            FORM
                                        </center>
                                        </th>
                                        <tr>
                                            <th colspan="4">
                                        <center style="color:blue; font-weight: bold;">
                                            Application for: {{@$course->course_manager->name}} at {{@$course->institution->name}}  
                                        </center>
                                        </th>
                                        </tr>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    Prerequisites for KPFP Fellowship sponsorship: (tick &#10004 all
                                                    applicable fields)
                                                    <div class="alert alert-warning">Please note that any box that is
                                                        not ticked will mean it's a 'No'</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    1. Area of Work
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <ul>
                                                        <li style="padding-left:30px; display: block !important;">
                                                            Working in a Government Hospital, (priority to KPFP phase 1
                                                            beneficiary facilities), faculty in University of Nairobi,
                                                            Aga Khan
                                                            University, Moi University, Gertrude’s/other public medical
                                                            training
                                                            institution, NEST sites, College of Paediatrics sites,
                                                            National/County teaching & referral hospitals, FBO
                                                            hospitals.
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td style="text-align: right;">
                                                    <input type="checkbox" style="width: 20px;height:30px;"
                                                           {{ ($checklist[0]->aof_govt ?? '') === 'on' ? 'checked' : '' }}
                                                    name="aof_govt" id="aof_govt" class="aof_govt" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <ul>
                                                        <li style="padding-left:30px;">
                                                            Eastern Africa region (Uganda, Tanzania, Ethiopia, Sudan,
                                                            South
                                                            Sudan) and ELMA supported countries (Malawi, Rwanda) for the
                                                            paeditricians
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td style="text-align: right;">
                                                    <input type="checkbox" style="width: 20px;height:30px;"
                                                           {{  ($checklist[0]->aof_eac ?? '') === 'on' ? 'checked' : '' }}
                                                    name="aof_ea" id="aof_ea" class="aof_ea" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    2. Committed to complete training and bonding without defaulting
                                                </td>
                                                <td style="text-align: right;">
                                                    <input type="checkbox" style="width: 20px;height:30px;"
                                                           {{($checklist[0]->commitment ?? '') === 'on' ? 'checked' : '' }}
                                                    name="commitment" id="commitment" class="commitment" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    3. Not a previous beneficiary of the Kenya Paediatric Fellowship
                                                    Program (KPFP)
                                                </td>
                                                <td style="text-align: right;">
                                                    <input type="checkbox" style="width: 20px;height:30px;"
                                                           {{ ($checklist[0]->not_beneficiary ?? '') === 'on' ? 'checked' : '' }}
                                                    name="not_beneficiary" id="not_beneficiary"
                                                    class="not_beneficiary" />
                                                </td>
                                            </tr>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" style="text-align: right">
                                                    <input class="btn btn-sm btn-primary" type="button" id="submitBtn"
                                                           value="Save & Go to Uploads >" />
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
                <div id="step-2" class="tab-pane raised-box" role="tabpanel" aria-labelledby="step-2">
                    <section class="">
                        <div class="content-wrapper1 ">
                            <div class="row">

                                <table class="paper-style table  table-responsive" style="background:#F9F9F9">
                                    <thead>
                                        <tr>
                                            <th colspan="4">
                                                <h4>Document Uploads | KPFP SPONSORSHIP APPLICATION FORM</h4><br>
                                                <p>
                                                    @if (session('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                                @endif

                                                @if ($errors->any())
                                                <div class="alert alert-danger" role="alert">
                                                    @foreach ($errors->all() as $error)
                                                    <p>{{ $error }}</p>
                                                    @endforeach
                                                </div>
                                                @endif

                                                </p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td colspan="4">
                                                <b class="alert alert-info">Please Browse and attach all the required documentation and upload each. Download_v* means document is uploaded </b>
                                            </td>
                                        </tr>
                                        <!--tr>
                                            <td colspan="2">
                                                1. Completed KPFP sponsorship application & bonding forms;
                                                pre-authorization (during the application), release & bonding (once
                                                admitted)<br>
                                                <small style="color:blue">
                                                    ** Will be validated as the application continues
                                                </small>
                                            </td>
                                            <td>

                                            </td>
                                            <td style="text-align: right;">

                                            </td>
                                        </tr-->
                                        @php
                                        $i = 1;
                                        @endphp
                                        @foreach ($documents as $document)
                                        @if ($document->id < 5)
                                        <tr>
                                            <td colspan="1">
                                                {{ $i }}. {{ $document->file_name }} <br>
                                                <small style="color:blue">
                                                    ** Only pdf file allowed with max size of 2MB
                                                </small>
                                            </td>
                                            <td colspan="2">

                                                <form
                                                    action="{{ route('student.documents.upload', [@$checklist[0]->id, @$course->id]) }}"
                                                    method="POST" enctype="multipart/form-data" class="upload-form">
                                                    @csrf

                                                    <input type="hidden" name="document_id"
                                                           value="{{ $document->id }}">
                                                    <input type="file" name="document"
                                                           class="nice-input mb-2" required>
                                                    <button type="submit"
                                                            class="btn btn-success btn-sm">Upload</button>
                                                </form>

                                            </td>
                                            <td>

                                                @php
                                                $matchingDocuments = $uploaded_documents->where('document_id', $document->id);
                                                @endphp

                                                @if ($matchingDocuments->isEmpty())
                                                <div class="text-danger">No document uploaded</div>
                                                @else
                                                <table>
                                                    @foreach ($matchingDocuments as $studentDocument)
                                                    <tr>
                                                        <td>
                                                            @if($studentDocument->file_path)
                                                            <a href="{{ Storage::url($studentDocument->file_path) }}">
                                                                {{ 'Download_v' . $studentDocument->version }}
                                                            </a>
                                                            @else
                                                            <div class="text-danger">No document uploaded</div>
                                                            @endif
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                                @endif

                                            </td>
                                        </tr>
                                        @endif
                                        @php
                                        $i++;
                                        @endphp
                                        @endforeach


                                        <tr>
                                            <td colspan="5">
                                                <div class="alert alert-warning">NOTE: An application that does not
                                                    comply with the above requirements will be regarded as
                                                    incomplete.</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                    <th>

                                    <td colspan="4" style="text-align: right">
                                        <a href="{{ route('apply.scholarship', [@$checklist[0]->id, @$course->id]) }}?q=#step-1"
                                           class="btn btn-sm btn-secondary">
                                            < Back to Checklist</a>
                                        @if ($uploaded_documents->count() >= 4)
                                        <a href="{{ route('step.three', [@$checklist[0]->id, @$course->id]) }}"
                                           class="btn btn-sm btn-primary">Save & Go to Application
                                            ></a>
                                        @else
                                        <input class="btn btn-sm btn-primary" disabled
                                               value="Save & Go to Application >" /><br>
                                        <small style="color:red">Please upload all required documents
                                            to
                                            activate</small>
                                        @endif
                                    </td>
                                    </th>
                                    </tfoot>

                                </table>

                            </div>
                        </div>
                    </section>
                </div>
                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                    @if (count($checklist) > 0)
                    <section>
                        <div class="content-wrapper1">
                            <form enctype="multipart/form-data" method="post"
                                  action="{{ route('save.application', [@$checklist[0]->id, @$course->id]) }}?q=#step=2"
                                  onsubmit="return validateForm()" id="myForm">
                                <table class="paper-style table  table-responsive" style="background:#F9F9F9">
                                    {{ @csrf_field() }}
                                    <input type="hidden" value="{{ $course->id }}" name="scholarship_id" />

                                    <thead>
                                        <tr>
                                            <td colspan="2">
                                                <b>APPLICANT INFORMATION</b>
                                            </td>
                                            <td colspan="2">
                                                <b>APPLICATION DATE: <input
                                                        value="{{ @$application[0]->application_date ?? date('Y-m-d') }}"
                                                        type="text" name="application_date"
                                                        id="application_date" class="nice-input " readonly
                                                        required></b>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td colspan="1">
                                                First Name: <input type="text" name="first_name"
                                                                   id="first_name"
                                                                   value="{{ $application[0]->first_name ?? auth()->user()->first_name }}"
                                                                   class="nice-input" required>
                                            </td>
                                            <td colspan="1">
                                                Surname: <input type="text" name="surname" id="surname"
                                                                value="{{  $application[0]->surname ?? auth()->user()->last_name }}"
                                                                class="nice-input" required>
                                            </td>
                                            <td colspan="2">
                                                Preffered Name: <input type="text" name="preffered_name"
                                                                       value="{{ $application[0]->preffered_name ?? '' }}"
                                                                       id="preffered_name" class="nice-input" required>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                Home Address:
                                            </td>
                                            <td colspan="2">
                                                Postal Address:
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="1">
                                                Country: <select name="country" id="country"
                                                                 class="nice-select">
                                                    <option value="Kenya">Kenya</option>
                                                </select><br>
                                                <p style="height: 100px">
                                                    &nbsp;
                                                </p>
                                                County: <select name="county" id="county"
                                                                class="nice-select" required>
                                                    <option
                                                        value="{{ $application[0]->county ?? '' }}">
                                                        {{  $application[0]->county ?? '-Select County-' }}
                                                    </option>
                                                    <option value="baringo">Baringo</option>
                                                    <option value="bomet">Bomet</option>
                                                    <option value="bungoma">Bungoma</option>
                                                    <option value="busia">Busia</option>
                                                    <option value="elgeyo marakwet">Elgeyo Marakwet</option>
                                                    <option value="embu">Embu</option>
                                                    <option value="garissa">Garissa</option>
                                                    <option value="homa bay">Homa Bay</option>
                                                    <option value="isiolo">Isiolo</option>
                                                    <option value="kajiado">Kajiado</option>
                                                    <option value="kakamega">Kakamega</option>
                                                    <option value="kericho">Kericho</option>
                                                    <option value="kiambu">Kiambu</option>
                                                    <option value="kilifi">Kilifi</option>
                                                    <option value="kirinyaga">Kirinyaga</option>
                                                    <option value="kisii">Kisii</option>
                                                    <option value="kisumu">Kisumu</option>
                                                    <option value="kitui">Kitui</option>
                                                    <option value="kwale">Kwale</option>
                                                    <option value="laikipia">Laikipia</option>
                                                    <option value="lamu">Lamu</option>
                                                    <option value="machakos">Machakos</option>
                                                    <option value="makueni">Makueni</option>
                                                    <option value="mandera">Mandera</option>
                                                    <option value="meru">Meru</option>
                                                    <option value="migori">Migori</option>
                                                    <option value="marsabit">Marsabit</option>
                                                    <option value="mombasa">Mombasa</option>
                                                    <option value="muranga">Muranga</option>
                                                    <option value="nairobi">Nairobi</option>
                                                    <option value="nakuru">Nakuru</option>
                                                    <option value="nandi">Nandi</option>
                                                    <option value="narok">Narok</option>
                                                    <option value="nyamira">Nyamira</option>
                                                    <option value="nyandarua">Nyandarua</option>
                                                    <option value="nyeri">Nyeri</option>
                                                    <option value="samburu">Samburu</option>
                                                    <option value="siaya">Siaya</option>
                                                    <option value="taita taveta">Taita Taveta</option>
                                                    <option value="tana river">Tana River</option>
                                                    <option value="tharaka nithi">Tharaka Nithi</option>
                                                    <option value="trans nzoia">Trans Nzoia</option>
                                                    <option value="turkana">Turkana</option>
                                                    <option value="uasin gishu">Uasin Gishu</option>
                                                    <option value="vihiga">Vihiga</option>
                                                    <option value="wajir">Wajir</option>
                                                    <option value="pokot">West Pokot</option>
                                                </select>
                                            </td>
                                            <td colspan="1">
                                                Town/City: <br>
                                                <textarea id="town_city" name="town_city" class="styled-textarea" required>
                                                        {{ $application[0]->town_city ?? '' }}
                                                </textarea>
                                            </td>
                                            <td colspan="2">
                                                Affiliated Hospital/Institution: <input type="text"
                                                                                        name="affiliated_hospital" id="affiliated_hospital"
                                                                                        class="nice-input"
                                                                                        value="{{  $application[0]->affiliated_hospital ?? '' }}"
                                                                                        required>
                                                <br>
                                                Number of years worked in named institution: <input type="number"
                                                                                                    required
                                                                                                    value="{{  $application[0]->years_worked ?? '' }}"
                                                                                                    name="years_worked" id="years_worked" class="nice-input">
                                                <br>
                                                For Paediatricians, also indicate number of years worked with the
                                                preauthorizing institution post specialization
                                                Current Area/Department of Work: <input type="text" required
                                                                                        name="preauth_inst_no_of_work_yrs"
                                                                                        value="{{  $application[0]->preauth_inst_no_of_work_yrs ?? '' }}"
                                                                                        id="preauth_inst_no_of_work_yrs" class="nice-input">
                                                <br>
                                                Employment/Licence No: <input type="text" name="license_no"
                                                                              required
                                                                              value="{{  $application[0]->license_no ?? '' }}"
                                                                              id="license_no" class="nice-input"> <br>
                                                Country regulatory body registration No:<input type="text"
                                                                                               required
                                                                                               value="{{  $application[0]->registration_no ?? '' }}"
                                                                                               name="registration_no" id="registration_no"
                                                                                               class="nice-input">
                                                <br>
                                                Current Job Group (if applicable): <input type="text"
                                                                                          value="{{  $application[0]->job_group ?? '' }}"
                                                                                          name="job_group" id="job_group" class="nice-input "
                                                                                          required>
                                                <br>
                                                Current Gross Monthly Salary in KSH: <input type="number" required
                                                                                            value="{{  $application[0]->monthly_salary ?? '' }}"
                                                                                            name="Monthly_salary" id="Monthly_salary"
                                                                                            class="nice-input">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="1">
                                                Phone No.: <input type="text" name="phone_no" id="phone_no"
                                                                  required
                                                                  value="{{  $application[0]->phone_no ?? '' }}"
                                                                  class="nice-input">
                                            </td>
                                            <td colspan="3">
                                                E-Mail Address: <input type="text" name="email_"
                                                                       id="email_" required
                                                                       value="{{  $application[0]->email_ ?? auth()->user()->email }}"
                                                                       class="nice-input">
                                            </td>

                                        </tr>

                                        <tr>
                                            <td colspan="1">
                                                Sex: Male <input type="radio" value="male" name="gender"
                                                                 required
                                                                 {{ ($application[0]->gender ?? '') === 'male' ? 'checked' : '' }}
                                                id="first_name">
                                                Female
                                                <input type="radio" value="female" name="gender"
                                                       id="gender" required
                                                       {{ ($application[0]->gender ?? '') == 'female' ? 'checked' : '' }}>
                                            </td>
                                            <td colspan="1">
                                                National ID/Passport: <input type="text"
                                                                             name="national_id_pass" required
                                                                             value="{{ $application[0]->national_id_pass ?? '' }}"
                                                                             id="national_id_pass" class="nice-input">
                                            </td>
                                            <td colspan="1">
                                                Date of Birth <input type="text" name="date_of_birth" required
                                                                     value="{{ $application[0]->date_of_birth ?? '' }}"
                                                                     id="DATE_OF_BIRTH" class="nice-input datepicker-11">
                                            </td>
                                            <td colspan="1">
                                                Age(Years): <input type="text" name="age_years" id="age_years"
                                                                   readonly required
                                                                   value="{{  $application[0]->age_years ?? '' }}"
                                                                   class="nice-input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">
                                                Date available to begin training: <input type="text"
                                                                                         type="text" required
                                                                                         value="{{  $application[0]->date_to_begin ?? '' }}"
                                                                                         name="date_to_begin" id="date_to_begin"
                                                                                         class="nice-input datepicker-12">
                                            </td>
                                            <td colspan="3">
                                                Specialty or Sub-speciality applied for: <input type="text"
                                                                                                required
                                                                                                value="{{  $application[0]->speciality ?? '' }}"
                                                                                                name="speciality" id="speciality" class="nice-input"> <br>
                                                Indicate Training Institution applied with: <input type="text"
                                                                                                   required
                                                                                                   value="{{ $application[0]->training_institution_with ?? '' }}"
                                                                                                   name="training_institution_with"
                                                                                                   id="training_institution_with" class="nice-input">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">
                                                &nbsp;
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">
                                                <b>FUNDING: Tick appropriately</b>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="1">
                                                Do you have any other funding source to cover training costs either
                                                partially or fully? <br>
                                                <p></p>
                                                If Yes, indicate how much this other funding is and the source
                                            </td>
                                            <td colspan="3">
                                                Yes <input type="radio" value="Yes" name="funding_source"
                                                           required
                                                           {{ ($application[0]->funding_source ?? '') === 'Yes' ? 'checked' : '' }}
                                                id="funding_source_yes">
                                                No <input type="radio" value="No" name="funding_source"
                                                          required
                                                          {{ ($application[0]->funding_source ?? '') === 'No' ? 'checked' : '' }}
                                                id="funding_source_no">
                                                <br>
                                                <input type="number" name="funding_source_yes_desc"
                                                       value="{{  $application[0]->funding_source_yes_desc ?? '' }}"
                                                       id="funding_source_yes_desc" class="nice-input">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">
                                                &nbsp;
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">
                                                <b>Emergency contact details (should we need to contact you
                                                    urgently)</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">
                                                First Name: <input type="text" name="emergency_first_name"
                                                                   required
                                                                   value="{{ $application[0]->emergency_first_name ?? '' }}"
                                                                   id="first_name" class="nice-input">
                                            </td>
                                            <td colspan="1">
                                                Surname: <input type="text" name="emergency_surname" required
                                                                value="{{  $application[0]->emergency_surname ?? '' }}"
                                                                id="surname" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                Title: <input type="text" name="emergency_title" required
                                                              value="{{  $application[0]->emergency_title ?? '' }}"
                                                              id="emergency_title" class="nice-input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                1<sup>st</sup> Contact No: <input type="text" required
                                                                                  name="emergency_first_contact_no"
                                                                                  id="emergency_first_contact_no"
                                                                                  value="{{  $application[0]->emergency_first_contact_no ?? '' }}"
                                                                                  class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                2<sup>nd</sup> Contact No: <input type="text"
                                                                                  name="emergency_secondcontact_no"
                                                                                  id="emergency_second_contact_no"
                                                                                  value="{{  $application[0]->emergency_secondcontact_no ?? '' }}"
                                                                                  class="nice-input">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Email: <input type="email" name="emergency_email" required
                                                              value="{{  $application[0]->emergency_email ?? '' }}"
                                                              id="emergency_email" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                Relationship to applicant: e.g. spouse, mother, father, brother,
                                                sister, aunt, colleague, etc.: <input type="text" required
                                                                                      name="emergency_relationship" id="emergency_relationship"
                                                                                      value="{{  $application[0]->emergency_relationship ?? '' }}"
                                                                                      class="nice-input">
                                            </td>

                                        </tr>

                                        <tr>
                                            <td colspan="4">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <b>ACADEMIC HISTORY: TERTIARY EDUCATION</b>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                UNIVERSITY/COLLEGE, COUNTRY
                                            </td>
                                            <td>
                                                START DATE
                                            </td>
                                            <td>
                                                DATE OF COMPLETION
                                            </td>
                                            <td>
                                                DEGREE/DIPLOMA ATTAINED
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="text" name="academic_university[]" required
                                                       value="{{  $academic_history[0]->academic_university ?? '' }}"
                                                       id="academic_university1" class="nice-input">
                                            </td>
                                            <td>
                                                <input type="text" name="academic_start_date[]" required
                                                       value="{{  $academic_history[0]->academic_start_date ?? '' }}"
                                                       id="academic_start_date1" class="nice-input datepicker-1">
                                            </td>
                                            <td>
                                                <input type="text" name="academic_completion[]" required
                                                       value="{{  $academic_history[0]->academic_completion ?? '' }}"
                                                       id="academic_completion1" class="nice-input datepicker-1">
                                            </td>
                                            <td>
                                                <input type="text" name="academic_diplomas[]" required
                                                       value="{{  $academic_history[0]->academic_diplomas ?? '' }}"
                                                       id="academic_diploms1" class="nice-input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="academic_university[]"
                                                       value="{{  $academic_history[1]->academic_university ?? '' }}"
                                                       id="academic_university1" class="nice-input">
                                            </td>
                                            <td>
                                                <input type="text" name="academic_start_date[]"
                                                       value="{{  $academic_history[1]->academic_start_date ?? '' }}"
                                                       id="academic_start_date7" class="nice-input datepicker-1">
                                            </td>
                                            <td>
                                                <input type="text" name="academic_completion[]"
                                                       value="{{  $academic_history[1]->academic_completion ?? '' }}"
                                                       id="academic_completion8" class="nice-input datepicker-1">
                                            </td>
                                            <td>
                                                <input type="text" name="academic_diplomas[]"
                                                       value="{{  $academic_history[1]->academic_diplomas ?? '' }}"
                                                       id="academic_diploms1" class="nice-input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="academic_university[]"
                                                       value="{{  $academic_history[2]->academic_university ?? '' }}"
                                                       id="academic_university1" class="nice-input">
                                            </td>
                                            <td>
                                                <input type="text" name="academic_start_date[]"
                                                       value="{{  $academic_history[2]->academic_start_date ?? '' }}"
                                                       id="academic_start_date2" class="nice-input datepicker-1">
                                            </td>
                                            <td>
                                                <input type="text" name="academic_completion[]"
                                                       value="{{  $academic_history[2]->academic_completion ?? '' }}"
                                                       id="academic_completion2" class="nice-input datepicker-1">
                                            </td>
                                            <td>
                                                <input type="text" name="academic_diplomas[]"
                                                       value="{{  $academic_history[2]->academic_diplomas ?? '' }}"
                                                       id="academic_diploms1" class="nice-input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="academic_university[]"
                                                       value="{{  $academic_history[3]->academic_university ?? '' }}"
                                                       id="academic_university1" class="nice-input">
                                            </td>
                                            <td>
                                                <input type="text" name="academic_start_date[]"
                                                       value="{{  $academic_history[3]->academic_start_date ?? '' }}"
                                                       id="academic_start_date3" class="nice-input datepicker-1">
                                            </td>
                                            <td>
                                                <input type="text" name="academic_completion[]"
                                                       value="{{  $academic_history[3]->academic_completion ?? '' }}"
                                                       id="academic_completion3" class="nice-input datepicker-1">
                                            </td>
                                            <td>
                                                <input type="text" name="academic_diplomas[]"
                                                       value="{{ $academic_history[3]->academic_diplomas ?? '' }}"
                                                       id="academic_diploms1" class="nice-input">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="4">
                                                <b>ANY ADDITIONAL QUALIFICATON ATTAINED</b>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                TRAINING INSTITUTION, COUNTRY
                                            </td>
                                            <td>
                                                START DATE
                                            </td>
                                            <td>
                                                DATE OF COMPLETION
                                            </td>
                                            <td>
                                                QUALIFICATION ATTAINED
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="training_institution[]"
                                                       value="{{  $qualification_attained[0]->training_institution ?? '' }}"
                                                       id="academic_university1" class="nice-input">
                                            </td>
                                            <td>
                                                <input type="text" name="training_institution_start_date[]"
                                                       value="{{  $qualification_attained[0]->training_institution_start_date ?? '' }}"
                                                       id="qualification_attained1"
                                                       class="nice-input datepicker-1">
                                            </td>
                                            <td>
                                                <input type="text" name="training_institution_completion[]"
                                                       value="{{  $qualification_attained[0]->training_institution_completion ?? '' }}"
                                                       id="qualification_attained2"
                                                       class="nice-input datepicker-1">
                                            </td>
                                            <td>
                                                <input type="text" name="training_institution_attained[]"
                                                       value="{{ $qualification_attained[0]->training_institution_attained ?? '' }}"
                                                       id="academic_diploms1" class="nice-input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="training_institution[]"
                                                       value="{{  $qualification_attained[1]->training_institution ?? '' }}"
                                                       id="academic_university1" class="nice-input">
                                            </td>
                                            <td>
                                                <input type="text" name="training_institution_start_date[]"
                                                       value="{{  $qualification_attained[1]->training_institution_start_date ?? '' }}"
                                                       id="qualification_attained3"
                                                       class="nice-input datepicker-1">
                                            </td>
                                            <td>
                                                <input type="text" name="training_institution_completion[]"
                                                       value="{{ $qualification_attained[1]->training_institution_completion ?? '' }}"
                                                       id="qualification_attained4"
                                                       class="nice-input datepicker-1">
                                            </td>
                                            <td>
                                                <input type="text" name="training_institution_attained[]"
                                                       value="{{ $qualification_attained[1]->training_institution_attained ?? '' }}"
                                                       id="academic_diploms1" class="nice-input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <b>NAME OF RECOMMENDING SUPERVISOR AT THE HOSPITAL/INSTITUTION YOU
                                                    ARE CURRENTLY STATIONED</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">
                                                Title: <input type="text" name="supervisor_title" required
                                                              value="{{  $application[0]->supervisor_title ?? '' }}"
                                                              id="supervisor_title" class="nice-input">
                                            </td>
                                            <td colspan="3">
                                                Full Name: <input type="text" name="supervisor_full_name"
                                                                  required
                                                                  value="{{  $application[0]->supervisor_full_name ?? '' }}"
                                                                  id="supervisor_full_name" class="nice-input">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Designation: <input type="text" name="supervisor_designation"
                                                                    required
                                                                    value="{{  $application[0]->supervisor_designation ?? '' }}"
                                                                    id="supervisor_designation" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                Phone No: <input type="text" name="supervisor_phone_no"
                                                                 required
                                                                 value="{{  $application[0]->supervisor_phone_no ?? '' }}"
                                                                 id="supervisor_phone_no" class="nice-input">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Email Address: <input type="email" name="supervisor_email"
                                                                      required
                                                                      value="{{  $application[0]->supervisor_email ?? '' }}"
                                                                      id="supervisor_email" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                Department: <input type="text" name="supervisor_department"
                                                                   required
                                                                   value="{{  $application[0]->supervisor_department ?? '' }}"
                                                                   id="supervisor_department" class="nice-input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <b>REFERENCES Please list 2 professional references</b>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="1">
                                                1. Title: <input type="text" name="reference_title[]" required
                                                                 value="{{  $professional_reference[0]->reference_title ?? '' }}"
                                                                 id="reference_title" class="nice-input">
                                            </td>
                                            <td colspan="3">
                                                Full Name: <input type="text" name="reference_full_name[]"
                                                                  required
                                                                  value="{{  $professional_reference[0]->reference_full_name ?? '' }}"
                                                                  id="reference_full_name" class="nice-input">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Organization: <input type="text"
                                                                     name="reference_organization[]" required
                                                                     value="{{  $professional_reference[0]->reference_organization ?? '' }}"
                                                                     id="reference_organization" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                Phone No: <input type="text" name="reference_phone_no[]"
                                                                 required
                                                                 value="{{  $professional_reference[0]->reference_phone_no ?? '' }}"
                                                                 id="reference__phone_no" class="nice-input">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Email Address: <input type="email" name="reference_email[]"
                                                                      required
                                                                      value="{{  $professional_reference[0]->reference_email ?? '' }}"
                                                                      id="supervisor_email" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                Job Title: <input type="text" name="reference_job_title[]"
                                                                  required
                                                                  value="{{  $professional_reference[0]->reference_job_title ?? '' }}"
                                                                  id="supervisor_department" class="nice-input">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="1">
                                                2. Title: <input type="text" name="reference_title[]" required
                                                                 value="{{ $professional_reference[1]->reference_title ?? '' }}"
                                                                 id="reference_title" class="nice-input">
                                            </td>
                                            <td colspan="3">
                                                Full Name: <input type="text" name="reference_full_name[]"
                                                                  required
                                                                  value="{{  $professional_reference[1]->reference_full_name ?? '' }}"
                                                                  id="reference_full_name" class="nice-input">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Organization: <input type="text"
                                                                     name="reference_organization[]" required
                                                                     value="{{ $professional_reference[1]->reference_organization ?? '' }}"
                                                                     id="reference_organization" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                Phone No: <input type="text" name="reference_phone_no[]"
                                                                 required
                                                                 value="{{  $professional_reference[1]->reference_phone_no ?? '' }}"
                                                                 id="reference__phone_no" class="nice-input">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Email Address: <input type="email" name="reference_email[]"
                                                                      required
                                                                      value="{{ $professional_reference[1]->reference_email ?? '' }}"
                                                                      id="supervisor_email" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                Job Title: <input type="text" name="reference_job_title[]"
                                                                  required
                                                                  value="{{  $professional_reference[1]->reference_job_title ?? '' }}"
                                                                  id="supervisor_department" class="nice-input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <b>CURRENT AND PREVIOUS EMPLOYMENT (Note: Start with the most
                                                    current)</b>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                1. Organization: <input type="text"
                                                                        name="previous_organization[]" required
                                                                        value="{{  $employment[0]->previous_organization ?? '' }}"
                                                                        id="reference_organization1" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                From: <input type="date" name="previous_organization_from[]"
                                                             required
                                                             value="{{ $employment[0]->previous_organization_from ?? '' }}"
                                                             id="reference__phone_no_from1" class="nice-input FROM1">
                                                To: <input type="date"
                                                           name="reference_previous_organization_to[]" required
                                                           value="{{  $employment[0]->reference_previous_organization_to ?? '' }}"
                                                           id="reference__phone_no_to1" class="nice-input TO1">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Job Title: <input type="text"
                                                                  name="reference_previous_job_title[]" required
                                                                  value="{{  $employment[0]->reference_previous_job_title ?? '' }}"
                                                                  id="supervisor_department" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                Supervisor: <input type="text"
                                                                   name="reference_previous_supervisor[]" id="supervisor_email"
                                                                   required
                                                                   value="{{  $employment[0]->reference_previous_supervisor ?? '' }}"
                                                                   class="nice-input">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                Responsibilities:<br>
                                                <textarea width="100%" class="styled-textarea" required name="reference_previous_responsibilities[]"
                                                          id="reference_previous_responsibilities">{{  $employment[0]->reference_previous_responsibilities ?? '' }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                May we contact your previous employment for a reference?
                                            </td>
                                            <td>
                                                Yes <input type="radio" value="yes"
                                                           name="reference_previous_1"
                                                           {{  ($application[0]->reference_previous_1 ?? '') === 'yes' ? 'checked' : '' }}
                                                id="reference_previous_yes">
                                            </td>
                                            <td>
                                                No <input type="radio" value="no"
                                                          name="reference_previous_1"
                                                          {{  ($application[0]->reference_previous_1 ?? '') === 'no' ? 'checked' : '' }}
                                                id="reference_previous_no">
                                            </td>
                                            <td>
                                                Phone No#<input type="number" type="text"
                                                                name="reference_previous_phone_no[]"
                                                                value="{{ $employment[0]->reference_previous_phone_no ?? '' }}"
                                                                id="reference_previous_phone_no" class="nice-input"> <br>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                2. Organization: <input type="text"
                                                                        name="previous_organization[]"
                                                                        value="{{ $employment[1]->previous_organization ?? '' }}"
                                                                        id="reference_organization" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                From: <input type="text" name="previous_organization_from[]"
                                                             value="{{  $employment[1]->previous_organization_from ?? '' }}"
                                                             id="reference__phone_no_from2" class="nice-input FROM">
                                                To: <input type="text"
                                                           name="reference_previous_organization_to[]"
                                                           value="{{  $employment[1]->reference_previous_organization_to ?? '' }}"
                                                           id="reference__phone_no_to2" class="nice-input TO">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Job Title: <input type="text"
                                                                  name="reference_previous_job_title[]"
                                                                  value="{{  $employment[1]->reference_previous_job_title ?? '' }}"
                                                                  id="supervisor_department" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                Supervisor: <input type="text"
                                                                   name="reference_previous_supervisor[]" id="supervisor_email"
                                                                   value="{{  $employment[1]->reference_previous_supervisor ?? '' }}"
                                                                   class="nice-input">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                Responsibilities:<br>
                                                <textarea width="100%" class="styled-textarea" name="reference_previous_responsibilities[]" id="reference_previous_responsibilities">{{  $employment[1]->reference_previous_responsibilities ?? '' }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                May we contact your previous employment for a reference?
                                            </td>
                                            <td>
                                                Yes <input type="radio" value="yes"
                                                           name="reference_previous_2"
                                                           {{  ($application[0]->reference_previous_2 ?? '') === 'yes' ? 'checked' : '' }}
                                                id="reference_previous_yes">
                                            </td>
                                            <td>
                                                No <input type="radio" value="no"
                                                          name="reference_previous_2"
                                                          {{ ($application[0]->reference_previous_2 ?? '') === 'no' ? 'checked' : '' }}
                                                id="reference_previous_no">
                                            </td>
                                            <td>
                                                Phone No#<input type="text"
                                                                name="reference_previous_phone_no[]"
                                                                value="{{ $employment[1]->reference_previous_phone_no ?? '' }}"
                                                                id="reference_previous_phone_no" class="nice-input"> <br>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                3. Organization: <input type="text"
                                                                        name="previous_organization[]"
                                                                        value="{{  $employment[2]->previous_organization ?? '' }}"
                                                                        id="reference_organization" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                From: <input type="text" name="previous_organization_from[]"
                                                             value="{{  $employment[2]->previous_organization_from ?? '' }}"
                                                             id="reference__phone_no_from3" class="nice-input FROM">
                                                To: <input type="text"
                                                           name="reference_previous_organization_to[]"
                                                           value="{{  $employment[2]->reference_previous_organization_to ?? '' }}"
                                                           id="reference__phone_no_to3" class="nice-input TO">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Job Title: <input type="text"
                                                                  name="reference_previous_job_title[]"
                                                                  value="{{  $employment[2]->reference_previous_job_title ?? '' }}"
                                                                  id="supervisor_department" class="nice-input">
                                            </td>
                                            <td colspan="2">
                                                Supervisor: <input type="text"
                                                                   name="reference_previous_supervisor[]" id="supervisor_email"
                                                                   value="{{  $employment[2]->reference_previous_supervisor ?? '' }}"
                                                                   class="nice-input">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                Responsibilities:<br>
                                                <textarea width="100%" class="styled-textarea" name="reference_previous_responsibilities[]" id="reference_previous_responsibilities">{{  $employment[2]->reference_previous_responsibilities ?? '' }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                May we contact your previous employment for a reference?
                                            </td>
                                            <td>
                                                Yes <input type="radio" value="yes"
                                                           name="reference_previous_3"
                                                           {{  ($application[0]->reference_previous_3 ?? '') === 'yes' ? 'checked' : '' }}
                                                id="reference_previous_yes">
                                            </td>
                                            <td>
                                                No <input type="radio" value="no"
                                                          name="reference_previous_3"
                                                          {{  ($application[0]->reference_previous_3 ?? '') === 'no' ? 'checked' : '' }}
                                                id="reference_previous_no">
                                            </td>
                                            <td>
                                                Phone No#<input type="number" type="text"
                                                                value="{{  $employment[2]->reference_previous_phone_no ?? '' }}"
                                                                name="reference_previous_phone_no[]"
                                                                id="reference_previous_phone_no" class="nice-input"> <br>

                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>
                                            <td colspan="1">
                                            </td>

                                            <td colspan="2" style="text-align: right">
                                                <a href="{{ route('apply.scholarship', [$checklist[0]->id ?? 0, $course->id ?? 0]) }}?q=#step-2"
                                                   class="btn btn-sm btn-secondary">
                                                    < Back to Checklist</a>
                                                <input class="btn btn-sm btn-primary" type="submit"
                                                       id="SUBMITTAPP" value="Save & Go To Consent >" />
                                            </td>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </section>
                    @endif
                </div>
                <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">

                    <section>
                        <div class="content-wrapper1">
                            <form enctype="multipart/form-data" method="post"
                                  action="{{ route('save.disclaimer', [$checklist[0]->id ?? 0, $course->id ?? 0]) }}?q=#step=4"
                                  onsubmit="return validateForm()">
                                <table class="table  table-responsive" style="background:#F9F9F9">
                                    {{ @csrf_field() }}
                                    <input type="hidden" value="{{ $course->id }}" name="scholarship_id" />
                                    <th>
                                    <td colspan="4">
                                        <b>DISCLAIMER AND SIGNATURE</b>
                                    </td>
                                    </th>
                                    <tbody>
                                        <tr>
                                            <td colspan="4">
                                                I hereby, certify that I have provided accurate information in this
                                                application. If this application leads to a training sponsorship:
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <ul>
                                                    <li>
                                                        I understand that false or misleading information in my
                                                        application or interview may result in my dismissal.
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>

                                                Agree <input type="radio" value="Agree" name="disclaimer_1"
                                                             required
                                                             {{  ($disclaimer[0]->disclaimer_1 ?? '') === 'Agree' ? 'checked' : '' }}
                                                id="disclaimer_1_agree"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                Disagree <input type="radio" value="Disagree"
                                                                name="disclaimer_1" required
                                                                {{ ($disclaimer[0]->disclaimer_1 ?? '') === 'Disagree' ? 'checked' : '' }}
                                                id="disclaimer_1_disagree">


                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <ul>
                                                    <li>
                                                        I understand that I am expected to complete the training and
                                                        bonding without defaulting
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                Agree <input type="radio" value="Agree" name="disclaimer_2"
                                                             required
                                                             {{ ($disclaimer[0]->disclaimer_2 ?? '') === 'Agree' ? 'checked' : '' }}
                                                id="disclaimer_2_agree"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                Disagree <input type="radio" value="Disagree"
                                                                name="disclaimer_2" required
                                                                {{  ($disclaimer[0]->disclaimer_2 ?? '') === 'Disagree' ? 'checked' : '' }}
                                                id="disclaimer_2_disagree">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div class="alert alert-warning" style="color:red;">
                                                    KPFP is committed to maintaining the highest degree of ethical
                                                    conduct
                                                    and integrity. Direct or indirect canvassing will lead to
                                                    automatic
                                                    disqualification. In case of any demands for bribe, kickback,
                                                    payment, gift, favours, or
                                                    thing of value in connection with preauthorization/release and
                                                    bonding write to
                                                    <a
                                                        href="mailto:kpfp@kenyapaediatric.org">kpfp@kenyapaediatric.org</a>
                                                </div>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td colspan="2">

                                            </td>
                                            <td colspan="2">


                                            </td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                    <th>
                                    <td colspan="2"></td>

                                    </td>
                                    <td colspan="1" style="">
                                        <a href="{{ route('apply.scholarship', [$checklist[0]->id ?? 0, $course->id ?? 0]) }}?q=#step-3"
                                           class="btn btn-sm btn-secondary">
                                            < Back to Application</a>
                                        <input class="btn btn-sm btn-primary" type="submit"
                                               value="Save & Submit Application >" />
                                    </td>

                                    <td colspan="1" style="">

                                    </td>
                                    </th>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </section>

                </div>

            </div>

            <!-- Include optional progressbar HTML -->
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                     aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('js/jquery-1.12.1.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<link href="//cdn.jsdelivr.net/npm/notyf@3/notyf.min.css" rel="stylesheet">


<script>
  $(document).ready(function () {


      message = "{{session('success')}}";

      if (message !== '') {
          notyf.open({
              type: 'success',
              message: message,
          });
      }


      function autosaveForm() {
          var form = $('#myForm');
          var formData = new FormData(form[0]); // Create FormData object from form

          $.ajax({
              url: "{{route('save.application.autosave', [@$checklist[0]->id, @$course->id])}}", // Get the form's action URL
              type: 'POST',
              data: formData,
              processData: false, // Prevent jQuery from processing the data
              contentType: false, // Prevent jQuery from setting contentType
              success: function (response) {
                  console.log('Form autosaved successfully:', response);
                  // Optionally show a success message to the user
              },
              error: function (xhr, status, error) {
                  console.error('Autosave failed:', error);
                  // Optionally show an error message to the user
              }
          });
      }

      // Trigger autosave every 30 seconds
      setInterval(autosaveForm, 30000); // 30 seconds in milliseconds



      $('#submitBtn').click(function (e) {
          if ($('#ChecklistForm input[type="checkbox"]:checked').length === 0) {
              e.preventDefault();
              const notyf = new Notyf({
                  duration: 4000, // 4 seconds
                  ripple: true, // Ripple effect
                  position: {
                      x: 'center', // Can be 'left', 'center', 'right'
                      y: 'top' // Can be 'top', 'center', 'bottom'
                  },
                  types: [{
                          type: 'error',
                          background: '#dc3545', // Bootstrap danger color
                          duration: 5000,
                          dismissible: true, // Allow users to click to dismiss
                          icon: {
                              className: 'notyf__icon--error',
                              tagName: 'i',

                          }
                      }]
              });
              notyf.open({
                  type: 'error',
                  message: 'Please select at least one item in the checklist(checkbox)',
              });
              return false;
          }
          $('#ChecklistForm').submit();
      });
  });
</script>

@endsection
