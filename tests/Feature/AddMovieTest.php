<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;
use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddMovieTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function test_user_can_add_movie()
	{
		$user = User::factory()->create();
		$this->actingAs($user);
		$response = $this->post('/api/movies', [
			'title_en'       => 'title',
			'title_ka'       => 'title',
			'director_en'    => 'director',
			'director_ka'    => 'director',
			'description_en' => 'description',
			'description_ka' => 'description',
			'genre'          => 'genre',
			'slug'           => 'slug',
			'thumbnail'      => 'thumbnail',
			'year'           => 3232,
			'user_id'        => 1,
			'budget'         => 32,
		]);

		$movie = \App\Models\Movie::first();
		$response->assertStatus(201);
	}

	public function test_movie_has_many_quotes()
	{
		$user = User::factory()->create();
		$movie = Movie::factory()->create(['user_id' => $user->id]);
		$quote = Quote::factory()->create(['movie_id' => $movie->id]);
		$this->assertTrue($movie->quotes->contains($quote));
	}

	public function test_movie_belongs_to_user()
	{
		$user = User::factory()->create();
		$movie = Movie::factory()->create(['user_id' => $user->id]);
		$this->assertTrue($movie->user->is($user));
	}
}
