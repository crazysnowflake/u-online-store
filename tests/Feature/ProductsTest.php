<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setBaseRoute('products');
        $this->setBaseModel('App\Models\Product');
    }

    /** @test */
    public function user_can_create_product()
    {
        $this->signIn();
        $this->followingRedirects();
        $this->create();
    }

    /** @test */
    public function non_logged_user_cannot_create_product()
    {
        $this->create();
    }

    /** @test */
    public function a_product_requires_a_name()
    {
        $this->signIn();
        $this->post(route('products.store'), [
            'name'  => '',
            'slug'  => '',
            'price' => '',
        ])
             ->assertSessionHasErrors(['name', 'slug', 'price']);
    }

    /** @test */
    public function user_can_update_product()
    {
        $this->signIn();
        $this->followingRedirects();
        $this->update([
            'name'        => ucfirst($this->faker->words(3, true)),
            'description' => $this->faker->text()
        ]);
    }

    /** @test */
    public function non_logged_user_cannot_update_product()
    {
        $this->update([
            'name'        => ucfirst($this->faker->words(3, true)),
            'description' => $this->faker->text()
        ]);
    }

    /** @test */
    public function user_can_delete_product()
    {
        $this->signIn();
        $this->followingRedirects();
        $this->destroy();
    }

    /** @test */
    public function non_logged_user_cannot_delete_product()
    {
        $this->destroy();
    }
}
