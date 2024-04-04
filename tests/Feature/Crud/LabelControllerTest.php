<?php

namespace Crud;

use App\Models\Label;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->label = Label::factory()->create();
        $this->task = Task::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('label.index'));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $this->actingAs($this->user);
        $response = $this->get(route('label.create'));
        $response->assertStatus(200);
    }

    public function testCreateNotAllowedForGuest(): void
    {
        $response = $this->get(route('label.create'));
        $response->assertStatus(403);
    }

    public function testStore(): void
    {
        $this->actingAs($this->user);
        $response = $this->post(route('label.store'), $this->label->toArray());
        $this->assertDatabaseHas('labels', $this->label->toArray());
        $response->assertRedirect();
    }

    public function testStoreNotAllowedForGuest(): void
    {
        $hadBeenCount = Label::count();
        $response = $this->post(route('label.store'), $this->label->toArray());
        $becameCount = Label::count();
        $response->assertStatus(403);
        $this->assertEquals($hadBeenCount, $becameCount);
    }

    public function testEdit(): void
    {
        $this->actingAs($this->user);
        $response = $this->get(route('label.edit', $this->label));
        $response->assertStatus(200);
    }

    public function testEditNotAllowedForGuest(): void
    {
        $response = $this->get(route('label.edit', $this->label));
        $response->assertStatus(403);
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->user);
        $data = [
            'name' => 'Label-TestUpdate-' . rand(),
            'description' => 'Description-Label-TestUpdate-' . rand()
        ];
        $response = $this->patch(route('label.update', $this->label), $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testUpdateNotAllowedForGuest(): void
    {
        $oldLabel = $this->label->toArray();
        $data = [
            'name' => 'Label-TestUpdate-Guest-' . rand(),
            'description' => 'Description-Label-TestUpdate-' . rand()
        ];
        $response = $this->patch(route('label.update', $this->label), $data);
        $this->assertDatabaseHas('labels', $oldLabel);
        $response->assertStatus(403);
    }

    public function testDestroy(): void
    {
        $this->actingAs($this->user);
        $this->assertDatabaseHas('labels', ['id' => $this->label->id]);
        $response = $this->delete(route('label.destroy', $this->label));
        $response->assertRedirect();
        $this->assertDatabaseMissing('labels', ['id' => $this->label->id]);
    }

    public function testDestroyNotAllowedForGuest(): void
    {
        $this->assertDatabaseHas('labels', ['id' => $this->label->id]);
        $response = $this->delete(route('label.destroy', $this->label));
        $this->assertDatabaseHas('labels', ['id' => $this->label->id]);
        $response->assertStatus(403);
    }
}
