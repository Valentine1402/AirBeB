@extends('layouts.base')

@section('style')
<link rel="stylesheet" href="{{ mix('css/address-tomtom.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/app.js') }}" defer></script>
<script type="text/javascript" src="{{ mix('js/checker.js')}}"></script>
@endsection

@section('main')



<div class="form_container">
  <div class="title">
    <h2>Inserisci il tuo appartamento</h2>
  </div>
    <form action="{{ route('apartment-store')}}" method="post" onsubmit="return validation()" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form_row">
            <input class='input-text' type="text" name="title" autocomplete="off" required data-required>
            <label for="title" class="label-input">
                <span class="content-label">Titolo</span>
            </label>
        </div>
        <div class="alert-danger hidden">Dati errati e/o mancanti</div>
        @error('title')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <div class="form_row">
            <input class='input-text' type="text" name="description" autocomplete="off" required data-required>
            <label for="description"  class="label-input">
                <span class="content-label">Descrizione</span>
            </label>
        </div>
        <div class="alert-danger hidden">Dati errati e/o mancanti</div>
        @error('description')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <div class="form_row">
            <input class='input-text' type="text" name="price" autocomplete="off" required data-required>
            <label for="price"  class="label-input">
              <span class="content-label">Prezzo</span>
            </label>
        </div>
        <div class="alert-danger hidden">Dati errati e/o mancanti</div>
        @error('price')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <div class="form_row">
            <input class='input-text' type="text" name="rooms_number" autocomplete="off" required data-required>
            <label for="rooms_number"  class="label-input">
                <span class="content-label">Numero stanze</span>
            </label>
        </div>
        <div class="alert-danger hidden">Dati errati e/o mancanti</div>
        @error('rooms_number')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <div class="form_row">
            <input class='input-text' type="text" name="guests_number" autocomplete="off" required data-required>
            <label for="guests_number"  class="label-input">
                <span class="content-label">Numero ospiti</span>
            </label>
        </div>
        <div class="alert-danger hidden">Dati errati e/o mancanti</div>
        @error('guests_number')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <div class="form_row">
            <input class='input-text' type="text" name="bathrooms" autocomplete="off" required data-required>
            <label for="bathrooms"  class="label-input">
                <span class="content-label">Numero bagni</span>
            </label>
        </div>
        <div class="alert-danger hidden">Dati errati e/o mancanti</div>
        @error('bathrooms')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <div class="form_row">
            <input class='input-text' type="text" name="area_sm" autocomplete="off" required data-required>
            <label for="area_sm"  class="label-input">
                <span class="content-label">Metri quadri</span>
            </label>
        </div>
        <div class="alert-danger hidden">Dati errati e/o mancanti</div>
        @error('area_sm')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        {{-- <div class="form_row">
            <input class='input-text' type="text" id="address" name="address" autocomplete="off" required>
            <label for="address"   class="label-input">
                <span class="content-label">Indirizzo</span>
            </label>
        </div>
        @error('address')
        <div class="alert-danger">{{ $message }}</div>
        @enderror


        <input type="text" id="lat" name="address_lat" value>
        <input type="text" id="lon" name="address_lon" value> --}}

        <tomtomsearch :is-in-edit-mode='true'></tomtomsearch>
        <div class="alert-danger address hidden">Dati errati e/o mancanti</div>

        <div class="form_row container_checkbox">
            @foreach ($services as $service)
            <div class="checkbox">
                <input type="checkbox" name="services[]" value="{{ $service->id }}">
            <label for="services[]">{{ $service->name }}</label>
            </div>
            @endforeach
        </div>

        <div class="form_row container_radio">
            <span class="visibility">Annuncio Pubblico</span>
            <input type="radio" name="visibility" value="1" checked>
            <label for="visibility">Si</label>
            <input type="radio" name="visibility" value="0">
            <label for="visibility">No</label>
        </div>

        <div class="form_row image-input">
            <label for="image">Immagine:</label>
            <input type="file" name="image" data-required>
        </div>
        <div class="alert-danger hidden">Dati errati e/o mancanti</div>
        @error('image')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <div class="form_row">
        <input class='btn' type="submit" value="Invia">
        </div>
    </form>
</div>
@endsection
