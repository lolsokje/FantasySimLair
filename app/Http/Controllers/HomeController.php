<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    public function index(): Renderable
    {
        $championships = Championship::orderBy('name')->get();
        return view('index', [
            'championships' => $championships
        ]);
    }
}