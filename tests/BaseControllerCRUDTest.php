<?php

namespace Tests;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BaseControllerCRUDTest extends TestCase
{
    use RefreshDatabase;

    protected static string $modelName = 'demo';
    protected static string $dbName = 'demo';

    protected static Model $model;
    protected static Model $modelNew;
    protected User $user;

    private array $map_routes = [
        'index' => '.index',
        'create' => '.create',
        'store' => '.store',
        'show' => '.show',
        'edit' => '.edit',
        'update' => '.update',
        'destroy' => '.destroy',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        Label::factory(5)->create();
        TaskStatus::factory(5)->create();
        Task::factory(10)->create();
    }

    private function makeRouteString(string $method, mixed $parameters = [])
    {
        return route(static::$modelName . $this->map_routes[$method], $parameters);
    }

    //=========================================

    public function testIndex(): void
    {
        $response = $this->get($this->makeRouteString('index'));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $this->actingAs($this->user);
        $response = $this->get($this->makeRouteString('create'));
        $response->assertOk();
    }

    public function testCreateNotAllowedForGuest(): void
    {
        $response = $this->get($this->makeRouteString('create'));
        $response->assertForbidden();
    }


    public function testEdit(): void
    {
        $this->actingAs($this->user);
        $response = $this->get($this->makeRouteString('edit', static::$model));
        $response->assertOk();
    }

    public function testEditNotAllowedForGuest(): void
    {
        $response = $this->get($this->makeRouteString('edit', static::$model));
        $response->assertForbidden();
    }

    public function testStore(): void
    {
        $this->actingAs($this->user);
        $response = $this->post($this->makeRouteString('store', static::$modelNew->toArray()));
        $this->assertDatabaseHas(static::$dbName, static::$modelNew->toArray());
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function testStoreDuplicate(): void
    {
        $this->actingAs($this->user);
        $response = $this->post($this->makeRouteString('store', static::$model));
        $response->assertSessionHasErrors();
        $response->assertRedirect();
    }
}
