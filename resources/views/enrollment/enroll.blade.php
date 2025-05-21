@extends('layouts.main')
<style>
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

    /* Base style for dropdown */
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

</style>
@section('content')
<div class="whole-wrap">
    <div class="container box_1170 raised-box" style="margin-top:150px; background:#ECECEC; padding: 30px; border-radius: 10px;">
        <div class="section-top-border">
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <h3 class="mb-4 text-center">Kenya Paediatric Fellowship Program (KPFP) Scholarships Portal |
                        Registration </h3>
                    <div class="alert alert-info" role="alert">
                        <b>Dear Applicant,
                            <br>
                            Please ensure that the details you provide are correct and valid so that you are able to
                            receive all information about your application from the school.</b>
                    </div>
                    @guest
                    <p class="text-center">
                        Already have an account? <a href="{{ route('enroll.handleLogin') }}">Login here</a>.
                    </p>
                    @endguest
                    <form method="POST" action="{{ route('enroll.store') }}" id="myForm">
                        @csrf

                        <div class="form-group">
                            <input type="text" name="first_name" placeholder="First Name" required
                                   class="nice-input" value="{{ old('first_name') }}">
                            @error('first_name')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="middle_name" placeholder="Middle Name (Optional)"
                                   class="nice-input" value="{{ old('middle_name') }}">
                            @error('middle_name')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="last_name" placeholder="Last Name" required class="nice-input"
                                   value="{{ old('last_name') }}">
                            @error('last_name')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="id_number" min="8"
                                   placeholder="National ID / Passport Number" required class="nice-input" minlength="8"
                                   value="{{ old('id_number') }}">
                            @error('id_number')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email Address" required
                                   class="nice-input" value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Phone Number" required
                                   class="nice-input" value="{{ old('phone') }}">
                            @error('phone')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="dob" id="DOBPicker" placeholder="Date of Birth (YYYY-MM-DD)"
                                   required class="nice-input" value="{{ old('dob') }}">
                            @error('dob')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select class="nice-select" name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('gender')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group" id="county-dropdown-container" style="display: none;">
                            <select class="form-control" name="county" id="county-dropdown">
                                <option value="">Select County</option>
                            </select>
                        </div>

                        @guest
                        <div class="form-group password-container">
                            <span>Password must have 8 Characters and atleast one capital letter, on number and one symbol and not #</span>
                            <input type="password" name="password" id="password" placeholder="Password" required
                                   class="nice-input">
                            <span class="toggle-password" onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </span>
                            @error('password')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group password-container">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   placeholder="Confirm Password" required class="nice-input">
                            <span class="toggle-password" onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye"></i>
                            </span>
                            @error('password_confirmation')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>
                        @endguest

                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Password Toggle Script --}}
<script>
    document.getElementById('myForm').addEventListener('submit', function () {
        let submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Submitting...';
    });


    function togglePassword(fieldId) {
        let field = document.getElementById(fieldId);
        let icon = field.nextElementSibling.querySelector("i");

        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            field.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


{{-- Font Awesome for Icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .password-container {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>
@endsection
