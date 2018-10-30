@component('mail::message')
Hej, <br />
På vegne af vores fælles kunde – {{ $customer->name }}, skal vi hermed anmelde følgende skade, til jeres videre behandling:
<p>
    Skadedato: {{ $claim->date }}
</p>
<p>
    Afd.: {{ ($claim->department) ? $claim->department->name : ''}}
</p>
<p>
    Skadested: {{ ($claim->address1)  ? $claim->address1->address : ''}}
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

@component('mail::button', ['url' => route('claim.details', $claim->id)])
    View Claim
@endcomponent

Kontaktperson ved evt. besigtigelse <br />

Såfremt der måtte være spørgsmål til ovenstående, hører vi gerne fra jer. <br />

Venlig hilsend<br />

Kirsten Høll<br />
Mæglerassistent <br />
<br />
Tlf: 9819 4511 • Direkte: 96327412 <br />
Mail: kih@bk-as.dk • www.bk-as.dk

{{ config('app.name') }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
