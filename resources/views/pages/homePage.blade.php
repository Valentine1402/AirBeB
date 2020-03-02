@extends('layouts.base')

@section('script')
<script type="text/javascript" src="{{ mix('js/sessionAlert.js')}}"></script>
@endsection

@section('head')

  @if (session('avatar_updated'))
  <div class="session success-session animated shake">
    <div class="close">X</div>
      {{ session('avatar_updated') }}
  </div>
  @endif
  <div class="head-img-home">
    <div class="box-home-page">
      <div>
        <h1>Trova l'appartamento che desideri</h1>
      </div>
      <div>
        <ul>
          <li><p>Cerca tra centinaia di appartamenti in pochi secondi</p></li>
          <li><p>Confronta più di 1.000.000 appartamenti nel mondo</p></li>
          <li><p>Milioni di recensioni certificate</p></li>
          <li><p>Risparmia fino al 35%</p></li>
        </ul>
      </div>
     <div class="homeBtn">
      <a href="{{ route('search') }}">Cerca ora</a>
     </div>
    </div>
    <div id="box-arrows">
      <a href="#apartment-sponsorship">
        <span class="arrow"></span>
        <span class="arrow"></span>
        <span class="arrow"></span>
      </a>

    </div>
  </div>
@endsection

@section('sponsorApt')
   @include('components.main')
@endsection
