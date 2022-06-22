<?php

namespace Tests\Unit;

use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class WebsiteApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_request_websites_list()
    {
        $websites = Website::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('api.websites'));

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }

    public function test_can_request_active_websites_only_list()
    {
        $websites = Website::factory()
            ->count(5)
            ->create();

        $website_inactive = Website::factory()
            ->create([
                'active' => 0,
            ]);

        $response = $this->get(route('api.websites'));

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }
}
