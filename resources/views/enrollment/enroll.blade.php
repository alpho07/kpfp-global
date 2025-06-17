@extends('layouts.main')
<style>
    .raised-box {
        background-color: white;
        border: 1px solid #ccc;
        box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
        padding: 1rem;
        border-radius: 5px;
    }
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
    .nice-select {
        appearance: none;
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
    .error-message {
        color: #cc0000;
        font-size: 0.9em;
        margin-top: 5px;
        display: none;
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
                    <h3 class="mb-4 text-center">Kenya Paediatric Fellowship Program (KPFP) Scholarships Portal | Registration </h3>
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
                            <div class="error-message" id="first_name_error"></div>
                            @error('first_name')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="middle_name" placeholder="Middle Name (Optional)"
                                   class="nice-input" value="{{ old('middle_name') }}">
                            <div class="error-message" id="middle_name_error"></div>
                            @error('middle_name')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="last_name" placeholder="Last Name" required class="nice-input"
                                   value="{{ old('last_name') }}">
                            <div class="error-message" id="last_name_error"></div>
                            @error('last_name')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="id_number" placeholder="National ID / Passport Number" required
                                   class="nice-input" maxlength="12" value="{{ old('id_number') }}">
                            <div class="error-message" id="id_number_error"></div>
                            @error('id_number')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email Address e.g. jane@doe.com" required
                                   class="nice-input" value="{{ old('email') }}">
                            <div class="error-message" id="email_error"></div>
                            @error('email')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Phone Number e.g. 0700 000000" required
                                   class="nice-input" maxlength="10" value="{{ old('phone') }}">
                            <div class="error-message" id="phone_error"></div>
                            @error('phone')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text"  id="DOBPickerDisplay" placeholder="Date of Birth (DD-MM-YYYY)"
                                   required class="nice-input" value="{{ old('dob') }}">
                            <input type="hidden" name="dob" id="DOBPicker">
                            <div class="error-message" id="dob_error"></div>
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
                            <div class="error-message" id="gender_error"></div>
                            @error('gender')
                            <span class="text-danger" style="font-size: 0.9em;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group" id="county-dropdown-container" >
                            <select class="nice-select" name="county" id="county-dropdown" required>
                                <option value="">Select County</option>
                                <option value="baringo" {{ old('county', request('county')) == 'baringo' ? 'selected' : '' }}>
                                    Baringo</option>
                                <option value="bomet" {{ old('county', request('county')) == 'bomet' ? 'selected' : '' }}>
                                    Bomet</option>
                                <option value="bungoma" {{ old('county', request('county')) == 'bungoma' ? 'selected' : '' }}>
                                    Bungoma</option>
                                <option value="busia" {{ old('county', request('county')) == 'busia' ? 'selected' : '' }}>
                                    Busia</option>
                                <option value="elgeyo marakwet"
                                        {{ old('county', request('county')) == 'elgeyo marakwet' ? 'selected' : '' }}>Elgeyo
                                    Marakwet</option>
                                <option value="embu" {{ old('county', request('county')) == 'embu' ? 'selected' : '' }}>
                                    Embu</option>
                                <option value="garissa" {{ old('county', request('county')) == 'garissa' ? 'selected' : '' }}>
                                    Garissa</option>
                                <option value="homa bay" {{ old('county', request('county')) == 'homa bay' ? 'selected' : '' }}>
                                    Homa Bay
                                </option>
                                <option value="isiolo" {{ old('county', request('county')) == 'isiolo' ? 'selected' : '' }}>Isiolo
                                </option>
                                <option value="kajiado" {{ old('county', request('county')) == 'kajiado' ? 'selected' : '' }}>
                                    Kajiado</option>
                                <option value="kakamega" {{ old('county', request('county')) == 'kakamega' ? 'selected' : '' }}>
                                    Kakamega
                                </option>
                                <option value="kericho" {{ old('county', request('county')) == 'kericho' ? 'selected' : '' }}>
                                    Kericho</option>
                                <option value="kiambu" {{ old('county', request('county')) == 'kiambu' ? 'selected' : '' }}>Kiambu
                                </option>
                                <option value="kilifi" {{ old('county', request('county')) == 'kilifi' ? 'selected' : '' }}>Kilifi
                                </option>
                                <option value="kirinyaga" {{ old('county', request('county')) == 'kirinyaga' ? 'selected' : '' }}>
                                    Kirinyaga
                                </option>
                                <option value="kisii" {{ old('county', request('county')) == 'kisii' ? 'selected' : '' }}>
                                    Kisii</option>
                                <option value="kisumu" {{ old('county', request('county')) == 'kisumu' ? 'selected' : '' }}>Kisumu
                                </option>
                                <option value="kitui" {{ old('county', request('county')) == 'kitui' ? 'selected' : '' }}>
                                    Kitui</option>
                                <option value="kwale" {{ old('county', request('county')) == 'kwale' ? 'selected' : '' }}>
                                    Kwale</option>
                                <option value="laikipia" {{ old('county', request('county')) == 'laikipia' ? 'selected' : '' }}>
                                    Laikipia
                                </option>
                                <option value="lamu" {{ old('county', request('county')) == 'lamu' ? 'selected' : '' }}>
                                    Lamu</option>
                                <option value="machakos" {{ old('county', request('county')) == 'machakos' ? 'selected' : '' }}>
                                    Machakos
                                </option>
                                <option value="makueni" {{ old('county', request('county')) == 'makueni' ? 'selected' : '' }}>
                                    Makueni</option>
                                <option value="mandera" {{ old('county', request('county')) == 'mandera' ? 'selected' : '' }}>
                                    Mandera</option>
                                <option value="meru" {{ old('county', request('county')) == 'meru' ? 'selected' : '' }}>
                                    Meru</option>
                                <option value="migori" {{ old('county', request('county')) == 'migori' ? 'selected' : '' }}>Migori
                                </option>
                                <option value="marsabit" {{ old('county', request('county')) == 'marsabit' ? 'selected' : '' }}>
                                    Marsabit
                                </option>
                                <option value="mombasa" {{ old('county', request('county')) == 'mombasa' ? 'selected' : '' }}>
                                    Mombasa</option>
                                <option value="muranga" {{ old('county', request('county')) == 'muranga' ? 'selected' : '' }}>
                                    Muranga</option>
                                <option value="nairobi" {{ old('county', request('county')) == 'nairobi' ? 'selected' : '' }}>
                                    Nairobi</option>
                                <option value="nakuru" {{ old('county', request('county')) == 'nakuru' ? 'selected' : '' }}>Nakuru
                                </option>
                                <option value="nandi" {{ old('county', request('county')) == 'nandi' ? 'selected' : '' }}>
                                    Nandi</option>
                                <option value="narok" {{ old('county', request('county')) == 'narok' ? 'selected' : '' }}>
                                    Narok</option>
                                <option value="nyamira" {{ old('county', request('county')) == 'nyamira' ? 'selected' : '' }}>
                                    Nyamira</option>
                                <option value="nyandarua" {{ old('county', request('county')) == 'nyandarua' ? 'selected' : '' }}>
                                    Nyandarua
                                </option>
                                <option value="nyeri" {{ old('county', request('county')) == 'nyeri' ? 'selected' : '' }}>
                                    Nyeri</option>
                                <option value="samburu" {{ old('county', request('county')) == 'samburu' ? 'selected' : '' }}>
                                    Samburu</option>
                                <option value="siaya" {{ old('county', request('county')) == 'siaya' ? 'selected' : '' }}>
                                    Siaya</option>
                                <option value="taita taveta"
                                        {{ old('county', request('county')) == 'taita taveta' ? 'selected' : '' }}>Taita Taveta
                                </option>
                                <option value="tana river"
                                        {{ old('county', request('county')) == 'tana river' ? 'selected' : '' }}>Tana River
                                </option>
                                <option value="tharaka nithi"
                                        {{ old('county', request('county')) == 'tharaka nithi' ? 'selected' : '' }}>Tharaka
                                    Nithi</option>
                                <option value="trans nzoia"
                                        {{ old('county', request('county')) == 'trans nzoia' ? 'selected' : '' }}>Trans Nzoia
                                </option>
                                <option value="turkana" {{ old('county', request('county')) == 'turkana' ? 'selected' : '' }}>
                                    Turkana</option>
                                <option value="uasin gishu"
                                        {{ old('county', request('county')) == 'uasin gishu' ? 'selected' : '' }}>Uasin Gishu
                                </option>
                                <option value="vihiga" {{ old('county', request('county')) == 'vihiga' ? 'selected' : '' }}>Vihiga
                                </option>
                                <option value="wajir" {{ old('county', request('county')) == 'wajir' ? 'selected' : '' }}>
                                    Wajir</option>
                                <option value="pokot" {{ old('county', request('county')) == 'pokot' ? 'selected' : '' }}>
                                    West Pokot</option>
                            </select>
                            <div class="error-message" id="county_error"></div>
                        </div>

                        @guest
                        <div class="form-group password-container">
                            <small>Password must have 8+ characters, including one capital letter, one number, and one symbol (except # or `)</small>
                            <input type="password" name="password" id="password" placeholder="Password" required
                                   class="nice-input">
                            <span class="toggle-password" onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </span>
                            <div class="error-message" id="password_error"></div>
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
                            <div class="error-message" id="password_confirmation_error"></div>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
                                document.getElementById('myForm').addEventListener('submit', function (e) {
                                    let submitBtn = document.getElementById('submitBtn');
                                    submitBtn.disabled = true;
                                    submitBtn.innerHTML = 'Submitting...';

                                    // Perform final validation before submission
                                    const errors = validateForm();
                                    if (errors.length > 0) {
                                        e.preventDefault();
                                        displayErrors(errors);
                                        submitBtn.disabled = false;
                                        submitBtn.innerHTML = 'Submit';
                                    }
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

                                // Real-time validation
                                $(document).ready(function () {
                                    // Prevent non-numeric input for ID number and phone
                                    $('input[name="id_number"], input[name="phone"]').on('input', function (e) {
                                        this.value = this.value.replace(/[^0-9]/g, '');
                                    });

                                    // Prevent # and ` in password
                                    $('input[name="password"], input[name="password_confirmation"]').on('input', function (e) {
                                        this.value = this.value.replace(/[#'`]/g, '');
                                    });

                                    function displayErrors(errors) {
                                        // Clear all error messages
                                        $('.error-message').text('').hide();

                                        // Display errors for each field
                                        errors.forEach(error => {
                                            $('#' + error.field + '_error').text(error.message).show();
                                        });
                                    }

                                    function validateForm() {
                                        const errors = [];
                                        const phone = $('input[name="phone"]').val();
                                        const idNumber = $('input[name="id_number"]').val();
                                        const email = $('input[name="email"]').val();
                                        const password = $('input[name="password"]').val();
                                        const confirmPassword = $('input[name="password_confirmation"]').val();
                                        const firstName = $('input[name="first_name"]').val();
                                        const lastName = $('input[name="last_name"]').val();
                                        const dob = $('input[name="dob"]').val();
                                        const gender = $('select[name="gender"]').val();

                                        // First name validation
                                        if (!firstName) {
                                            errors.push({field: 'first_name', message: 'First name is required'});
                                        }

                                        // Last name validation
                                        if (!lastName) {
                                            errors.push({field: 'last_name', message: 'Last name is required'});
                                        }

                                        // ID number validation
                                        const idRegex = /^[0-9]{8}$/;
                                        if (!idNumber) {
                                            errors.push({field: 'id_number', message: 'ID number is required, only numbers allowed'});
                                        } else if (!idRegex.test(idNumber)) {
                                            errors.push({field: 'id_number', message: 'ID number must be exactly 8 digits'});
                                        }

                                        // Email validation
                                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                        if (!email) {
                                            errors.push({field: 'email', message: 'Email is required'});
                                        } else if (!emailRegex.test(email)) {
                                            errors.push({field: 'email', message: 'Please enter a valid email address'});
                                        }

                                        // Phone validation
                                        const phoneRegex = /^(01|07)[0-9]{8}$/;
                                        if (!phone) {
                                            errors.push({field: 'phone', message: 'Phone number is required, only numbers allowed'});
                                        } else if (!phoneRegex.test(phone)) {
                                            errors.push({field: 'phone', message: 'Phone number must start with 01 or 07 and be exactly 10 digits'});
                                        }

                                        // Date of birth validation
                                        if (!dob) {
                                            errors.push({field: 'dob', message: 'Date of birth is required, Please pick from the datepicker'});
                                        }

                                        // Gender validation
                                        if (!gender) {
                                            errors.push({field: 'gender', message: 'Gender is required'});
                                        }

                                        // Password validation
                                        const passwordRegex = /^[A-Za-z0-9@!$%^&*()_+\-=\[\]{};:'\",.<>?]{8,}$/;
                                        if (!password) {
                                            errors.push({field: 'password', message: 'Password is required'});
                                        } else {
                                            if (!passwordRegex.test(password)) {
                                                errors.push({field: 'password', message: 'Password must be at least 8 characters'});
                                            }
                                            if (!/[A-Z]/.test(password)) {
                                                errors.push({field: 'password', message: 'Password must contain at least one capital letter'});
                                            }
                                            if (!/[a-z]/.test(password)) {
                                                errors.push({field: 'password', message: 'Password must contain at least one lowercase letter'});
                                            }
                                            if (!/[0-9]/.test(password)) {
                                                errors.push({field: 'password', message: 'Password must contain at least one number'});
                                            }
                                            if (!/[@!$%^&*()_+\-=\[\]{};:'\",.<>?]/.test(password)) {
                                                errors.push({field: 'password', message: 'Password must contain at least one symbol (except # or `)'});
                                            }
                                        }

                                        // Password confirmation
                                        if (!confirmPassword) {
                                            errors.push({field: 'password_confirmation', message: 'Password confirmation is required'});
                                        } else if (confirmPassword !== password) {
                                            errors.push({field: 'password_confirmation', message: 'Passwords do not match'});
                                        }

                                        return errors;
                                    }

                                    // Validation on keyup and blur
                                    $('input[name="first_name"]').on('keyup blur', function () {
                                        const value = $(this).val();
                                        let errors = [];
                                        if (!value) {
                                            errors.push({field: 'first_name', message: 'First name is required'});
                                        }
                                        displayErrors(errors);
                                    });

                                    $('input[name="last_name"]').on('keyup blur', function () {
                                        const value = $(this).val();
                                        let errors = [];
                                        if (!value) {
                                            errors.push({field: 'last_name', message: 'Last name is required'});
                                        }
                                        displayErrors(errors);
                                    });

                                    $('input[name="id_number"]').on('keyup blur', function () {
                                        const idNumber = $(this).val();
                                        const idRegex = /^[0-9]{0,8}$/;
                                        let errors = [];

                                        if (!idNumber) {
                                            errors.push({field: 'id_number', message: 'ID number is required'});
                                            //} else if (!idRegex.test(idNumber)) {
                                            // errors.push({ field: 'id_number', message: 'ID number must be digits only' });
                                        } else if (idNumber.length < 8 && !/^[0-9]{8}$/.test(idNumber)) {
                                            errors.push({field: 'id_number', message: 'ID number must be more than 8 digits'});
                                        }
                                        displayErrors(errors);
                                    });

                                    $('input[name="email"]').on('keyup blur', function () {
                                        const email = $(this).val();
                                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                        let errors = [];

                                        if (!email) {
                                            errors.push({field: 'email', message: 'Email is required'});
                                        } else if (!emailRegex.test(email)) {
                                            errors.push({field: 'email', message: 'Please enter a valid email address'});
                                        }
                                        displayErrors(errors);
                                    });

                                    $('input[name="phone"]').on('keyup blur', function () {
                                        const phone = $(this).val();
                                        const phoneRegex = /^(01|07)[0-9]{0,8}$/;
                                        let errors = [];

                                        if (!phone) {
                                            errors.push({field: 'phone', message: 'Phone number is required'});
                                        } else if (!phoneRegex.test(phone)) {
                                            errors.push({field: 'phone', message: 'Phone number must start with 01 or 07 and be digits only'});
                                        } else if (phone.length === 10 && !/^(01|07)[0-9]{8}$/.test(phone)) {
                                            errors.push({field: 'phone', message: 'Phone number must be exactly 10 digits'});
                                        }
                                        displayErrors(errors);
                                    });

                                    $('input[name="dob"]').on('keyup blur', function () {
                                        const value = $(this).val();
                                        let errors = [];
                                        if (!value) {
                                            errors.push({field: 'dob', message: 'Date of birth is required'});
                                        }
                                        displayErrors(errors);
                                    });

                                    $('select[name="gender"]').on('change blur', function () {
                                        const value = $(this).val();
                                        let errors = [];
                                        if (!value) {
                                            errors.push({field: 'gender', message: 'Gender is required'});
                                        }
                                        displayErrors(errors);
                                    });

                                    $('input[name="password"]').on('keyup blur', function () {
                                        const password = $(this).val();
                                        const passwordRegex = /^[A-Za-z0-9@!$%^&*()_+\-=\[\]{};:'\",.<>?]{8,}$/;
                                        let errors = [];

                                        if (!password) {
                                            errors.push({field: 'password', message: 'Password is required'});
                                        } else {
                                            if (!passwordRegex.test(password)) {
                                                errors.push({field: 'password', message: 'Password must be at least 8 characters'});
                                            }
                                            if (!/[A-Z]/.test(password)) {
                                                errors.push({field: 'password', message: 'Password must contain at least one capital letter'});
                                            }
                                            if (!/[a-z]/.test(password)) {
                                                errors.push({field: 'password', message: 'Password must contain at least one lowercase letter'});
                                            }
                                            if (!/[0-9]/.test(password)) {
                                                errors.push({field: 'password', message: 'Password must contain at least one number'});
                                            }
                                            if (!/[@!$%^&*()_+\-=\[\]{};:'\",.<>?]/.test(password)) {
                                                errors.push({field: 'password', message: 'Password must contain at least one symbol (except # or `)'});
                                            }
                                        }
                                        displayErrors(errors);
                                    });

                                    $('input[name="password_confirmation"]').on('keyup blur', function () {
                                        const password = $('input[name="password"]').val();
                                        const confirm = $(this).val();
                                        let errors = [];

                                        if (!confirm) {
                                            errors.push({field: 'password_confirmation', message: 'Password confirmation is required'});
                                        } else if (confirm !== password) {
                                            errors.push({field: 'password_confirmation', message: 'Passwords do not match'});
                                        }
                                        displayErrors(errors);
                                    });
                                });
</script>
@endsection