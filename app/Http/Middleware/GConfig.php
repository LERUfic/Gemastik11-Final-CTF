<?php

namespace App\Http\Middleware;

use Closure;
use App\Game;

class GConfig
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
        $gameflag = Game::select('gvalue')
                    ->where([['gvalue','1'],['config_id','1']])
                    ->first();

        if (!$gameflag) {
            return redirect()->route('error')->with('msg', 'Game Telah Berakhir');
        }

        return $next($request);
    }
}
