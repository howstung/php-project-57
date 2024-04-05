<?php

namespace Crud;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BaseControllerCRUDTest;

class TaskStatusControllerTest extends BaseControllerCRUDTest
{
    use RefreshDatabase;

    protected static string $modelName = 'task_status';
    protected static string $dbName = 'task_statuses';

    private TaskStatus $taskStatus;
    private TaskStatus $taskStatusNew;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskStatus = TaskStatus::factory()->create();
        $this->taskStatusNew = TaskStatus::factory()->make();

        $this::$model = $this->taskStatus;
        $this::$modelNew = $this->taskStatusNew;
    }


    public function testStoreNotAllowedForGuest(): void
    {
        $hadBeenCount = TaskStatus::count();
        $response = $this->post(route('task_status.store'), $this->taskStatusNew->toArray());
        $becameCount = TaskStatus::count();
        $response->assertForbidden();
        $this->assertEquals($hadBeenCount, $becameCount);
        $this->assertDatabaseMissing('task_statuses', $this->taskStatusNew->toArray());
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->user);
        $data = [
            'name' => 'TaskStatus-TestUpdate-' . rand(),
        ];
        $response = $this->patch(route('task_status.update', $this->taskStatus), $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testUpdateNotAllowedForGuest(): void
    {
        $oldTaskStatus = $this->taskStatus->toArray();
        $data = [
            'name' => 'TaskStatus-TestUpdate-Guest-' . rand(),
        ];
        $response = $this->patch(route('task_status.update', $this->taskStatus), $data);
        $this->assertDatabaseHas('task_statuses', $oldTaskStatus);
        $response->assertStatus(403);
    }

    public function testDestroy(): void
    {
        $this->actingAs($this->user);
        $this->assertDatabaseHas('task_statuses', ['id' => $this->taskStatus->id]);
        $response = $this->delete(route('task_status.destroy', $this->taskStatus));
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('task_statuses', ['id' => $this->taskStatus->id]);
    }

    public function testDestroyNotAllowedWhenTasksAttached(): void
    {
        $this->actingAs($this->user);
        $taskStatus = TaskStatus::factory()->hasTasks(1)->create();
        $response = $this->delete(route('task_status.destroy', $taskStatus));
        $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->id]);
        $response->assertRedirect();
    }

    public function testDestroyNotAllowedForGuest(): void
    {
        $this->assertDatabaseHas('task_statuses', ['id' => $this->taskStatus->id]);
        $response = $this->delete(route('task_status.destroy', $this->taskStatus));
        $this->assertDatabaseHas('task_statuses', ['id' => $this->taskStatus->id]);
        $response->assertStatus(403);
    }
}
