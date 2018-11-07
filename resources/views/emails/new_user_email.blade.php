@component('mail::message')
Hej {{ $user['name'] }}
<br />
Du er nu oprettet som bruger/anmelder af skader på Bækmark & Kvists skadeanmeldelsessystem.
<br />
<br />

Brugernavn: {{ $user['email'] }} <br />
Password: {{ $user['password'] }}

<strong>Brug af App’en til skadeanmeldelse:</strong>

<ol>
    <li>
        Fremsøg App’en i App store for iPhone, eller Play Butik for Android, og download. Søg efter ”B&K skadeanmeldelse”
    </li>
    <li>Åbn App’en</li>
    <li>Følg anvisningerne på skærmen</li>
    <li>Når du har trykket ”Send”, får du på skærmen en bekræftelse på at skaden er anmeldt korrekt.</li>
</ol>

<strong>Anmeld skaden via portalen på internettet.</strong>
<ol>
    <li>tryk <a href="{{ route('dashboard.index') }}">her</a></li>
    <li>Indtast ovennævnte brugernavn og password og tryk Login</li>
    <li>Tast Create/Anmeld for at komme til anmeldelsesformularen</li>
    <li>Udfyld og tryk ”Send”</li>
    <li>Når du har trykke ”Send”, får du en bekræftelse på at skaden er anmeldt korrekt.</li>
</ol>

<strong>På portalen på internettet, kan du også se status på tidligere anmeldte skader</strong>
<ol>
    <li>Klik på ”Skader”</li>
    <li>Fremsøg den ønskede skade, enten via type, dato, afdeling eller via den ansatte som har anmeldt skaden, og tryk ”Opdater”.</li>
    <li>Når skaden er fundet på listen, trykkes der på ”Detaljer”.</li>
</ol>
<p>
    Håber ovenstående har hjulpet dig i gang med brugen af systemet, og hvis ikke, skal du endelig kontakte os for yderligere instruktion.
</p>
Venlig hilsen<br />

Kirsten Høll<br />
Mæglerassistent <br />
<br />
Tlf: 9819 4511 • Direkte: 96327412 <br />
Mail: kih@bk-as.dk • www.bk-as.dk <br />

<img src="{{ asset('/admin/images/bnk_logo.jpg') }}" alt="">

{{ config('app.name') }}
@endcomponent