@component('mail::message')
<h1>New story as added</h1>

<p>
    <strong>Title</strong>: {{ $title }}
</p>

@component('mail::button', ['url' => route('dashboard.index')])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
