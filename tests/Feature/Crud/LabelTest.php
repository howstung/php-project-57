<?php

namespace Crud;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public function test_label_crud_index_screen_can_be_rendered(): void
    {
        $response = $this->get(route('label.index'));
        $response->assertStatus(200);
    }


    public function test_label_crud_private_methods_not_can_be_rendered(): void
    {
        $response = $this->get(route('label.create'));
        $response->assertStatus(403);
    }

    public function test_label_crud_private_methods_work(): void
    {
        $user = User::factory()->create();

        //Login
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);


        //Create GET Page
        $response = $this->get(route('label.create'));
        $response->assertStatus(200);

        //Store Label
        $this->post(route('label.store'), [
            'name' => 'Label-test-name',
            'description' => 'Label-test-description',
        ]);

        $response = $this->get(route('label.index'));
        $this->assertTrue(str_contains($response->getContent(), 'Label-test-name'));
        $this->assertTrue(str_contains($response->getContent(), 'Label-test-description'));


        //Edit Exist Label page
        $response = $this->get(route('label.edit', 1));
        $response->assertStatus(200);

        //Edit NotExist Label page
        $response = $this->get(route('label.edit', 2));
        $response->assertStatus(404);

        //Update Label
        $this->patch(route('label.update', 1), [
            'name' => 'Label-test-name-edit',
            'description' => 'Label-test-description-edit',
        ]);

        $response = $this->get(route('label.index'));
        $this->assertTrue(str_contains($response->getContent(), 'Label-test-name-edit'));
        $this->assertTrue(str_contains($response->getContent(), 'Label-test-description-edit'));

        //Destroy Label
        $this->delete(route('label.destroy', 1));
        $response = $this->get(route('label.edit', 1));
        $response->assertStatus(404);
    }
}
