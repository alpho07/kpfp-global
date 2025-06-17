<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        padding: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        padding: 5px;
    }

    th,
    td {
        border: 1px solid #C0C0C0;
        padding: 5px;
        text-align: left;

    }

    th {
        background-color: #f2f2f2;
    }

    /* Print Styles */
    @media print {
        body {
            margin: 0;
            padding: 10px;
        }

        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Hide elements not needed in print */
        .hide-in-print {
            display: none;
        }
    }


    .writing_area {
        background-color: #E7E6E6;
    }

    select,
    input,
    textarea {
        text-transform: uppercase;
    }

</style>
<section class=" section_padding" >
    <div class="container">
        <section>
            <div class="content-wrapper1">
                <form>
                    <table class="">
                        {{ @csrf_field() }}
                        <thead>
                            <tr >
                                <td colspan="4">
                        <center> @include('partials.toplogo') </center>
                        </td>
                        </tr>
                        <tr>
                        <p style="height: 10px">&nbsp;</p>
                        </tr>
                        <tr>
                            <th colspan="4">
                        <center>
                            <p style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size:20px; font-weight:bold;">KENYA PAEDIATRIC FELLOWSHIP PROGRAM (KPFP) <br>SPONSORSHIP APPLICATION
                                FORM</p>
                        </center>
                        </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4">
                                    Prerequisites for KPFP Fellowship sponsorship: (tick &#10004 all
                                    applicable fields)
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
                                            University, Moi University, Gertrude's/other public medical
                                            training
                                            institution, NEST sites, College of Paediatrics sites,
                                            National/County teaching & referral hospitals, FBO
                                            hospitals.
                                        </li>
                                    </ul>
                                </td>
                                <td style="text-align: right; ">
                                    <input type="checkbox" style="height:20px; width:20px;"
                                           {{ isset($checklist[0]) && $checklist[0]->aof_govt == 'on' ? 'checked' : '' }}
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
                                <td style="text-align: right">
                                    <input type="checkbox"  style="height:20px; width:20px;"
                                           {{ isset($checklist[0]) && $checklist[0]->aof_ea == 'on' ? 'checked' : '' }}
                                    name="aof_ea" id="aof_ea" class="aof_ea" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    2. Committed to complete training and bonding without defaulting
                                </td>
                                <td style="text-align: right">
                                    <input type="checkbox"  style="height:20px; width:20px;"
                                           {{ isset($checklist[0]) && $checklist[0]->commitment == 'on' ? 'checked' : '' }}
                                    name="commitment" id="commitment" class="commitment" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    3. Not a previous beneficiary of the Kenya Paediatric Fellowship
                                    Program (KPFP)
                                </td>
                                <td style="text-align: right">
                                    <input type="checkbox"  style="height:20px; width:20px;"
                                           {{ isset($checklist[0]) && $checklist[0]->not_beneficiary == 'on' ? 'checked' : '' }}
                                    name="not_beneficiary" id="not_beneficiary" class="not_beneficiary" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <b class="alert alert-info">All applicants are to attach
                                        the
                                        following documentation: </b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    1. Completed KPFP sponsorship application & bonding forms;
                                    pre-authorization (during the application), release & bonding (once
                                    admitted)
                                </td>
                                <td>

                                </td>
                                <td style="text-align: right">
                                    <input type="checkbox" value="yes" checked  style="height:20px; width:20px;"/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    2. Personal statement/reflective thinking summary about your passion
                                    for the course and desired impact post-training </td>
                                <td></td>
                                <td style="text-align: right">
                                    <input type="checkbox"  style="height:20px; width:20px;"
                                           {{ isset($uploaded_documents[0]) && $uploaded_documents[0]->document_id==1 ? 'checked' : '' }}/>


                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    3. Updated curriculum vitae
                                <td>
                                </td>
                                <td style="text-align: right">
                                    <input type="checkbox"  style="height:20px; width:20px;"
                                           {{ isset($uploaded_documents[1]) && $uploaded_documents[1]->document_id==2 ? 'checked' : '' }} />

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    4. Copies of relevant academic certificates, licenses, and
                                    transcripts(Scan and combine)
                                <td>
                                </td>
                                <td style="text-align: right">
                                    <input type="checkbox"  style="height:20px; width:20px;"
                                           {{ isset($uploaded_documents[2]) && $uploaded_documents[2]->document_id==3 ? 'checked' : '' }} />

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    5. Copy of national identity card/passport
                                <td>
                                </td>
                                <td style="text-align: right">
                                    <input type="checkbox"  style="height:20px; width:20px;"
                                           {{ isset($uploaded_documents[3]) && $uploaded_documents[3]->document_id==4 ? 'checked' : '' }} />

                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <b class="alert alert-warning">NOTE: An application that does not
                                        comply with the above requirements will be regarded as
                                        incomplete.</b>
                                </td>
                            </tr>


                            <tr>
                                <td colspan="2" class="writing_area">
                                    <b>APPLICANT INFORMATION</b>
                                </td>
                                <td colspan="2">
                                    <b>APPLICATION DATE:
                                        {{ isset($application[0]) ? $application[0]->application_date : date('Y-m-d') }}
                                </td>
                            </tr>



                            <tr>
                                <td colspan="1">
                                    First Name: {{ isset($application[0]) ? $application[0]->first_name : '' }}
                                </td>
                                <td colspan="1">
                                    Surname: {{ isset($application[0]) ? $application[0]->surname : '' }}

                                </td>
                                <td colspan="2">
                                    Preffered Name:
                                    {{ isset($application[0]) ? $application[0]->preffered_name : '' }}
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
                                    Country: Kenya
                                    <p style="height: 100px">
                                        &nbsp;
                                    </p>
                                    County: {{ isset($application[0]) ? $application[0]->county : '-Select County-' }}

                                </td>
                                <td colspan="1">
                                    Town/City: {{ isset($application[0]) ? $application[0]->town_city : '' }}
                                </td>
                                <td colspan="2">
                                    <p>Affiliated Hospital/Institution:
                                        <u>{{ isset($application[0]) ? $application[0]->affiliated_hospital : '' }}</u></p>

                                    <p>Number of years worked in named institution:
                                        <u>{{ isset($application[0]) ? $application[0]->years_worked : '' }}</u></p>
                                    <p>For Paediatricians, also indicate number of years worked with the
                                        preauthorizing institution post specialization
                                        Current Area/Department of Work:
                                        <u>{{ isset($application[0]) ? $application[0]->preauth_inst_no_of_work_yrs : '' }}</u></p>


                                    <p>Employment/Licence No:
                                        <u>{{ isset($application[0]) ? $application[0]->license_no : '' }}</u></p>

                                    <p> Country regulatory body registration No:
                                        <u>{{ isset($application[0]) ? $application[0]->registration_no : '' }}</u></p>

                                    <p> Current Job Group (if applicable):
                                        <u>{{ isset($application[0]) ? $application[0]->job_group : '' }}</u></p>

                                    <p>Current Gross Monthly Salary in KSH:
                                        <u>{{ isset($application[0]) ? $application[0]->monthly_salary : '' }}</u></p>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="1">
                                    Phone No.: {{ isset($application[0]) ? $application[0]->phone_no : '' }}
                                </td>
                                <td colspan="3">
                                    E-Mail Address: {{ isset($application[0]) ? $application[0]->email_ : '' }}
                                </td>

                            </tr>

                            <tr>
                                <td colspan="1">
                                    Sex: Male <input type="checkbox" value="male" name="gender"
                                                     {{ isset($application[0]) && $application[0]->gender == 'male' ? 'checked' : '' }}
                                    id="first_name">
                                    Female
                                    <input type="checkbox" value="female" name="gender" id="gender"
                                           {{ isset($application[0]) && $application[0]->gender == 'female' ? 'checked' : '' }} />
                                </td>
                                <td colspan="1">
                                    National ID/Passport:
                                    {{ isset($application[0]) ? $application[0]->national_id_pass : '' }}
                                </td>
                                <td colspan="1">
                                    Date of Birth: {{ isset($application[0]) ? $application[0]->date_of_birth : '' }}
                                </td>
                                <td colspan="1">
                                    Age(Years): {{ isset($application[0]) ? $application[0]->age_years : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1">
                                    Date available to begin training:
                                    {{ isset($application[0]) ? $application[0]->date_to_begin : '' }}
                                </td>
                                <td colspan="3">
                                    Specialty or Sub-speciality applied for:
                                    {{ isset($application[0]) ? $application[0]->speciality : '' }}<br>
                                    Indicate Training Institution applied with:
                                    {{ isset($application[0]) ? $application[0]->training_institution_with : '' }}
                                </td>
                            </tr>



                            <tr>
                                <td colspan="4" class="writing_area">
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
                                    Yes <input type="checkbox" value="Yes" name="funding_source"
                                               {{ isset($application[0]) && $application[0]->funding_source == 'Yes' ? 'checked' : '' }}
                                    id="funding_source_yes"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    No <input type="checkbox" value="No" name="funding_source"
                                              {{ isset($application[0]) && $application[0]->funding_source == 'No' ? 'checked' : '' }}
                                    id="funding_source_no">
                                    <br>
                                    {{ isset($application[0]) ? $application[0]->funding_source_yes_desc : '' }}
                                </td>
                            </tr>


                            <tr>
                                <td colspan="4" class="writing_area">
                                    <b>Emergency contact details (should we need to contact you
                                        urgently)</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1">
                                    First Name:
                                    {{ isset($application[0]) ? $application[0]->emergency_first_name : '' }}
                                </td>
                                <td colspan="1">
                                    Surname: {{ isset($application[0]) ? $application[0]->emergency_surname : '' }}
                                </td>
                                <td colspan="2">
                                    Title: {{ isset($application[0]) ? $application[0]->emergency_title : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    1<sup>st</sup> Contact No:
                                    {{ isset($application[0]) ? $application[0]->emergency_first_contact_no : '' }}
                                </td>
                                <td colspan="2">
                                    2<sup>nd</sup> Contact No:
                                    {{ isset($application[0]) ? $application[0]->emergency_secondcontact_no : '' }}
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    Email: {{ isset($application[0]) ? $application[0]->emergency_email : '' }}
                                <td colspan="2">
                                    Relationship to applicant: e.g. spouse, mother, father, brother,
                                    sister, aunt, colleague, etc.:
                                    {{ isset($application[0]) ? $application[0]->emergency_relationship : '' }}
                                </td>

                            </tr>


                            <tr>
                                <td colspan="4" class="writing_area">
                                    <b>ACADEMIC HISTORY: TERTIARY EDUCATION</b>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    UNIVERSITY/COLLEGE, COUNTRY
                                </th>
                                <th>
                                    START DATE
                                </th>
                                <th>
                                    DATE OF COMPLETION
                                </th>
                                <th>
                                    DEGREE/DIPLOMA ATTAINED
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    {{ isset($academic_history[0]) ? $academic_history[0]->academic_university : '' }}
                                </td>
                                <td>
                                    {{ isset($academic_history[0]) ? $academic_history[0]->academic_start_date : '' }}
                                </td>
                                <td>
                                    {{ isset($academic_history[0]) ? $academic_history[0]->academic_completion : '' }}
                                </td>
                                <td>
                                    {{ isset($academic_history[0]) ? $academic_history[0]->academic_diplomas : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ isset($academic_history[1]) ? $academic_history[1]->academic_university : '' }}
                                </td>
                                <td>
                                    {{ isset($academic_history[1]) ? $academic_history[1]->academic_start_date : '' }}
                                </td>
                                <td>
                                    {{ isset($academic_history[1]) ? $academic_history[1]->academic_completion : '' }}
                                </td>
                                <td>
                                    {{ isset($academic_history[1]) ? $academic_history[1]->academic_diplomas : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ isset($academic_history[2]) ? $academic_history[2]->academic_university : '' }}
                                </td>
                                <td>
                                    {{ isset($academic_history[2]) ? $academic_history[2]->academic_start_date : '' }}
                                </td>
                                <td>
                                    {{ isset($academic_history[2]) ? $academic_history[2]->academic_completion : '' }}
                                </td>
                                <td>
                                    {{ isset($academic_history[2]) ? $academic_history[2]->academic_diplomas : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ isset($academic_history[3]) ? $academic_history[3]->academic_university : '' }}
                                </td>
                                <td>
                                    {{ isset($academic_history[3]) ? $academic_history[3]->academic_start_date : '' }}
                                </td>
                                <td>
                                    {{ isset($academic_history[3]) ? $academic_history[3]->academic_completion : '' }}
                                </td>
                                <td>
                                    {{ isset($academic_history[3]) ? $academic_history[3]->academic_diplomas : '' }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4" class="writing_area">
                                    <b>ANY ADDITIONAL QUALIFICATON ATTAINED</b>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    TRAINING INSTITUTION, COUNTRY
                                </th>
                                <th>
                                    START DATE
                                </th>
                                <th>
                                    DATE OF COMPLETION
                                </th>
                                <th>
                                    QUALIFICATION ATTAINED
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    {{ isset($qualification_attained[0]) ? $qualification_attained[0]->training_institution : '' }}
                                </td>
                                <td>
                                    {{ isset($qualification_attained[0]) ? $qualification_attained[0]->training_institution_start_date : '' }}
                                </td>
                                <td>
                                    {{ isset($qualification_attained[0]) ? $qualification_attained[0]->training_institution_completion : '' }}
                                </td>
                                <td>
                                    {{ isset($qualification_attained[0]) ? $qualification_attained[0]->training_institution_attained : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ isset($qualification_attained[1]) ? $qualification_attained[1]->training_institution : '' }}
                                </td>
                                <td>
                                    {{ isset($qualification_attained[1]) ? $qualification_attained[1]->training_institution_start_date : '' }}
                                </td>
                                <td>
                                    {{ isset($qualification_attained[1]) ? $qualification_attained[1]->training_institution_completion : '' }}
                                </td>
                                <td>
                                    {{ isset($qualification_attained[1]) ? $qualification_attained[1]->training_institution_attained : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="writing_area">
                                    <b>NAME OF RECOMMENDING SUPERVISOR AT THE HOSPITAL/INSTITUTION YOU
                                        ARE CURRENTLY STATIONED</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1">
                                    Title: {{ isset($application[0]) ? $application[0]->supervisor_title : '' }}
                                </td>
                                <td colspan="3">
                                    Full Name:
                                    {{ isset($application[0]) ? $application[0]->supervisor_full_name : '' }}
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    Designation:
                                    {{ isset($application[0]) ? $application[0]->supervisor_designation : '' }}
                                </td>
                                <td colspan="2">
                                    Phone No: {{ isset($application[0]) ? $application[0]->supervisor_phone_no : '' }}
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    Email Address:
                                    {{ isset($application[0]) ? $application[0]->supervisor_email : '' }}
                                </td>
                                <td colspan="2">
                                    Department:
                                    {{ isset($application[0]) ? $application[0]->supervisor_department : '' }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4" class="writing_area">
                                    <b>REFERENCES Please list 2 professional references</b>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="1">
                                    1. Title:
                                    {{ isset($professional_reference[0]) ? $professional_reference[0]->reference_title : '' }}
                                </td>
                                <td colspan="3">
                                    Full Name:
                                    {{ isset($professional_reference[0]) ? $professional_reference[0]->reference_full_name : '' }}
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    Organization:
                                    {{ isset($professional_reference[0]) ? $professional_reference[0]->reference_organization : '' }}
                                </td>
                                <td colspan="2">
                                    Phone No:
                                    {{ isset($professional_reference[0]) ? $professional_reference[0]->reference_phone_no : '' }}
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    Email Address:
                                    {{ isset($professional_reference[0]) ? $professional_reference[0]->reference_email : '' }}
                                </td>
                                <td colspan="2">
                                    Job Title:
                                    {{ isset($professional_reference[0]) ? $professional_reference[0]->reference_job_title : '' }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="1">
                                    2. Title:
                                    {{ isset($professional_reference[1]) ? $professional_reference[1]->reference_title : '' }}
                                </td>
                                <td colspan="3">
                                    Full Name:
                                    {{ isset($professional_reference[1]) ? $professional_reference[1]->reference_full_name : '' }}
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    Organization:
                                    {{ isset($professional_reference[1]) ? $professional_reference[1]->reference_organization : '' }}
                                </td>
                                <td colspan="2">
                                    Phone No:
                                    {{ isset($professional_reference[1]) ? $professional_reference[1]->reference_phone_no : '' }}
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    Email Address:
                                    {{ isset($professional_reference[1]) ? $professional_reference[1]->reference_email : '' }}
                                </td>
                                <td colspan="2">
                                    Job Title:
                                    {{ isset($professional_reference[1]) ? $professional_reference[1]->reference_job_title : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    &nbsp;
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4" class="writing_area">
                                    <b>CURRENT AND PREVIOUS EMPLOYMENT (Note: Start with the most
                                        current)</b>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    1. Organization:
                                    {{ isset($employment[0]) ? $employment[0]->previous_organization : '' }}
                                </td>
                                <td colspan="2">
                                    From: {{ isset($employment[0]) ? $employment[0]->previous_organization_from : '' }}
                                    To:
                                    {{ isset($employment[0]) ? $employment[0]->reference_previous_organization_to : '' }}
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    Job Title:
                                    {{ isset($employment[0]) ? $employment[0]->reference_previous_job_title : '' }}
                                </td>
                                <td colspan="2">
                                    Supervisor:
                                    {{ isset($employment[0]) ? $employment[0]->reference_previous_supervisor : '' }}
                                </td>

                            </tr>
                            <tr>
                                <td colspan="4">
                                    Responsibilities:
                                    <br>{{ isset($employment[0]) ? $employment[0]->reference_previous_responsibilities : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    May we contact your previous employment for a reference?
                                </td>
                                <td>
                                    Yes <input type="checkbox" value="yes" name="reference_previous_1"
                                               {{ isset($application[0]) && $application[0]->reference_previous_1 == 'yes' ? 'checked' : '' }}
                                    id="reference_previous_yes">
                                </td>
                                <td>
                                    No <input type="checkbox" value="no" name="reference_previous_1"
                                              {{ isset($application[0]) && $application[0]->reference_previous_1 == 'no' ? 'checked' : '' }}
                                    id="reference_previous_no">
                                </td>
                                <td>
                                    Phone No#
                                    ({{ isset($employment[0]) ? $employment[0]->reference_previous_phone_no : '' }})

                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    2. Organization:
                                    {{ isset($employment[1]) ? $employment[1]->previous_organization : '' }}
                                </td>
                                <td colspan="2">
                                    From: {{ isset($employment[1]) ? $employment[1]->previous_organization_from : '' }}
                                    To:
                                    {{ isset($employment[1]) ? $employment[1]->reference_previous_organization_to : '' }}

                            </tr>
                            <tr>
                                <td colspan="2">
                                    Job Title:
                                    {{ isset($employment[1]) ? $employment[1]->reference_previous_job_title : '' }}
                                </td>
                                <td colspan="2">
                                    Supervisor:
                                    {{ isset($employment[1]) ? $employment[1]->reference_previous_supervisor : '' }}
                                </td>

                            </tr>
                            <tr>
                                <td colspan="4">
                                    Responsibilities:<br>
                                    {{ isset($employment[1]) ? $employment[1]->reference_previous_responsibilities : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    May we contact your previous employment for a reference?
                                </td>
                                <td>
                                    Yes <input type="checkbox" value="yes" name="reference_previous_2"
                                               {{ isset($application[0]) && $application[0]->reference_previous_2 == 'yes' ? 'checked' : '' }}
                                    id="reference_previous_yes">
                                </td>
                                <td>
                                    No <input type="checkbox" value="no" name="reference_previous_2"
                                              {{ isset($application[0]) && $application[0]->reference_previous_2 == 'no' ? 'checked' : '' }}
                                    id="reference_previous_no">
                                </td>
                                <td>
                                    Phone No#
                                    ({{ isset($employment[1]) ? $employment[1]->reference_previous_phone_no : '' }})


                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    3. Organization:
                                    {{ isset($employment[2]) ? $employment[2]->previous_organization : '' }}
                                </td>
                                <td colspan="2">
                                    From:
                                    {{ isset($employment[2]) ? $employment[2]->previous_organization_from : '' }}
                                    To:
                                    {{ isset($employment[2]) ? $employment[2]->reference_previous_organization_to : '' }}
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    Job Title:
                                    {{ isset($employment[2]) ? $employment[2]->reference_previous_job_title : '' }}
                                </td>
                                <td colspan="2">
                                    Supervisor:
                                    {{ isset($employment[2]) ? $employment[2]->reference_previous_supervisor : '' }}
                                </td>

                            </tr>
                            <tr>
                                <td colspan="4">
                                    Responsibilities:<br>
                                    {{ isset($employment[2]) ? $employment[2]->reference_previous_responsibilities : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    May we contact your previous employment for a reference?
                                </td>
                                <td>
                                    Yes <input type="checkbox" value="yes" name="reference_previous_3"
                                               {{ isset($application[0]) && $application[0]->reference_previous_3 == 'yes' ? 'checked' : '' }}
                                    id="reference_previous_yes">
                                </td>
                                <td>
                                    No <input type="checkbox" value="no" name="reference_previous_3"
                                              {{ isset($application[0]) && $application[0]->reference_previous_3 == 'no' ? 'checked' : '' }}
                                    id="reference_previous_no">
                                </td>
                                <td>
                                    Phone No#
                                    ({{ isset($employment[2]) ? $employment[2]->reference_previous_phone_no : '' }})
                                </td>
                            </tr>




                            <tr>
                                <td colspan="4" class="writing_area">
                                    <b>PRE-AUTHORIZATION FOR RELEASE</b>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4">
                                    <b>THE CONFIRMING ENTITY<br>
                                        Statement by Confirming Officer:</b>
                                    <p></p>
                                    <p></p>
                                    <p>

                                        I hereby confirm that upon successful admission to the course
                                        applied for, ___________________________________ (fill in the name of preauthorizing entity)<br><br>
                                        hereby commits to bond and release
                                        _____________________________________ (fill in the name of the
                                        candidate) <br><br>
                                        for Training in ___________________________________(fill in
                                        the name of the course)
                                        for a period of ______________________  years from ________________________ to<br><br>
                                        ______________________<br><br>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Authorizing Officer's Name:
                                </td>
                                <td colspan="2">
                                    Designation of authorizing officer:
                                    <br>

                                    <i><strong>Example:</strong>  County employees should seek confirmation only from the Chief Officer of Health (COH)<br>
                                        <p>
                                            In the absence of the COH, the officer acting in the capacity of the COH should confirm but the form must bear the stamp of the COH. 
                                        </p>
                                    </i>


                                    Department of authorizing officer:
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    Official Stamp of the preauthorizing officer:
                                    <p>
                                    <div height="600px">&nbsp;</div>
                                    </p>

                                </td>
                                <td colspan="2">
                                    Date:

                                </td>
                            </tr>



                            <tr>
                                <td colspan="4">
                                    <b>After filling, download the form, have it signed and stamped by
                                        the Authorizing Officer, scan and then e-mail the duly completed
                                        application to the chosen training institution. </b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    &nbsp;
                                </td>
                            </tr>


                        <th>
                        <td colspan="4" class="writing_area">
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
                                    Agree <input type="checkbox" value="Agree" name="disclaimer_1"
                                                 {{ isset($disclaimer[0]) && $disclaimer[0]->disclaimer_1 == 'Agree' ? 'checked' : '' }}
                                    id="disclaimer_1_agree"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    Disagree <input type="checkbox" value="Disagree" name="disclaimer_1"
                                                    {{ isset($disclaimer[0]) && $disclaimer[0]->disclaimer_1 == 'Disagree' ? 'checked' : '' }}
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
                                    Agree <input type="checkbox" value="Agree" name="disclaimer_2"
                                                 {{ isset($disclaimer[0]) && $disclaimer[0]->disclaimer_2 == 'Agree' ? 'checked' : '' }}
                                    id="disclaimer_2_agree"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    Disagree <input type="checkbox" value="Disagree" name="disclaimer_2"
                                                    {{ isset($disclaimer[0]) && $disclaimer[0]->disclaimer_2 == 'Disagree' ? 'checked' : '' }}
                                    id="disclaimer_2_disagree">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-warning" style="color:red;">
                                        KPFP is committed to maintaining the highest degree of ethical conduct
                                        and integrity. Direct or indirect canvassing will lead to automatic
                                        disqualification. In case of any demands for bribe, kickback, payment, gift,
                                        favours, or
                                        thing of value in connection with preauthorization/release and bonding write to
                                        <a href="mailto:kpfp@kenyapaediatric.org">kpfp@kenyapaediatric.org</a>
                                    </div>
                                </td>

                            </tr>

                            <tr>
                                <td colspan="2">
                                    Signature of the Applicant:
                                </td>
                                <td colspan="2">
                                    Date:

                                </td>
                            </tr>
                    </table>
                </form>
            </div>
        </section>
    </div>
</section>
