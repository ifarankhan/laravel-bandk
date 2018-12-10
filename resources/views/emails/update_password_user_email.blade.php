@component('mail::message')
Hej {{ $user['name'] }}
<br />
Hermed dit nye password {{ $user['password'] }}.
<br />
Såfremt der måtte være spørgsmål til ovenstående, hører vi gerne fra jer.
<br />
Venlig hilsen<br />


<img src="{{ asset('/admin/images/bnk_logo.jpg') }}" alt="">

{{ config('app.name') }}
@endcomponent