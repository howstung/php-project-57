<?php

namespace Crud;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->task = Task::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task.index'));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $this->actingAs($this->user);
        $response = $this->get(route('task.create'));
        $response->assertStatus(200);
    }

    public function testCreateNotAllowedForGuest(): void
    {
        $response = $this->get(route('task.create'));
        $response->assertStatus(403);
    }

    public function testStore()
    {
        $this->actingAs($this->user);
        $response = $this->post(route('task.store'), $this->task->toArray());
        $this->assertDatabaseHas('tasks', $this->task->toArray());
        $response->assertRedirect();
    }

    public function testStoreNotAllowedForGuest()
    {
        $hadBeenCount = Task::count();
        $response = $this->post(route('task.store'), $this->task->toArray());
        $becameCount = Task::count();
        $response->assertStatus(403);
        $this->assertEquals($hadBeenCount, $becameCount);
    }

    public function testEdit()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('task.edit', $this->task));
        $response->assertStatus(200);
    }

    public function testEditNotAllowedForGuest()
    {
        $response = $this->get(route('task.edit', $this->task));
        $response->assertStatus(403);
    }

    public function testUpdate()
    {
        $this->actingAs($this->user);
        $data = [
            'name' => 'Task-TestUpdate-' . rand(),
            'description' => 'Description-Task-TestUpdate-' . rand(),
            'status_id' => TaskStatus::factory()->create()->id,
            'assigned_to_id' => User::factory()->create()->id,
        ];
        $response = $this->patch(route('task.update', $this->task), $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function testUpdateNotAllowedForGuest()
    {
        $oldTask = $this->task->toArray();
        $data = [
            'name' => 'Task-TestUpdate-' . rand(),
            'description' => 'Description-Task-TestUpdate-' . rand(),
            'status_id' => TaskStatus::factory()->create()->id,
            'assigned_to_id' => User::factory()->create()->id,
        ];
        $response = $this->patch(route('task.update', $this->task), $data);
        $this->assertDatabaseHas('tasks', $oldTask);
        $response->assertStatus(403);
    }

    public function testDestroy()
    {
        $creator = User::find($this->task->created_by_id);
        $this->actingAs($creator);
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
        $response = $this->delete(route('task.destroy', $this->task));
        $response->assertRedirect();
        $this->assertDatabaseMissing('tasks', ['id' => $this->task->id]);
    }

    public function testDestroyNotAllowedNotCreator()
    {
        $this->actingAs($this->user);
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
        $response = $this->delete(route('task.destroy', $this->task));
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
    }

    public function testDestroyNotAllowedForGuest()
    {
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
        $response = $this->delete(route('task.destroy', $this->task));
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
        $response->assertStatus(403);
    }
}