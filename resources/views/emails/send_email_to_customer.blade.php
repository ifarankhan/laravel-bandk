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
    Nr./etage/side: {{ ($claim->address1)  ? $claim->address1->address : ''}}
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
    Kontaktperson ved evt. besigtigelse: {{ ($claim->user) ? $claim->user->email : '-' }}, {{ ($claim->user) ? $claim->user->phone_number : '-'  }}
</p>

@if(count($claim->images) > 0)
    <br />
    <br />
    <div class="row">
        @foreach($claim->images as $key => $image)
            <div class="col-md-6">
                <div id="content_{{ $image->id }}">
                    <img src="{{ $image->image }}" style="width:170px;height:120px;" class="img-responsive" />
                </div>

            </div>

        @endforeach
    </div>
@endif


Kontaktperson ved evt. besigtigelse <br />

Såfremt der måtte være spørgsmål til ovenstående, hører vi gerne fra jer. <br />

Venlig hilsen<br />

<br />
{{--Tlf: 9819 4511 • Direkte: 96327412 <br />
Mail: kih@bk-as.dk • www.bk-as.dk<br />--}}

<img src="{{ asset('/admin/images/bnk_logo.jpg') }}" alt="">

Thanks,<br>
{{ config('app.name') }}
@endcomponent
