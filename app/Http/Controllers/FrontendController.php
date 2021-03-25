<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Brand;
use App\Models\State;
use App\Models\Media;
use App\Models\Dealer;
use App\Models\HomeVideo;
use Illuminate\Http\Request;
use App\Models\TransformerVideo;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
	public function index() {


		return view('frontend.index', []);
	}
}
