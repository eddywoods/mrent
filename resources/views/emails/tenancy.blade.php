@component('mail::message')
<p>Dear {{ $user->first_name }} {{ $user->last_name }},</p>

<p>Welcome To M-RENT. </p>

Find Attached a document of a lease agreement.

<p>If this email doesn't make any sense to you please ignore.</p><br>
<p><b>Kind regards,</b></p> <br>
<p><b>M-RENT Customer Experience Team.</b></p>
@endcomponent