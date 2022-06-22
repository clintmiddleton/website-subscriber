<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostApiControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_create_post()
    {
        $website = Website::factory()
            ->create();
        
        $post = [
            'website_id' => $website->id,
            'title' => $this->faker->text(255),
            'content' => $this->faker->text(5000),
        ];

        $response = $this->post(route('api.posts', $post));

        $response->assertStatus(201);
        $response->assertJsonCount(1);
    }

    public function test_cannot_create_post_with_bad_input()
    {
        $website = Website::factory()
            ->create();
        
        $post = [
            'website_id' => 999,
            'title' => $this->faker->text(255),
            'content' => $this->faker->text(5000),
        ];

        $response = $this->post(route('api.posts', $post));

        $response->assertStatus(400);
    }

    public function test_can_create_post_and_slug_generates()
    {
        $website = Website::factory()
            ->create();
        
        $post = [
            'website_id' => $website->id,
            'title' => $this->faker->text(255),
            'content' => $this->faker->text(5000),
        ];

        $expected_slug = Str::slug($post['title']);

        $response = $this->post(route('api.posts', $post));

        $response->assertStatus(201);
        $response->assertJsonCount(1);
        
        $this->assertDatabaseHas('posts', [
            'slug' => $expected_slug,
        ]);
    }
}
