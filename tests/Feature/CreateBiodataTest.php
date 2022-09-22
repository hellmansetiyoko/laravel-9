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
        $response = $this->post(route('biodata.store'))
            ->assertRedirect('/login');
    }

    public function test_auth_user_can_create_biodata()
    {
        $this->login();
        $biodata = make(Biodata::class, ['user_id' => Auth::id()])->toArray();
        $response = $this->post(route('biodata.store'), $biodata)
            ->assertCreated();
    }
}
