<?php

namespace App\Http\Controllers\Messages;

use App\Models\Messages\Pattern;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PatternsController extends Controller
{
//    /**
//     * PatternsController constructor.
//     */
//    public function __construct()
//    {
//        $this->authorizeResource(Pattern::class, 'pattern');
//    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('patterns.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('patterns.create');
    }
}
