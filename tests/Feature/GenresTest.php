<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenresTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    /**
     * Index returns all books, test for give two
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/api/genres')
            ->assertStatus(200)
            ->assertJson([
                [
                    'name' =>'fiction',
                    'label' => 'Fiction'
                ],
                [
                    'name' =>'nonfiction',
                    'label' => 'Non-Fiction'
                ]
            ]);
    }

    /**
     * Get books by genre_id
     */
    public function testGetBooksByGenre()
    {
        $this->get('/api/genres/1/books')
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'Pride and Prejudice'
            ]);
    }

    /**
     * Get books. Forget genre id
     */
    public function testGetBooksByGenreFail()
    {
        $this->get('/api/genres/somethingthatsnotanid/books')
            ->assertStatus(500);
    }
}
