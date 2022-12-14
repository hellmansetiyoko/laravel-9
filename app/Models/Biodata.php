<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nik', 'dob', 'city_of_birth', 'address'];

    protected $casts = [
        'dob' => 'date',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function path()
    {
        return route('biodata.update', ['biodata' => $this->id]);
    }
}
