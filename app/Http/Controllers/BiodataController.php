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

    public function index()
    {
        $biodata = Biodata::firstOrCreate(['user_id' => Auth::id()]);
    }

    public function update(Request $request, Biodata $biodata)
    {
        $request->validate([
            'city_of_birth' => 'required',
        ]);
        $biodata->update(request()->all());
    }
}
