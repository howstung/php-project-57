<?php

namespace Crud;

use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BaseControllerCRUDTest;

class LabelControllerTest extends BaseControllerCRUDTest
{
    use RefreshDatabase;

    protected static string $modelName = 'label';
    protected static string $dbName = 'labels';


    private mixed $label;
    private mixed $labelNew;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label = Label::factory()->create();
        $this->labelNew = Label::factory()->make();

        $this::$model = $this->label;
        $this::$modelNew = $this->labelNew;
    }

    public function testStoreNotAllowedForGuest(): void
    {
        $hadBeenCount = Label::count();
        $response = $this->post(route('label.store'), $this->labelNew->toArray());
        $becameCount = Label::count();
        $response->assertForbidden();
        $this->assertEquals($hadBeenCount, $becameCount);
        $this->assertDatabaseMissing('labels', $this->labelNew->toArray());
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->user);
        $data = [
            'name' => 'Label-TestUpdate-' . rand(),
            'description' => 'Description-Label-TestUpdate-' . rand(),
        ];
        $response = $this->patch(route('label.update', $this->label), $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testUpdateNotAllowedForGuest(): void
    {
        $oldLabel = $this->label->toArray();
        $data = [
            'name' => 'Label-TestUpdate-Guest-' . rand(),
            'description' => 'Description-Label-TestUpdate-' . rand(),
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
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('labels', ['id' => $this->label->id]);
    }

    public function testDestroyNotAllowedWhenTasksAttached(): void
    {
        $this->actingAs($this->user);
        $label = Label::factory()->hasTasks(1)->create();
        $response = $this->delete(route('label.destroy', $label));
        $this->assertDatabaseHas('labels', ['id' => $label->id]);
        $response->assertRedirect();
    }

    public function testDestroyNotAllowedForGuest(): void
    {
        $this->assertDatabaseHas('labels', ['id' => $this->label->id]);
        $response = $this->delete(route('label.destroy', $this->label));
        $this->assertDatabaseHas('labels', ['id' => $this->label->id]);
        $response->assertStatus(403);
    }
}
