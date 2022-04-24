<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setBaseRoute('categories');
        $this->setBaseModel('App\Models\Category');
    }

    /** @test */
    public function user_can_create_category()
    {
        $this->signIn();
        $this->followingRedirects();
        $this->create();
    }

    /** @test */
    public function non_logged_user_cannot_create_category()
    {
        $this->create();
    }

    /** @test */
    public function a_category_requires_a_title()
    {
        $this->signIn();
        $this->post(route('categories.store'), [
            'title' => ''
        ])
             ->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function user_can_update_category()
    {
        $this->signIn();
        $this->followingRedirects();
        $this->update([
            'title' => ucfirst($this->faker->words(3, true))
        ]);
    }

    /** @test */
    public function non_logged_user_cannot_update_category()
    {
        $this->update([
            'title' => ucfirst($this->faker->words(3, true))
        ]);
    }

    /** @test */
    public function user_can_delete_category()
    {
        $this->signIn();
        $this->followingRedirects();
        $this->destroy();
    }

    /** @test */
    public function non_logged_user_cannot_delete_category()
    {
        $this->destroy();
    }
}
