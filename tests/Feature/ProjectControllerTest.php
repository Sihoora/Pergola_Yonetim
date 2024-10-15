<?php

use Tests\TestCase;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Http\Controllers\ProjectController;
use Carbon\Carbon;



class ProjectControllerTest extends TestCase
{

    public function testStoreValidData()
    {
        // Create a user to be the creator of the project
        $user = User::factory()->create();

        // Create a request with valid data
        $request = Request::create('/store', 'POST', [
            'created_by' => $user->id,
            'proje_adi' => 'Test Project',
            'musteri' => 'Test Customer',
            'teslim_tarihi' => '01/01/2023',
        ]);

        // Instantiate the controller
        $controller = new ProjectController();

        // Call the store method
        $response = $controller->store($request);

        // Assert that the project was created
        $this->assertDatabaseHas('projects', [
            'created_by' => $user->id,
            'proje_adi' => 'Test Project',
            'musteri' => 'Test Customer',
            'teslim_tarihi' => '2023-01-01',
        ]);

        // Assert that the response is a redirect to the edit route
        $response->assertRedirect(route('proje.edit', Project::first()->id));
    }

    public function testStoreInvalidDateFormat()
    {
        // Create a user to be the creator of the project
        $user = User::factory()->create();

        // Create a request with an invalid date format
        $request = Request::create('/store', 'POST', [
            'created_by' => $user->id,
            'proje_adi' => 'Test Project',
            'musteri' => 'Test Customer',
            'teslim_tarihi' => '2023-01-01', // Invalid format
        ]);

        // Instantiate the controller
        $controller = new ProjectController();

        // Call the store method
        $response = $controller->store($request);

        // Assert that the project was not created
        $this->assertDatabaseMissing('proje_ekle', [
            'proje_adi' => 'Test Project',
        ]);

        // Assert that the response contains validation errors
        $response->assertSessionHasErrors(['teslim_tarihi']);
    }

    public function testStoreMissingRequiredFields()
    {
        // Create a request with missing required fields
        $request = Request::create('/store', 'POST', [
            'proje_adi' => 'Test Project',
        ]);

        // Instantiate the controller
        $controller = new ProjectController();

        // Call the store method
        $response = $controller->store($request);

        // Assert that the project was not created
        $this->assertDatabaseMissing('proje_ekle', [
            'proje_adi' => 'Test Project',
        ]);

        // Assert that the response contains validation errors
        $response->assertSessionHasErrors(['created_by', 'musteri', 'teslim_tarihi']);
    }
}