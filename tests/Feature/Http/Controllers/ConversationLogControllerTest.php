<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ConversationLog;
use App\Models\Step;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ConversationLogController
 */
final class ConversationLogControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $conversationLogs = ConversationLog::factory()->count(3)->create();

        $response = $this->get(route('conversation-logs.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ConversationLogController::class,
            'store',
            \App\Http\Requests\ConversationLogStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $step = Step::factory()->create();
        $file_uploaded = fake()->boolean();
        $session_id = fake()->word();

        $response = $this->post(route('conversation-logs.store'), [
            'step_id' => $step->id,
            'file_uploaded' => $file_uploaded,
            'session_id' => $session_id,
        ]);

        $conversationLogs = ConversationLog::query()
            ->where('step_id', $step->id)
            ->where('file_uploaded', $file_uploaded)
            ->where('session_id', $session_id)
            ->get();
        $this->assertCount(1, $conversationLogs);
        $conversationLog = $conversationLogs->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $conversationLog = ConversationLog::factory()->create();

        $response = $this->get(route('conversation-logs.show', $conversationLog));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ConversationLogController::class,
            'update',
            \App\Http\Requests\ConversationLogUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $conversationLog = ConversationLog::factory()->create();
        $step = Step::factory()->create();
        $file_uploaded = fake()->boolean();
        $session_id = fake()->word();

        $response = $this->put(route('conversation-logs.update', $conversationLog), [
            'step_id' => $step->id,
            'file_uploaded' => $file_uploaded,
            'session_id' => $session_id,
        ]);

        $conversationLog->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($step->id, $conversationLog->step_id);
        $this->assertEquals($file_uploaded, $conversationLog->file_uploaded);
        $this->assertEquals($session_id, $conversationLog->session_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $conversationLog = ConversationLog::factory()->create();

        $response = $this->delete(route('conversation-logs.destroy', $conversationLog));

        $response->assertNoContent();

        $this->assertModelMissing($conversationLog);
    }
}
