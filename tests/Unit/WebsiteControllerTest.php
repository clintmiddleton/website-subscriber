<?php

namespace Tests\Unit;

use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class WebsiteControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_view_index_page()
    {
        $websites = Website::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('websites'));

        $response->assertStatus(200);
        $response->assertSee($websites->first()->name);
    }

    public function test_can_view_index_page_without_websites()
    {
        $response = $this->get(route('websites'));

        $response->assertStatus(200);
        $response->assertSee('no websites to display');
    }

    public function test_can_search_index_page()
    {
        $websites = Website::factory()
            ->count(5)
            ->create();

        $website_to_find = Website::factory()
            ->create([
                'name' => $this->faker->text(255),
            ]);

        $response = $this->post(route('websites', [
            'search' => $website_to_find->name,
        ]));

        $response->assertStatus(200);
        $response->assertSee($website_to_find->name);
        $response->assertDontSee($websites->first()->name);
    }

    public function test_can_view_show_page()
    {
        $website = Website::factory()
            ->create();

        $response = $this->get(route('websites.show', ['website' => $website]));

        $response->assertStatus(200);
        $response->assertSee($website->name);
    }

    public function test_can_view_show_page_with_posts()
    {
        $website = Website::factory()
            ->hasPosts(1, [
                'title' => $this->faker->text(255),
            ])
            ->create();

        $response = $this->get(route('websites.show', ['website' => $website]));

        $response->assertStatus(200);
        $response->assertSee($website->posts->first()->title);
    }

    public function test_can_view_show_page_without_posts()
    {
        $website = Website::factory()
            ->create();

        $response = $this->get(route('websites.show', ['website' => $website]));

        $response->assertStatus(200);
        $response->assertSee('no posts to display');
    }

    public function test_cannnot_view_show_page_for_inactive_website()
    {
        $website = Website::factory()
            ->create([
                'active' => 0,
            ]);

        $response = $this->get(route('websites.show', ['website' => $website]));

        $response->assertStatus(403);
    }
}
