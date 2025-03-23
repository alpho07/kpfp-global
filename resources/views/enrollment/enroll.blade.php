@extends('layouts.main')

@section('content')
    <div class="whole-wrap">
        <div class="container box_1170" style="margin-top:100px; background:#ECECEC; padding: 30px; border-radius: 10px;">
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
                                    class="form-control" value="{{ old('first_name') }}">
                                @error('first_name')
                                    <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="middle_name" placeholder="Middle Name (Optional)"
                                    class="form-control" value="{{ old('middle_name') }}">
                                @error('middle_name')
                                    <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="last_name" placeholder="Last Name" required class="form-control"
                                    value="{{ old('last_name') }}">
                                @error('last_name')
                                    <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="id_number" min="8"
                                    placeholder="National ID / Passport Number" required class="form-control" minlength="8"
                                    value="{{ old('id_number') }}">
                                @error('id_number')
                                    <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email Address" required
                                    class="form-control" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="phone" placeholder="Phone Number" required
                                    class="form-control" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="dob" id="DOBPicker" placeholder="Date of Birth (YYYY-MM-DD)"
                                    required class="form-control" value="{{ old('dob') }}">
                                @error('dob')
                                    <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="gender">
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
                                    <input type="password" name="password" id="password" placeholder="Password" required
                                        class="form-control">
                                    <span class="toggle-password" onclick="togglePassword('password')">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    @error('password')
                                        <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group password-container">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        placeholder="Confirm Password" required class="form-control">
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
        document.getElementById('myForm').addEventListener('submit', function() {
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
