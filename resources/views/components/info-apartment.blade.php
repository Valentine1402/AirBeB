<p><span>Prezzo : </span> {{$apartment -> price }}$ </p>
<p><span>Indirizzo : </span>{{ \Illuminate\Support\Str::limit($apartment -> address, $limit = 30, $end = '...') }}</p>
<p><span>Numero ospiti : </span> {{$apartment -> guests_number }} Ospiti per notte</p>
<p><span>Numero stanze : </span> {{$apartment -> rooms_number }} Stanze per notte</p>
<p><span>Numero bagni : </span> {{$apartment -> bathrooms }} Bagni per appartamento</p>
<p><span>Metri quadri : </span> {{ $apartment -> area_sm }} Mq. per appartamento</p>
