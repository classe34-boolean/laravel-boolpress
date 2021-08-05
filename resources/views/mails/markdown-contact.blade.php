@component('mail::message')
# Nuovo messaggio ricevuto

Ecco i dati della richiesta

**Nome**: {{ $lead->name }}

**Email**: {{ $lead->email }}

**Messaggio**: {{ $lead->message }}

@component('mail::button', ['url' => '#'])
Iscriviti alla newsletter
@endcomponent

Grazie,<br>
{{ config('app.name') }}
@endcomponent
