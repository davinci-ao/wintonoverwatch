<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckEndDate
{
    public function handle($request, Closure $next)
    {
        $events = Event::all();
        foreach($events as $event){
            if ($event && $event->endDate && Carbon::now()->greaterThan($event->endDate)) {
            $event->visible = 0;
            $event->save();
            }
        }
        
        
        return $next($request);
    }
}