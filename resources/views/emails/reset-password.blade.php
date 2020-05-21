@component('mail::message')
# Password Reset Link 

Here is the link to reset your password

@component('mail::button', [
  'url' => route('reset-passwords.create', [
    'token' => $token, 
    'email' => $email
  ])
])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
