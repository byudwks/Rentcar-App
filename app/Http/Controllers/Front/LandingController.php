<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class LandingController extends Controller
{
    public function index() {

        $items = Item::with(['type', 'brand'])->latest()->take(4)->get()->reverse();

        return view('landing', [
            'items' => $items
        ]);
    }
}
