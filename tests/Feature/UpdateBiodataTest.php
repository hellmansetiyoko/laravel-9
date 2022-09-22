<?php

namespace Tests\Feature;

use App\Models\Biodata;
use Carbon\Carbon;
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
        // $this->withoutExceptionHandling();
        $this->login();
        $this->biodata = Biodata::factory()->create(['user_id' => Auth::id()]);
    }

    public function test_biodata_can_updated()
    {
        $attributes = Biodata::factory()->make([
            'user_id' => Auth::id(),
        ]);
        $response = $this->patch(
            route('biodata.update', ['biodata' => $this->biodata->id]),
            $attributes->toArray()
        );
        $response->assertRedirect(route('biodata'));
    }

    public function test_field_is_require()
    {
        $this->validatedInputs('city_of_birth', ['city_of_birth' => '']);
    }

    public function test_date_is_must_before_now()
    {
        $this->validatedInputs('dob', ['dob' => Carbon::parse('2022-12-30')]);
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
