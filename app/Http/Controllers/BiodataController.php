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
        $biodata = Biodata::firstOrNew(['user_id' => Auth::id()]);

        return $biodata;
    }

    public function update(Request $request, Biodata $biodata)
    {
        $request->validate([
            'city_of_birth' => 'required',
        ]);
        $biodata->update(request()->all());

        return redirect('/biodata');
    }

    public function store(Request $request)
    {
        $biodata = Biodata::create($request->all());

        return redirect('/biodata', 201);
    }
}
