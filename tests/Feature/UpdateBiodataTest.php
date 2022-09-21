<?php

namespace Tests\Feature;

use App\Models\Biodata;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UpdateBiodataTest extends TestCase
{
    use RefreshDatabase;

    public $biodata;

    public function setUp(): void
    {
        parent::setUp();
        $this->withExceptionHandling();
        $this->login();
        $this->biodata = Biodata::factory()->create(['user_id' => Auth::id()]);
    }

    public function test_biodata_can_updated()
    {
        // $this->login();
        $response = $this->patch($this->biodata->path(), ['city' => 'new city']);
        $this->assertEquals('new city', Biodata::first()->city);
    }

    public function test_field_is_require()
    {
        $this->validatedInputs('city', ['city' => '']);
        $this->validatedInputs('city', ['city' => '']);
    }

    public function validatedInputs($field, array $overides)
    {
        $attributes = Biodata::factory()->make(array_merge([
            'user_id' => Auth::id(),
        ], $overides));
        $response = $this->patch($this->biodata->path(), $attributes->toArray())
            ->assertSessionHasErrors($field);
    }
}
