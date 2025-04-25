<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ChatbotFlow;
use App\Models\CreatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ChatbotFlowController
 */
final class ChatbotFlowControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $chatbotFlows = ChatbotFlow::factory()->count(3)->create();

        $response = $this->get(route('chatbot-flows.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChatbotFlowController::class,
            'store',
            \App\Http\Requests\ChatbotFlowStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = fake()->name();
        $is_active = fake()->boolean();
        $created_by = CreatedBy::factory()->create();

        $response = $this->post(route('chatbot-flows.store'), [
            'name' => $name,
            'is_active' => $is_active,
            'created_by' => $created_by->id,
        ]);

        $chatbotFlows = ChatbotFlow::query()
            ->where('name', $name)
            ->where('is_active', $is_active)
            ->where('created_by', $created_by->id)
            ->get();
        $this->assertCount(1, $chatbotFlows);
        $chatbotFlow = $chatbotFlows->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $chatbotFlow = ChatbotFlow::factory()->create();

        $response = $this->get(route('chatbot-flows.show', $chatbotFlow));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChatbotFlowController::class,
            'update',
            \App\Http\Requests\ChatbotFlowUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $chatbotFlow = ChatbotFlow::factory()->create();
        $name = fake()->name();
        $is_active = fake()->boolean();
        $created_by = CreatedBy::factory()->create();

        $response = $this->put(route('chatbot-flows.update', $chatbotFlow), [
            'name' => $name,
            'is_active' => $is_active,
            'created_by' => $created_by->id,
        ]);

        $chatbotFlow->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $chatbotFlow->name);
        $this->assertEquals($is_active, $chatbotFlow->is_active);
        $this->assertEquals($created_by->id, $chatbotFlow->created_by);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $chatbotFlow = ChatbotFlow::factory()->create();

        $response = $this->delete(route('chatbot-flows.destroy', $chatbotFlow));

        $response->assertNoContent();

        $this->assertModelMissing($chatbotFlow);
    }
}
