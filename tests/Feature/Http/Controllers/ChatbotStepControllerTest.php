<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ChatbotStep;
use App\Models\Flow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ChatbotStepController
 */
final class ChatbotStepControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $chatbotSteps = ChatbotStep::factory()->count(3)->create();

        $response = $this->get(route('chatbot-steps.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChatbotStepController::class,
            'store',
            \App\Http\Requests\ChatbotStepStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $flow = Flow::factory()->create();
        $step_order = fake()->numberBetween(-10000, 10000);
        $message_text = fake()->text();
        $step_type = fake()->randomElement(/** enum_attributes **/);
        $expected_response_type = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('chatbot-steps.store'), [
            'flow_id' => $flow->id,
            'step_order' => $step_order,
            'message_text' => $message_text,
            'step_type' => $step_type,
            'expected_response_type' => $expected_response_type,
        ]);

        $chatbotSteps = ChatbotStep::query()
            ->where('flow_id', $flow->id)
            ->where('step_order', $step_order)
            ->where('message_text', $message_text)
            ->where('step_type', $step_type)
            ->where('expected_response_type', $expected_response_type)
            ->get();
        $this->assertCount(1, $chatbotSteps);
        $chatbotStep = $chatbotSteps->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $chatbotStep = ChatbotStep::factory()->create();

        $response = $this->get(route('chatbot-steps.show', $chatbotStep));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChatbotStepController::class,
            'update',
            \App\Http\Requests\ChatbotStepUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $chatbotStep = ChatbotStep::factory()->create();
        $flow = Flow::factory()->create();
        $step_order = fake()->numberBetween(-10000, 10000);
        $message_text = fake()->text();
        $step_type = fake()->randomElement(/** enum_attributes **/);
        $expected_response_type = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('chatbot-steps.update', $chatbotStep), [
            'flow_id' => $flow->id,
            'step_order' => $step_order,
            'message_text' => $message_text,
            'step_type' => $step_type,
            'expected_response_type' => $expected_response_type,
        ]);

        $chatbotStep->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($flow->id, $chatbotStep->flow_id);
        $this->assertEquals($step_order, $chatbotStep->step_order);
        $this->assertEquals($message_text, $chatbotStep->message_text);
        $this->assertEquals($step_type, $chatbotStep->step_type);
        $this->assertEquals($expected_response_type, $chatbotStep->expected_response_type);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $chatbotStep = ChatbotStep::factory()->create();

        $response = $this->delete(route('chatbot-steps.destroy', $chatbotStep));

        $response->assertNoContent();

        $this->assertModelMissing($chatbotStep);
    }
}
