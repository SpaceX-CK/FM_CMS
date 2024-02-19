@component('mail::message')
# Contact Form

<p> Hi, you have receive a message from <b><i>{{$request->name}}</i></b>.</p><br>

<p>Please find the details of contact form: </p><br>
<p>Name: {{$request->name}}</p>
<p>Email: {{$request->email}}</p>
<p>Phone Number: {{$request->contact}}</p>
<p>Message: {{$request->enquiry}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
