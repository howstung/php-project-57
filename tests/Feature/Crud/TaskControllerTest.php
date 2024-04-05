<?php

namespace Crud;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BaseControllerCRUDTest;

class TaskControllerTest extends BaseControllerCRUDTest
{
    use RefreshDatabase;

    protected static string $modelName = 'task';
    protected static string $dbName = 'tasks';

    private Task $task;
    private array $newTaskData;


    protected function setUp(): void
    {
        parent::setUp();

        $this->task = Task::factory()->create();
        $this->newTaskData = Task::factory()->make()->only('name', 'description', 'status_id');

        $this::$model = $this->task;

        $taskNew = new Task();
        $taskNew->fill($this->newTaskData);
        $this::$modelNew = $taskNew;
    }

    public function testStoreNotAllowedForGuest(): void
    {
        $hadBeenCount = Task::count();
        $response = $this->post(route('task.store'), $this->newTaskData);
        $becameCount = Task::count();
        $response->assertForbidden();
        $this->assertEquals($hadBeenCount, $becameCount);
        $this->assertDatabaseMissing('tasks', $this->newTaskData);
    }

    public function testShow(): void
    {
        $response = $this->get(route('task.show', $this->task->id));
        $response->assertSee($this->task->name);
        $statusName = $this->task->status instanceof TaskStatus ? $this->task->status->name : "";
        $response->assertSee($statusName);
        $response->assertSee((string)$this->task->description);
    }


    public function testUpdate(): void
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
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function testUpdateNotAllowedForGuest(): void
    {
        $oldTask = $this->task->toArray();
        $data = [
            'name' => 'Task-TestUpdate-' . rand(),
            'description' => 'Description-Task-TestUpdate-Guest-' . rand(),
            'status_id' => TaskStatus::factory()->create()->id,
            'assigned_to_id' => User::factory()->create()->id,
        ];
        $response = $this->patch(route('task.update', $this->task), $data);
        $this->assertDatabaseHas('tasks', $oldTask);
        $response->assertForbidden();
    }

    public function testDestroy(): void
    {
        $creator = User::find($this->task->created_by_id);
        $this->actingAs($creator);
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
        $response = $this->delete(route('task.destroy', $this->task));
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('tasks', ['id' => $this->task->id]);
    }

    public function testDestroyNotAllowedNotCreator(): void
    {
        $userAnother = User::factory()->create();
        $this->actingAs($userAnother);
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
        $response = $this->delete(route('task.destroy', $this->task));
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
    }

    public function testDestroyNotAllowedForGuest(): void
    {
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
        $response = $this->delete(route('task.destroy', $this->task));
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
        $response->assertForbidden();
    }
}
