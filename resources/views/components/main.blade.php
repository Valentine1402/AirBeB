@section('sponsorApt')
 <div class="my_apt_sponsor" id="apartment-sponsorship">
   @if (collect($new_apartments) -> isNotEmpty())
   <div class="sponsor-title">
       <p>Promozioni</p>
      <h1>
        Scopri gli appartamenti in evidenza
      </h1>
   </div>
 @endif
   <div class="sponsorship-apt-list">

    <div class="my_box-apt">
        @if (count($new_apartments) > 0)

            @foreach ($new_apartments as $apartment)
                  <div class="apartment">
                     <h2>{{$apartment-> title}}</h2>
                     <p><span><i class="fas fa-coins"></i></span> {{$apartment -> price }}$ </p>
                     <p><span><i class="fas fa-map-marked-alt"></i></span> {{$apartment -> address }}</p>
                     <div class="image">
                       <img src="{{Storage::url($apartment-> image)}}" alt="">
                       <i class="fab fa-gratipay"></i>
                       <div class="my_btn">
                           <a href="{{route('show-apartment', $apartment -> id) }}" class="m-button">Visualizza</a>
                       </div>
                     </div>
                  </div>
                @endforeach


        @else
          <h2>Al momento non sono presenti sponsorizzazioni attive.</h2>

        @endif
    </div>

   </div>
</div>
@endsection
