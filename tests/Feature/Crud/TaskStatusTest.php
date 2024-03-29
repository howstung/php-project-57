<?php

namespace Crud;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_status_crud_index_screen_can_be_rendered(): void
    {
        $response = $this->get(route('status.index'));
        $response->assertStatus(200);
    }


    public function test_status_crud_private_methods_not_can_be_rendered(): void
    {
        $response = $this->get(route('status.create'));
        $response->assertStatus(403);
    }

    public function test_status_crud_private_methods_work(): void
    {
        $user = User::factory()->create();

        //Login
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);


        //Create GET Page
        $response = $this->get(route('status.create'));
        $response->assertStatus(200);

        //Store status
        $this->post(route('status.store'), [
            'name' => 'Status-test-name',
            'description' => 'Status-test-description',
        ]);

        $response = $this->get(route('status.index'));
        $this->assertTrue(str_contains($response->getContent(), 'Status-test-name'));


        //Edit Exist Status page
        $response = $this->get(route('status.edit', 5));
        $response->assertStatus(200);

        //Edit NotExist Status page
        $response = $this->get(route('status.edit', 6));
        $response->assertStatus(404);

        //Update Status
        $this->patch(route('status.update', 5), [
            'name' => 'Status-test-name-edit',
            'description' => 'Status-test-description-edit',
        ]);

        $response = $this->get(route('status.index'));
        $this->assertTrue(str_contains($response->getContent(), 'Status-test-name-edit'));

        //Destroy Status
        $this->delete(route('status.destroy', 5));
        $response = $this->get(route('status.edit', 5));
        $response->assertStatus(404);
    }
}
