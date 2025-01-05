@component('mail::message')
# Hello {{ $user->name }},

Your admin account has been created. Below are your login credentials:

- **Email:** {{ $user->email }}
- **Password:** {{ $password }}

You can access your dashboard using the link below:

@component('mail::button', ['url' => 'https://' . $domain . '/admin'])
Go to Dashboard
@endcomponent

If you received this email by mistake, please ignore it.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
