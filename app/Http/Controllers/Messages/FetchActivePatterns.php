<?php

namespace App\Http\Controllers\Messages;


use App\Models\Messages\Pattern;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class FetchActivePatterns extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Pattern::query()
            ->where('is_active', true)
            ->paginate();
    }
}
