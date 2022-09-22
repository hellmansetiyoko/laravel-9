<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBiodataRequest;
use App\Models\Biodata;
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

    public function update(StoreBiodataRequest $request, Biodata $biodata)
    {
        $biodata->update(request()->all());

        return redirect('/biodata');
    }

    public function store(StoreBiodataRequest $request)
    {
        $biodata = Biodata::create($request->all());

        return redirect(route('biodata'));
    }
}
