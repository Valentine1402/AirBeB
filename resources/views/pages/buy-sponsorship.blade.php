@extends('layouts.base')

@section('main')
@if (session('success_message'))
<div class="alert alert-success animated shake">
    {{ session('success_message') }}
</div>
@endif


    <div class="form_container">


<form action="{{ route('checkout', $apartment -> id) }}" id="my-sample-form" method="post">
    @csrf
    @method('POST')

        <div class="title">
            <h3>Acquista sponsorizzazione per: {{ $apartment -> title }}</h3>
            <h3>Card Payment</h3>
        </div>

        @foreach (DB::table('sponsorships') -> get() as $sponsorship)
          @if ($loop->first)
            <div class="form_row sponsor checked">
                <label for="sponsorship{{ $sponsorship -> id }}">{{ $sponsorship -> name }}</label>
                <input type="radio" id="sponsorship{{ $sponsorship -> id }}" name="sponsorship" value="{{ $sponsorship -> id }}" checked>
            </div>
          @else
            <div class="form_row sponsor">
                <label for="sponsorship{{ $sponsorship -> id }}">{{ $sponsorship -> name }}</label>
                <input type="radio" id="sponsorship{{ $sponsorship -> id }}" name="sponsorship" value="{{ $sponsorship -> id }}">
            </div>
          @endif

        @endforeach

        <div class="form_row">
            <div class="input-text" id="card-number"></div>
            <label class="label-input" for="card-number">
              <span class="content-label">Card Number</span>
            </label>
        </div>



            <div class="form_row">
                <div class="input-text" id="cvv"></div>
                <label class="label-input" for="cvv">
                  <span class="content-label">CVV</span>
                </label>
            </div>



            <div class="form_row">
                <div class="input-text" id="expiration-date"></div>
                <label class="label-input" for="expiration-date">
                  <span class="content-label">Expiration Date</span>
                </label>
            </div>







        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <input class="btn sponsor" type="submit" value="Pay" disabled />


</form>
    </div>

<script src="https://js.braintreegateway.com/web/3.57.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.57.0/js/hosted-fields.min.js"></script>
<script src="{{mix('js/sponsorship.js')}}"></script>


@endsection
