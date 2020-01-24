@component('mail::message')
Hej, <br />
På vegne af vores fælles kunde – {{ (isset($customer->department) && isset($customer->department->company) && isset($customer->department->company->name)) ?  $customer->department->company->name : '' }}, skal vi hermed anmelde følgende skade, til jeres videre behandling:
<p>
    Kundeadministration : {{ $customer->name }}
</p>
<p>
    Skadedato: {{ $claim->date }}
</p>
<p>
    Adresse: {{ ($claim->address1) ? $claim->address1->address : ''}}
</p>
<p>
    Nr./etage/side: {{ ($claim->address_2)  ? $claim->address_2 : ''}}
</p>
<p>
    Skadetype: {{ ($claim->type) ? $claim->type->name : '' }}
</p>
<p>
    Ved rørskader. Bygningens opførsels år er: {{ ($claim->address1)  ? $claim->address1->build_year : ''}}
</p>
<p>
    Beskrivelse: {{ $claim->description }}
</p>
<p>
    Estimat: {{ $claim->estimate }}
</p>
<p>
    Kontaktperson ved evt. besigtigelse: {{ ($claim->user) ? $claim->user->name : '-' }} <br />{{ ($claim->user) ? $claim->user->email : '-' }}, tlf. nr.{{ ($claim->user) ? $claim->user->phone_number : '-'  }}
</p>
<br />
<br />


Såfremt der måtte være spørgsmål til ovenstående, hører vi gerne fra jer. <br />

Venlig hilsen<br />

<br />
{{--Tlf: 9819 4511 • Direkte: 96327412 <br />
Mail: kih@bk-as.dk • www.bk-as.dk<br />--}}

<img src="{{ asset('/admin/images/bnk_logo.jpg') }}" alt="">

{{ config('app.name') }}
@endcomponent
