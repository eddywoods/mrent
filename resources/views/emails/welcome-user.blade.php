@component('mail::message')
<p>Dear {{ $user->first_name }} {{ $user->last_name }},</p>

<p>Welcome To M-RENT. </p>

My name is Stephen, and just like you, I'm a real estate investor. I'm also Head of Customer Success at M-RENT. I'm here to make managing your rental properties easier, faster, and more rewarding.

You've now joined thousands of users using M-RENT to ditch their spreadsheets and track key performance metrics.

In the coming days, I'll show you how to optimize your account and get the most out of M-RENT.

<p>If this email doesn't make any sense to you please ignore.</p><br>
<p><b>Kind regards,</b></p> <br>
<p><b>M-RENT Customer Experience Team.</b></p>
@endcomponent