<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>KPFP </title>
        <link rel="icon" href="{{ asset('img/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bd-wizard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <!-- CSS -->
        <link href="https://unpkg.com/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
        <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">





        <!-- JavaScript -->



    </head>

    <body>


        @includeWhen($breadcrumb ?? null, 'partials.breadcrumb')
        @include('partials.header')

        @yield('content')

        @include('partials.footer')

        <script src="{{ asset('js/jquery-1.12.1.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
        <script src="{{ asset('js/swiper.min.js') }}"></script>
        <script src="{{ asset('js/masonry.pkgd.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
        </script>
        <script src="{{ asset('js/slick.min.js') }}"></script>
        <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('js/waypoints.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('js/bd-wizard.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="https://unpkg.com/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-datepicker@5.18.3/dist/datepicker.min.js"></script>


        <script>
$(function () {
    validateForm();
    $('#PS').click(function () {
        $('#personal_statement').css('display', 'block');
    });
    $('#CV').click(function () {
        $('#cv').css('display', 'block');
    });
    $('#CERTS').click(function () {
        $('#certs').css('display', 'block');
    });
    $('#ID').click(function () {
        $('#national_id').css('display', 'block');
    });


    $("#reference__phone_no_from1,#reference__phone_no_to1,#reference__phone_no_from2,#reference__phone_no_to2,#reference__phone_no_from3,#reference__phone_no_to3")
            .datepicker({
                showAnim: "explode",
                dateFormat: "yy-mm-dd", // Preferred date format
                changeMonth: true, // Enable month dropdown
                changeYear: true, // Enable year dropdown
                yearRange: "1920:" + new Date().getFullYear(), // Show years from 1920 to 2016
                defaultDate: new Date(new Date().getFullYear(), 0, 1)

            });




});

$('#SUBMITTAPP').click(function () {
    validateForm();
});




function validateForm() {

    var form = document.getElementById('myForm');
    var inputs = form.querySelectorAll('[required]');

    // Remove existing error styles
    inputs.forEach(function (input) {
        input.classList.remove('error');
        // input.css('border', '1px red')
    });

    // Check for empty required fields
    var isValid = true;
    inputs.forEach(function (input) {
        if (!input.value.trim()) {
            input.classList.add('error');
            isValid = false;
        }
    });

    // Focus on the first empty required field
    if (!isValid) {
        var firstErrorInput = form.querySelector('.error');
        if (firstErrorInput) {
            firstErrorInput.focus();
        }
    }

    return isValid;
}

$("#DOBPickerDisplay").datepicker({
    dateFormat: "dd-mm-yy", // Show to user in this format
    changeMonth: true,
    changeYear: true,
    yearRange: "1920:2016",
    defaultDate: new Date(2006, 0, 1),
    altField: "#DOBPicker", // Hidden field to hold actual value
    altFormat: "yy-mm-dd"           // Format sent to DB
});



$("#TRAINING_DATE").datepicker({
    dateFormat: "dd-mm-yy", // Show to user in this format
    changeMonth: true,
    changeYear: true,
    defaultDate: new Date(),
    minDate: 0

});





$("#DATE_OF_BIRTH").datepicker({
    dateFormat: "yy-mm-dd", // Preferred date format (e.g., 2016-01-01)
    changeMonth: true, // Enable month dropdown
    changeYear: true, // Enable year dropdown
    yearRange: "1920:2007", // Show years from 1920 to 2016
    defaultDate: new Date(2007, 0, 1), // Open calendar at Jan 1, 2016
    maxDate: new Date(2007, 11, 31), // Optional: Restrict to 2016 or earlier
    onSelect: function (dateText) {
        // Calculate age when a date is selected
        var dob = new Date(dateText); // Parse selected date (e.g., "2016-01-01")
        var today = new Date(); // Current date

        // Calculate age
        var age = today.getFullYear() - dob.getFullYear();
        var monthDiff = today.getMonth() - dob.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
            age--; // Adjust if birthday hasn't occurred this year
        }

        // Set the age in the age_years field
        $("#age_years").val(age);
    }
});
        </script>

    </body>

</html>
