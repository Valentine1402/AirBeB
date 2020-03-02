@extends('layouts.base')

@section('script')
{{-- tom tom api --}}
<link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.37.2/maps/maps.css' />
<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.37.2/maps/maps-web.min.js'></script>
<script type="text/javascript" src="{{ mix('js/sessionAlert.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>

@endsection


@section('main')

    @if (session('already_exist'))
    <div class="session alert-session animated shake">
      <div class="close">X</div>
        {{ session('already_exist') }}
    </div>
    @endif

    @if (session('success_message'))
    <div class="session success-session animated shake">
        <div class="close">X</div>
        {{ session('success_message') }}
    </div>
    @endif

    @if (session('message_sent'))
    <div class="session success-session animated shake">
      <div class="close">X</div>
      {{ session('message_sent') }}
    </div>
    @endif

    @if (session('success_message_update'))
    <div class="session success-session animated shake">
        <div class="close">X</div>
        {{ session('success_message_update') }}
    </div>
    @endif

<div class="holland">
</div>

<div class="show-container">
    <h1>{{ $apartment -> title }}</h1>
    <div class="row">
        <div class="image">
            <img src="{{Storage::url($apartment-> image)}}" alt="">
        </div>

        <div class="item description">
            <h4>Descrizione appartamento:</h4>
            <p>{{ $apartment -> description }}</p>
            <br>
            <h4>Servizi Inclusi</h4>
            <ul>
                @foreach ($apartment -> services as $service)
                <li>{{ $service -> name }}</li>
                @endforeach
            </ul>
        </div>

    </div>
    <div class="row">
        <div class="item info">
            <h1>Informazioni appartamento</h1>
            @include('components.info-apartment')
            <p><span>Coordinate GPS : </span> lon {{ $apartment -> address_lon }} lat {{ $apartment -> address_lat }}</p>
        </div>
        <div class="item services">
            <h1>Indicazioni stradali</h1>
            <tomtommap name="{{ $apartment -> title }}" address="{{ $apartment -> address }}" class="tomTom" :lat="{{ $apartment -> address_lat }}" :lon="{{ $apartment -> address_lon }}"></tomtommap>
        </div>
    </div>
    <div class="row">

        @if(Auth::id() == $apartment -> user -> id)
        <div class="item manage-apartment">
            <h1>Gestisci il tuo appartamento</h1>
            <ul>
              <li><a href="{{ route('edit-apartment', $apartment->id) }}" class='btn'>Modifica informazioni</a></li>
              <li><a href="{{ route('buy-sponsorship', $apartment->id) }}" class='btn'>Acquista Sponsorizzazione</a></li>
              <li><a href="{{ route('apartment-messages', $apartment->id) }}" class='btn'>Leggi Messaggi</a></li>
              <li><button id="delete-btn" class='btn'>Elimina appartamento</button></li>
              <li><a href="{{ route('statistics', $apartment->id) }}" class='btn'>Visualizza statistiche</a></li>
            </ul>
        </div>
        @else
        <div class="owner-msg">
            <div class="msg">
                <div class="msg-body">
                  <form action="{{ route('store-message', $apartment->id) }}" method="post">
                    @csrf
                    @method('POST')
                    <h2>Scrivi al proprietario</h2>
                    <textarea name="content" minlength="10" required id="message"></textarea>
                    <input type="email" name="mail" required class="email" @auth value="{{ Auth::user() -> email}}" @else placeholder="Scrivi la tua mail per essere ricontattato" @endauth>
                    <input type="submit" value="Invia" class="send btn">
                  </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="modal delete-modal animated fadeInUpBig faster">
  <div class="container">
    <div class="content">
      <p>Vuoi procedere con la cancellazione?</p>
      <button id="annulla-delete" class='btn'>Annulla</button>
      <a href="{{ route('delete-apartment', $apartment->id) }}" class='btn'>Elimina</a>
    </div>
  </div>
</div>
@endsection
