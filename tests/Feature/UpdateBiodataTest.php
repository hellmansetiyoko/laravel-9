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
        $response = $this->patch(
            route('biodata.update', ['biodata' => $this->biodata->id]),
            ['city_of_birth' => 'new city']
        );
        $response->assertRedirect(route('biodata'));
    }

    public function test_field_is_require()
    {
        $this->validatedInputs('city_of_birth', ['city_of_birth' => '']);
    }

    public function validatedInputs($field, array $overides)
    {
        $attributes = Biodata::factory()->make(array_merge([
            'user_id' => Auth::id(),
        ], $overides));
        $response = $this->patch(
            route('biodata.update', ['biodata' => $this->biodata->id]),
            $attributes->toArray()
        );
        $response->assertSessionHasErrors($field);
    }
}
