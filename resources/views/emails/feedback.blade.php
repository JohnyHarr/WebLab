@component('mail::message')
# Feedback Received

Name: {{ $data['Name'] }}

Gender: {{ $data['Gender'] }}

Age: {{ $data['Age'] }}

Birth Date: {{ $data['BirthDate'] }}

Message: {{ $data['Message'] }}

Email: {{ $data['Mail'] }}

Phone Number: {{ $data['PhoneNumber'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
