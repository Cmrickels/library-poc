<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class Books extends TestCase
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
        $response = $this->get('/api/books');

        $response->assertStatus(200);
        $response->assertJson([
            [
                "title" => "Pride and Prejudice",
                "order" => 1
            ],
            [
                "title" => "The Great Gatsby",
                "order" => 2
            ]
        ]);
    }

    /**
     * Removes one by id
     * 
     * @return void
     */
    public function testDeleteOne() 
    {
        $response = $this->delete("/api/books/1");
        $response->assertStatus(200); 
        $this->assertEquals($response->content(), 1); //returns 1 for completed deletion
        
        // check is removed from db
        $booksQuery = $this->get('/api/books');
        $booksQuery->assertJsonMissing([
            "id" => 1,
            "title" => "Pride and Prejudice"
        ]);
    }

    /**
     * Update book order numbers with id order pairs
     */
    public function testUpdateOrder() 
    {
        $mappingPayload = [
            "1" => 4,
            "2" => 3,
            "3" => 1,
            "4" => 2
        ];

        $this->putJson('/api/books/', $mappingPayload)
            ->assertStatus(200)
            ->assertJson([
                [
                    "id" => 1,
                    "order" => 4
                ], 
                [
                    "id" => 2,
                    "order" => 3
                ]
            ]);
    }

    /**
     * Fail to update book orders
     */
    public function testUpdateOrderFail()
    {
        $improperMappingPayload = [
            "not id" => 4,
            "2" => 3,
            "way off" => 1,
            "4" => 2
        ];

        $this->putJson('/api/books/', $improperMappingPayload)
            ->assertStatus(500);
    }

    /**
     * Create book after assigning order
     */
    public function testCreate() 
    {
        $bookPayload = [
            'title' => 'Test Title',
            'author' => 'Test Author',
            'genres_id' => 1,
            'description' => 'Test Description',
            'isbn' => '555-55555-5555-555'
        ];

        $this->postJson('/api/books', $bookPayload)
            ->assertStatus(201)
            ->assertJson([
                'title' => 'Test Title'
            ]);

        $this->get('/api/books')
            ->assertJsonFragment([
                'title' => 'Test Title'
            ]);

    }

    public function testCreateFail()
    {
        $bookPayload = [
            'title' => 'Test Title',
            'author' => 'Test Author',
            'genres_id' => 1,
            'description' => 'Test Description',
            'isbn' => '555-55555-5555-555',
            'EXTRA_FIELD_NOT_SAFE' => '<script>console.log("taken over")'
        ];

        $this->postJson('/api/books', $bookPayload)
            ->assertStatus(500);
    }
}
