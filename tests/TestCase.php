<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected $base_route = null;
    protected $base_model = null;


    protected function signIn($user = null)
    {
        $user = $user ?? User::factory()->create();
        $this->actingAs($user);
        return $this;
    }

    protected function setBaseRoute($route)
    {
        $this->base_route = $route;
    }

    protected function setBaseModel($model)
    {
        $this->base_model = $model;
    }

    protected function getModel($model = null){
        $model = $model ?? $this->base_model;
        return new $model;
    }

    protected function create($attributes = [], $model = null, $route = null)
    {
        $this->withoutExceptionHandling();

        if (! auth()->user()) {
            $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        }
        $route = $route ?? "{$this->base_route}.store";
        $model = $this->getModel($model);

        $attributes = $model::factory()->raw($attributes);

        $response = $this->post(route($route), $attributes)->assertSuccessful();

        $this->assertDatabaseHas($model->getTable(), $attributes);

        return $response;
    }

    protected function update($attributes = [], $model = null, $route = null)
    {
        $this->withoutExceptionHandling();

        $route = $route ?? "{$this->base_route}.update";
        $model = $this->getModel($model);

        $model = $model::factory()->create($attributes);

        if (! auth()->user()) {
            $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        }

        $response = $this->put(route($route, $model->id), $model->toArray());

        tap($model->fresh(), function ($model) use ($attributes) {
            collect($attributes)->each(function($value, $key) use ($model) {
                $this->assertEquals($value, $model[$key]);
            });
        });

        return $response;
    }

    protected function destroy($model = null, $route = null)
    {
        $this->withoutExceptionHandling();

        $route = $route ?? "{$this->base_route}.destroy";
        $model = $this->getModel($model);

        $model = $model::factory()->create();

        if (! auth()->user()) {
            $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        }

        $response = $this->delete(route($route, $model->id));

        $this->assertDatabaseMissing($model->getTable(), $model->toArray());

        return $response;
    }
}
