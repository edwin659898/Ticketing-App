@component('mail::message')
# Dear {{$ticket->owner->name}}

{{$sender->name}} has reponded to your Ticket: 

{{$ticket->message}}

Response Given: {!! $comment !!}

@component('mail::button', ['url' => route('home')])
 View Ticket
@endcomponent

Please respond to this E-mail for further comments or query to facilitate smooth communication

Thanks,<br>
{{ config('app.name') }}
@endcomponent
