<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Features\ConflictChat;
use App\Services\Features\AuraService;
use Livewire\Livewire;
use Tests\TestCase;

class ConflictChatTest extends TestCase
{
    /** @test */
    public function it_renders_successfully()
    {
        Livewire::test(ConflictChat::class)
            ->assertStatus(200);
    }

    /** @test */
    public function sending_a_message_locks_the_input()
    {
        Livewire::test(ConflictChat::class)
            // Initial state: unlocked
            ->assertSet('isLocked', false)
            // Type message
            ->set('newMessage', 'This is a test message')
            // Send
            ->call('sendMessage')
            // Assert message added
            ->assertSee('This is a test message')
            // Assert locked
            ->assertSet('isLocked', true);
    }

    /** @test */
    public function negative_words_decrease_health()
    {
        // Initial health = 50 
        Livewire::test(ConflictChat::class)
            ->set('health', 50)
            ->set('newMessage', 'I hate this stupid test')
            ->call('sendMessage')
            ->assertSet('health', 40); // 50 - 10
    }

    /** @test */
    public function positive_words_increase_health()
    {
        // Initial health = 50
        Livewire::test(ConflictChat::class)
            ->set('health', 50)
            ->set('newMessage', 'I feel sorry and I understand')
            ->call('sendMessage')
            ->assertSet('health', 60); // 50 + 10
    }

    /** @test */
    public function empathy_button_unlocks_simulated_action()
    {
        Livewire::test(ConflictChat::class)
            ->call('unlockChat')
            ->assertSee('You have offered empathy');
    }

    /** @test */
    public function aura_service_integrates_correctly()
    {
        // Mock the service to ensure it's being called
        $this->mock(AuraService::class, function ($mock) {
            $mock->shouldReceive('analyzeConflict')
                ->once()
                ->andReturn('Mocked Aura Advice');
        });

        Livewire::test(ConflictChat::class)
            ->set('newMessage', 'Hello')
            ->call('sendMessage')
            ->assertSet('auraAdvice', 'Mocked Aura Advice')
            ->assertSee('Mocked Aura Advice');
    }
}
