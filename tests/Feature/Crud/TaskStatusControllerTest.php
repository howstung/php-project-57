<?php

namespace Crud;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private TaskStatus $taskStatus;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->taskStatus = TaskStatus::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_status.index'));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $this->actingAs($this->user);
        $response = $this->get(route('task_status.create'));
        $response->assertStatus(200);
    }

    public function testCreateNotAllowedForGuest(): void
    {
        $response = $this->get(route('task_status.create'));
        $response->assertStatus(403);
    }

    public function testStore(): void
    {
        $this->actingAs($this->user);
        $response = $this->post(route('task_status.store'), $this->taskStatus->toArray());
        $this->assertDatabaseHas('task_statuses', $this->taskStatus->toArray());
        $response->assertRedirect();
    }

    public function testStoreNotAllowedForGuest(): void
    {
        $hadBeenCount = TaskStatus::count();
        $response = $this->post(route('task_status.store'), $this->taskStatus->toArray());
        $becameCount = TaskStatus::count();
        $response->assertStatus(403);
        $this->assertEquals($hadBeenCount, $becameCount);
    }

    public function testEdit(): void
    {
        $this->actingAs($this->user);
        $response = $this->get(route('task_status.edit', $this->taskStatus));
        $response->assertStatus(200);
    }

    public function testEditNotAllowedForGuest(): void
    {
        $response = $this->get(route('task_status.edit', $this->taskStatus));
        $response->assertStatus(403);
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->user);
        $data = [
            'name' => 'TaskStatus-TestUpdate-' . rand(),
        ];
        $response = $this->patch(route('task_status.update', $this->taskStatus), $data);
        $response->assertRedirect();
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
        $this->assertDatabaseMissing('task_statuses', ['id' => $this->taskStatus->id]);
    }

    public function testDestroyNotAllowedForGuest(): void
    {
        $this->assertDatabaseHas('task_statuses', ['id' => $this->taskStatus->id]);
        $response = $this->delete(route('task_status.destroy', $this->taskStatus));
        $this->assertDatabaseHas('task_statuses', ['id' => $this->taskStatus->id]);
        $response->assertStatus(403);
    }
}
