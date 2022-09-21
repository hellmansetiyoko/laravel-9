<?php

namespace Tests\Unit;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BiodataTest extends TestCase
{
    use RefreshDatabase;
    public function test_biodata_can_created_for_a_user()
    {
        $biodata = Biodata::factory()->create();
        $this->assertInstanceOf(User::class, $biodata->owner);
    }

    public function test_biodata_is_one_and_only_for_a_user()
    {
        $biodata = Biodata::factory()->make();
        Biodata::firstOrCreate(['user_id' => User::first()->id]);
        Biodata::firstOrCreate(['user_id' => User::first()->id]);
        $this->assertCount(1, Biodata::all());
    }
}
