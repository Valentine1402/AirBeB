<?php

namespace App\Http\Middleware;
use App\Sponsorship;
use App\Apartment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Closure;

class CheckSponsorship
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(DB::table('apartment_sponsorship') -> count() > 0){
        foreach (DB::table('apartment_sponsorship') -> get() as $value) {
          $apartment = Apartment::findOrFail($value -> apartment_id);
          $sponsorship = Sponsorship::findOrFail($value -> sponsorship_id);
          $date = Carbon::now();
          switch ($sponsorship -> hours) {
            case 24:
              if($date -> diffInHours($value -> creation_date) > 24)
              DB::table('apartment_sponsorship')
                  -> where('id', $value -> id)
                  -> update(['expired' => true]);
              break;

            case 72:
              if($date -> diffInMinutes($value -> creation_date) > 5)
                DB::table('apartment_sponsorship')
                    -> where('id', $value -> id)
                    -> update(['expired' => true]);
                break;

            case 144:
              if($date -> diffInHours($value -> creation_date) > 144)
              DB::table('apartment_sponsorship')
                  -> where('id', $value -> id)
                  -> update(['expired' => true]);
                break;
          }
        }
      }
        return $next($request);
    }
}
