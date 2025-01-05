<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Create Client - {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">

   	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/line-awesome/css/line-awesome.min.css">
	<!-- Jquery -->
	{{-- <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css"> --}}
	<!-- Toastr CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css/style.css"/>
</head>

<body class="form-v2">
    @yield('content')

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	<!-- Toastr JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script>
		// just for the demos, avoids form submit
		jQuery.validator.setDefaults({
		  	success:  function(label){
        		label.attr('id', 'valid');
   		 	},
		});
		$( "#myform" ).validate({
		  	rules: {
		    	password: "required",
		    	confirm_password: {
		      		equalTo: "#password"
		    	}
		  	},
		  	messages: {
		  		full_name: {
		  			required: "Please provide an username"
		  		},
		  		your_email: {
		  			required: "Please provide an email"
		  		},
                your_phone: {
		  			required: "Please provide an email"
		  		},
		  		password: {
	  				required: "Please provide a password"
		  		},
		  		confirm_password: {
		  			required: "Please provide a password",
		      		equalTo: "Wrong Password"
		    	}
		  	}
		});
	</script>
    <script>
        function generateSubdomain() {
            const nameInput = document.getElementById('full_name').value;
            const subdomainInput = document.getElementById('subdomain');
            subdomainInput.value = nameInput.toLowerCase().trim().replace(/\s+/g, '-').replace(/[^a-z0-9\-]/g, '');
        }
    </script>
	<script>
	$(document).ready(function () {
		toastr.options = {
			"closeButton": true,
			"progressBar": true,
			"positionClass": "toast-bottom-right",
			"timeOut": "5000",
		};

		@if (session('success'))
			toastr.success("{{ session('success') }}");
		@endif

		@if (session('error'))
			toastr.error("{{ session('error') }}");
		@endif
	});
	</script>
</body>
