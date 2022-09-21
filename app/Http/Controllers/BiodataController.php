<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Request $request)
    {
        $biodata = Biodata::firstOrCreate(['user_id' => Auth::id()]);
        if ($request->isMethod('patch')) {
            $request->validate([
                'city' => 'required',
            ]);
            $biodata->update(request()->all());
        }
    }
}
