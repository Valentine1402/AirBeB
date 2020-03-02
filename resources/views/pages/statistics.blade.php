@extends('layouts.base')


@section('statistics')

    <div class="florida">
    </div>

    <div class="sponsor-title">
       <p class="animated bounceInRight">Sponsorizza</p>
      <h1 class="animated bounceInLeft">
        Scopri quanto vale il tuo appartamento
      </h1>
   </div>
     <div data-apartment="{{ $id }}" class="graphic">
         <div class="statistics">
            <h2>Visualizzazioni</h2>
            <canvas id="myChart" ></canvas>
         </div>
      <div class="statistics">
        <h2>Messaggi</h2>
      <canvas id="myChart-1" ></canvas>
      </div>

    </div>


@endsection




 @section('script')

   <!-- JS: JQUERY -->
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JS: CHART-JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

      <script type="text/javascript" src="{{ mix('js/statistics.js') }}"></script>


    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>

 @endsection
