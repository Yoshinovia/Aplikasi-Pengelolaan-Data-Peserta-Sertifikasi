<?php

namespace Tests\Feature;

use App\Models\CertificationScheme;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CertificationSchemeManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_certification_scheme_with_valid_data()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->actingAs($user, 'web');

        $response = $this->post('/schemes', [
            'code' => 'CS-001',
            'name' => 'Skema Sertifikasi Umum',
            'description' => 'Ini adalah skema sertifikasi umum untuk peserta.',
        ]);

        $response->assertSessionHas('success');
        $response->assertRedirect('/schemes');
        $this->assertDatabaseHas('certification_schemes', [
            'code' => 'CS-001',
            'name' => 'Skema Sertifikasi Umum',
            'description' => 'Ini adalah skema sertifikasi umum untuk peserta.',
        ]);
    }

    public function test_user_cannot_create_certification_scheme_with_duplicate_code()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        CertificationScheme::factory()->create([
            'code' => 'CS-001',
            'name' => 'Existing Scheme',
        ]);

        $this->actingAs($user, 'web');

        $response = $this->post('/schemes', [
            'code' => 'CS-001', // Duplicate code
            'name' => 'Skema Sertifikasi Umum',
            'description' => 'Ini adalah skema sertifikasi umum untuk peserta.',
        ]);

        $response->assertSessionHasErrors(['code']);
        $this->assertDatabaseCount('certification_schemes', 1);
    }

    public function test_user_can_edit_certification_scheme_with_valid_data()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $scheme = CertificationScheme::factory()->create([
            'code' => 'CS-001',
            'name' => 'Skema Sertifikasi Umum',
            'description' => 'Deskripsi lama.',
        ]);

        $this->actingAs($user, 'web');

        $response = $this->put('/schemes/' . $scheme->id, [
            'code' => 'CS-001',
            'name' => 'Skema Sertifikasi Umum Diperbarui',
            'description' => 'Deskripsi baru setelah update.',
        ]);

        $response->assertSessionHas('success');
        $response->assertRedirect('/schemes/' . $scheme->id);
        $this->assertDatabaseHas('certification_schemes', [
            'id' => $scheme->id,
            'name' => 'Skema Sertifikasi Umum Diperbarui',
            'description' => 'Deskripsi baru setelah update.',
        ]);
    }

    public function test_user_can_delete_certification_scheme()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $scheme = CertificationScheme::factory()->create([
            'code' => 'CS-001',
            'name' => 'Skema Sertifikasi Umum',
        ]);

        $this->actingAs($user, 'web');

        $response = $this->delete('/schemes/' . $scheme->id);

        $response->assertSessionHas('success');
        $response->assertRedirect('/schemes');
        $this->assertDatabaseMissing('certification_schemes', ['id' => $scheme->id]);
    }

    public function test_user_can_view_certification_scheme_details()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $scheme = CertificationScheme::factory()->create([
            'code' => 'CS-001',
            'name' => 'Skema Sertifikasi Umum',
            'description' => 'Ini adalah deskripsi skema sertifikasi.',
        ]);

        $this->actingAs($user, 'web');

        $response = $this->get('/schemes/' . $scheme->id);

        $response->assertStatus(200);
        $response->assertSee('CS-001');
        $response->assertSee('Skema Sertifikasi Umum');
        $response->assertSee('Ini adalah deskripsi skema sertifikasi.');
    }
}