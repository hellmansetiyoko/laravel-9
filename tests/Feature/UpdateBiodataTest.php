<?php

namespace Tests\Feature;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UpdateBiodataTest extends TestCase
{
    use RefreshDatabase;
    public function test_biodata_can_updated()
    {
        $response = $this->actingAs($user = User::factory()->create())
            ->patch('/biodata', ['city' => 'new city']);
        $this->assertEquals('new city', Biodata::first()->city);
    }

    public function test_city_is_require()
    {
        $this->validatedInputs('city', ['city' => '']);
        // $response = $this->actingAs($user = User::factory()->create())
        //     ->patch('/biodata', ['city' => ''])
        //     ->assertSessionHasErrors('city');
    }

    public function validatedInputs($field, array $overides)
    {
        $response = $this->actingAs($user = User::factory()->create())
            ->patch('/biodata', $overides)
            ->assertSessionHasErrors($field);
    }
}
