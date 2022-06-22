<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class SubscriptionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_subscribe_to_website()
    {
        $website = Website::factory()
            ->create();

        $email = $this->faker->email();

        $response = $this->post(route('websites.subscribe', [
            'website' => $website,
            'email' => $email,
        ]));

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('subscriptions', [
            'email' => $email,
        ]);
    }

    public function test_cannot_subscribe_to_website_with_bad_email()
    {
        $website = Website::factory()
            ->create();

        $email = 'test';

        $response = $this->post(route('websites.subscribe', [
            'website' => $website,
            'email' => $email,
        ]));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('subscriptions', [
            'email' => $email,
        ]);
    }
}
