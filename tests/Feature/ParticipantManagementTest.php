<?php

namespace Tests\Feature;

use App\Models\CertificationScheme;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParticipantManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Create default certification schemes for all tests
        CertificationScheme::factory()->create(['code' => 'CS-001', 'name' => 'Skema Umum']);
        CertificationScheme::factory()->create(['code' => 'CS-002', 'name' => 'Skema Profesional']);
    }

    public function test_user_can_create_participant_with_valid_data()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->actingAs($user, 'web');

        $response = $this->post('/participants', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
            'certification_scheme_code' => 'CS-001',
        ]);

        $response->assertSessionHas('success');
        $response->assertRedirect('/participants');
        $this->assertDatabaseHas('participants', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
            'certification_scheme_code' => 'CS-001',
        ]);
    }

    public function test_user_cannot_create_participant_with_empty_required_fields()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->actingAs($user, 'web');

        $response = $this->post('/participants', [
            'name' => '',
            'email' => '',
            'phone' => '',
            'certification_scheme_code' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'certification_scheme_code']);
        $this->assertDatabaseMissing('participants', ['name' => '']);
    }

    public function test_user_can_edit_participant_with_valid_data()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $participant = Participant::factory()->create([
            'name' => 'Ahmad Yulianto',
            'email' => 'ahmad@example.com',
            'phone' => '081234567890',
            'certification_scheme_code' => 'CS-001',
        ]);

        $this->actingAs($user, 'web');

        $response = $this->put('/participants/' . $participant->id, [
            'name' => 'Ahmad Yulianto Updated',
            'email' => 'ahmad.updated@example.com',
            'phone' => '081234567890',
            'certification_scheme_code' => 'CS-001',
        ]);

        $response->assertSessionHas('success');
        $response->assertRedirect('/participants/' . $participant->id);
        $this->assertDatabaseHas('participants', [
            'id' => $participant->id,
            'name' => 'Ahmad Yulianto Updated',
            'email' => 'ahmad.updated@example.com',
        ]);
    }

    public function test_user_can_delete_participant_with_confirmation()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $participant = Participant::factory()->create([
            'name' => 'Joko Susilo',
            'email' => 'joko@example.com',
            'phone' => '081234567890',
            'certification_scheme_code' => 'CS-001',
        ]);

        $this->actingAs($user, 'web');

        $response = $this->delete('/participants/' . $participant->id);

        $response->assertSessionHas('success');
        $response->assertRedirect('/participants');
        $this->assertDatabaseMissing('participants', ['id' => $participant->id]);
    }

    public function test_user_can_search_participants()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Participant::factory()->create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
            'certification_scheme_code' => 'CS-001',
        ]);

        Participant::factory()->create([
            'name' => 'Ahmad Yulianto',
            'email' => 'ahmad@example.com',
            'phone' => '081234567890',
            'certification_scheme_code' => 'CS-002',
        ]);

        $this->actingAs($user, 'web');

        $response = $this->get('/participants?search=Budi');

        $response->assertStatus(200);
        $response->assertSee('Budi Santoso');
        $response->assertDontSee('Ahmad Yulianto');
    }
}