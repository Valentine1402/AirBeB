@extends('layouts.base')

@section('script')
<script type="text/javascript" src="{{ mix('js/sessionAlert.js')}}"></script>
@endsection

@section('main')
  @if (session('success_message_register'))
  <div class="session success-session animated shake">
      <div class="close">X</div>
      {{ session('success_message_register') }}
  </div>
  @endif

  @if (session('apartment_deleted'))
  <div class="session alert-session animated shake">
    <div class="close">X</div>
      {{ session('apartment_deleted') }}
  </div>
  @endif

<div class="house"></div>

<div class="sponsor-title">
       <p class="animated bounceInRight">Appartamenti</p>
      <h1 class="animated bounceInLeft">
        Visualizza i tuoi appartamenti
      </h1>
   </div>
  <div class="previews_container">
    @if (count($apartments) != 0)
      @foreach ($apartments as $apartment)
        <div class="apartment-preview">
          <div class="img_card">
            <img src="{{Storage::url($apartment-> image)}}" alt="">
          </div>
          <div class="text">
            <p>
              <a class="title" href="{{ route('show-apartment', $apartment -> id) }}">{{$apartment -> title }}</a>
            </p>
            <p><span>Descrizione : </span>{{ \Illuminate\Support\Str::limit($apartment -> description, $limit = 30, $end = '...') }}</p>
              @include('components.info-apartment')
          </div>
        </div>
      @endforeach
    @else
      <div class="no-apartments">
        <h1>Non hai ancora appartamenti inseriti</h1>
        <a href="{{ route('apartment-register') }}">Inserisci il tuo primo appartamento!</a>
      </div>
    @endif
  </div>
@endsection
