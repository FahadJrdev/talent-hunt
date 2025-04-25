<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\JobPosition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\JobPositionController
 */
final class JobPositionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $jobPositions = JobPosition::factory()->count(3)->create();

        $response = $this->get(route('job-positions.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JobPositionController::class,
            'store',
            \App\Http\Requests\JobPositionStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $title = fake()->sentence(4);
        $department = fake()->word();
        $description = fake()->text();
        $requirements = fake()->text();
        $responsibilities = fake()->text();
        $location = fake()->word();
        $status = fake()->randomElement(/** enum_attributes **/);
        $created_by = CreatedBy::factory()->create();

        $response = $this->post(route('job-positions.store'), [
            'title' => $title,
            'department' => $department,
            'description' => $description,
            'requirements' => $requirements,
            'responsibilities' => $responsibilities,
            'location' => $location,
            'status' => $status,
            'created_by' => $created_by->id,
        ]);

        $jobPositions = JobPosition::query()
            ->where('title', $title)
            ->where('department', $department)
            ->where('description', $description)
            ->where('requirements', $requirements)
            ->where('responsibilities', $responsibilities)
            ->where('location', $location)
            ->where('status', $status)
            ->where('created_by', $created_by->id)
            ->get();
        $this->assertCount(1, $jobPositions);
        $jobPosition = $jobPositions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $jobPosition = JobPosition::factory()->create();

        $response = $this->get(route('job-positions.show', $jobPosition));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JobPositionController::class,
            'update',
            \App\Http\Requests\JobPositionUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $jobPosition = JobPosition::factory()->create();
        $title = fake()->sentence(4);
        $department = fake()->word();
        $description = fake()->text();
        $requirements = fake()->text();
        $responsibilities = fake()->text();
        $location = fake()->word();
        $status = fake()->randomElement(/** enum_attributes **/);
        $created_by = CreatedBy::factory()->create();

        $response = $this->put(route('job-positions.update', $jobPosition), [
            'title' => $title,
            'department' => $department,
            'description' => $description,
            'requirements' => $requirements,
            'responsibilities' => $responsibilities,
            'location' => $location,
            'status' => $status,
            'created_by' => $created_by->id,
        ]);

        $jobPosition->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $jobPosition->title);
        $this->assertEquals($department, $jobPosition->department);
        $this->assertEquals($description, $jobPosition->description);
        $this->assertEquals($requirements, $jobPosition->requirements);
        $this->assertEquals($responsibilities, $jobPosition->responsibilities);
        $this->assertEquals($location, $jobPosition->location);
        $this->assertEquals($status, $jobPosition->status);
        $this->assertEquals($created_by->id, $jobPosition->created_by);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $jobPosition = JobPosition::factory()->create();

        $response = $this->delete(route('job-positions.destroy', $jobPosition));

        $response->assertNoContent();

        $this->assertModelMissing($jobPosition);
    }
}
