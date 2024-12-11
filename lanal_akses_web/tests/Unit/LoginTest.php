<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_username()
    {
        // Create dummy user with 'personel' role
        // Buat role 'personel' sebelum test
        Role::create(['name' => 'personel']);
        $user = User::factory()->create([
            'username' => '101313',
            'password' => bcrypt('101313'),
        ]);
        $user->assignRole('personel'); // Assign role to user

        $credentials = [
            'input_type' => '101313', // Username
            'password' => '101313',   // Password
        ];

        $response = $this->post('/login', $credentials);

        $response->assertRedirect(route('personil.dashboard'));
        $this->assertTrue(Auth::check());
        $this->assertTrue(auth()->user()->hasRole('personel'));
    }

    public function test_login_with_invalid_credentials()
    {
        // Dummy user for the test
        $response = $this->post('/login', [
            'input_type' => 'nonexistentuser',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors(['username']);
        $this->assertGuest();
    }

    public function test_login_with_email()
    {
        // Create dummy user with 'personel' role
        Role::create(['name' => 'personel']);
        $user = User::factory()->create([
            'email' => 'rudihartono101313@example.com',
            'password' => bcrypt('101313'),
        ]);
        $user->assignRole('personel');

        $credentials = [
            'input_type' => 'rudihartono101313@example.com',
            'password' => '101313',
        ];

        $response = $this->post('/login', $credentials);

        $response->assertRedirect(route('personil.dashboard'));
        $this->assertTrue(Auth::check());
        $this->assertTrue(auth()->user()->hasRole('personel'));
    }

    public function test_login_with_admin_role()
    {
        Role::create(['name' => 'paset']);
        // Create dummy admin user
        $user = User::factory()->create([
            'username' => '26226/P',
            'password' => bcrypt('26226/P'),
        ]);
        $user->assignRole('paset'); // Admin role

        $credentials = [
            'input_type' => '26226/P',
            'password' => '26226/P',
        ];

        $response = $this->post('/login', $credentials);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertTrue(Auth::check());
        $this->assertTrue(auth()->user()->hasRole('paset'));
    }
}

