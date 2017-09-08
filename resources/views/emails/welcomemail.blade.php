@component('mail::message')
# Hi {{ $user->name }}, Welcome  to ShareInspire


@component('mail::panel')
ShareInspire provides a platform for people from all over the world, to come together and inspire each other. By signing up, you have become a part of this inspiring community.
@endcomponent

@component('mail::button', ['url' => config('app.url')])
Visit Website
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
