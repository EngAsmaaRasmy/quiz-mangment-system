@extends('clients::layouts.master')

@section('content')
<div class="page-content">
    <div class="form-v2-content">
        <form class="form-detail" action="{{ route('clients.store')}}" method="post" id="myform">
            @csrf
            <h2>Registration Form</h2>
            <div class="form-row">
                <label for="full-name">Name:</label>
                <input type="text" name="name" id="full_name" class="input-text" placeholder="ex: Lindsey Wilson"  oninput="generateSubdomain()">
            </div>
            <div class="form-row">
                <label for="subdomain">Subdomain:</label>
                <div class="input-group">
                    <input type="text" name="subdomain" id="subdomain" class="form-control" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text">{{ env('CENTRAL_DOMAIN') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <label for="your_email">Email:</label>
                <input type="text" name="email" id="your_email" class="input-text" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
            </div>
            <div class="form-row">
                <label for="your_phone">Phone:</label>
                <input type="text" name="mobile" id="your_phone" class="input-text" required pattern="\+?[0-9]{10,15}" placeholder="ex: +1234567890">
            </div>
            <div class="form-row">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="input-text" required>
            </div>
            <div class="form-row">
                <label for="comfirm-password">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="confirm_password" class="input-text" required>
            </div>
            <div class="form-row-last">
                <input type="submit" name="register" class="register" value="Register">
            </div>
        </form>
    </div>
</div>
@endsection
