@extends('layouts.base')

@section('style')
  <link rel="stylesheet" href="{{ mix('css/address-search.css') }}">
@endsection


@section('script')
    <script src="{{ asset('js/app.js') }}" defer></script>

@endsection


@section('search')

    <div class="roma">
    </div>

    <div class="sponsor-title-search">
       <p>Prenota ora</p>
      <h1>
        Scopri le nostre migliori destinazioni
      </h1>
   </div>
    <search></search>
    </div>

@endsection
