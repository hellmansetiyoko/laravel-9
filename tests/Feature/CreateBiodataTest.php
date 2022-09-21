<?php

namespace Tests\Feature;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $response = $this->actingAs($user = User::factory()->create())
            ->get('/biodata');
        $this->assertEquals($user->name, Biodata::first()->owner->name);
    }
}
