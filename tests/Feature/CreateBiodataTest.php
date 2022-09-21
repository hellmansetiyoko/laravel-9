<?php

namespace Tests\Feature;

use App\Models\Biodata;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateBiodataTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_create_biodata()
    {
        $response = $this->get('/biodata')->assertRedirect('/login');
    }

    public function test_auth_user_can_create_biodata()
    {
        $this->login();
        $response = $this->get('/biodata');
        $this->assertEquals(Auth::user()->name, Biodata::first()->owner->name);
    }
}
