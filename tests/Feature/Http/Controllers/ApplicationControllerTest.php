<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Application;
use App\Models\JobPosition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ApplicationController
 */
final class ApplicationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $applications = Application::factory()->count(3)->create();

        $response = $this->get(route('applications.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ApplicationController::class,
            'store',
            \App\Http\Requests\ApplicationStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $job_position = JobPosition::factory()->create();
        $applicant_name = fake()->word();
        $applicant_email = fake()->word();
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('applications.store'), [
            'job_position_id' => $job_position->id,
            'applicant_name' => $applicant_name,
            'applicant_email' => $applicant_email,
            'status' => $status,
        ]);

        $applications = Application::query()
            ->where('job_position_id', $job_position->id)
            ->where('applicant_name', $applicant_name)
            ->where('applicant_email', $applicant_email)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $applications);
        $application = $applications->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $application = Application::factory()->create();

        $response = $this->get(route('applications.show', $application));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ApplicationController::class,
            'update',
            \App\Http\Requests\ApplicationUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $application = Application::factory()->create();
        $job_position = JobPosition::factory()->create();
        $applicant_name = fake()->word();
        $applicant_email = fake()->word();
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('applications.update', $application), [
            'job_position_id' => $job_position->id,
            'applicant_name' => $applicant_name,
            'applicant_email' => $applicant_email,
            'status' => $status,
        ]);

        $application->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($job_position->id, $application->job_position_id);
        $this->assertEquals($applicant_name, $application->applicant_name);
        $this->assertEquals($applicant_email, $application->applicant_email);
        $this->assertEquals($status, $application->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $application = Application::factory()->create();

        $response = $this->delete(route('applications.destroy', $application));

        $response->assertNoContent();

        $this->assertModelMissing($application);
    }
}
