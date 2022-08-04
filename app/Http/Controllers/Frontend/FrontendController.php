<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Blog\Blog;
use App\Models\Campaign\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{

    public function homepage()
    {
        $campaign = Campaign::latest()->take(1)->first();
        return view('frontend.customer.form',compact('campaign'));
    }
}
