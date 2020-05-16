@component('mail::message')
# Done

Your password has been changed!

@component('mail::button', ['url' => 'http://127.0.0.1:8000/password/reset'])
Forget Password Link
@endcomponent

Thanks,<br>
MD Khalid Hosain
@endcomponent
