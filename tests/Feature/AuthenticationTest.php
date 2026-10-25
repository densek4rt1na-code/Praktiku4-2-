<?php

namespace Tests\Feature;

use App\Models\Kapal;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Masuk Sistem');
        $response->assertSee('Alamat Email');
        $response->assertSee('Kata Sandi');
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Daftar Akun Baru');
        $response->assertSee('Nama Lengkap');
        $response->assertSee('Konfirmasi Kata Sandi');
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::create([
            'name' => 'Petugas Pelabuhan',
            'email' => 'petugas@smartmeritim.id',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'petugas@smartmeritim.id',
            'password' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard'));
    }

    public function test_users_cannot_authenticate_with_invalid_password(): void
    {
        User::create([
            'name' => 'Petugas Pelabuhan',
            'email' => 'petugas@smartmeritim.id',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'petugas@smartmeritim.id',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
    }

    public function test_login_validation_requires_email_and_password(): void
    {
        $response = $this->from('/login')->post('/login', [
            'email' => '',
            'password' => '',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors(['email', 'password']);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Ahmad Dahlan',
            'email' => 'ahmad@smartmeritim.id',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard'));

        $user = User::where('email', 'ahmad@smartmeritim.id')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Ahmad Dahlan', $user->name);
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    public function test_registration_validation_fails_with_mismatched_password_or_duplicate_email(): void
    {
        User::create([
            'name' => 'Existing User',
            'email' => 'existing@smartmeritim.id',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->from('/register')->post('/register', [
            'name' => '',
            'email' => 'existing@smartmeritim.id',
            'password' => 'short',
            'password_confirmation' => 'different',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function test_users_can_logout(): void
    {
        $user = User::create([
            'name' => 'Petugas Test',
            'email' => 'test@smartmeritim.id',
            'password' => Hash::make('password123'),
        ]);

        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->post('/logout');

        $this->assertGuest();
        $response->assertRedirect(route('login'));
    }

    public function test_unauthenticated_guests_are_redirected_from_protected_crud_routes(): void
    {
        // Akses langsung ke data kapal tanpa login harus di-redirect ke halaman login
        $response = $this->get('/data/kapal');
        $response->assertRedirect(route('login'));

        $responseCreate = $this->get('/data/kapal/create');
        $responseCreate->assertRedirect(route('login'));

        $responseStore = $this->post('/data/kapal', [
            'nama_kapal' => 'KM Uji Coba',
            'jenis_kapal' => 'Penangkap Ikan',
            'nama_kapten' => 'Kapten Budi',
            'status' => 'Berlayar',
        ]);
        $responseStore->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_access_protected_crud_routes(): void
    {
        $user = User::create([
            'name' => 'Petugas CRUD',
            'email' => 'petugas_crud@smartmeritim.id',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->actingAs($user)->get('/data/kapal');
        $response->assertStatus(200);
        $response->assertSee('Daftar Data Kapal');

        $responseCreate = $this->actingAs($user)->get('/data/kapal/create');
        $responseCreate->assertStatus(200);
    }

    public function test_public_dashboard_is_accessible_without_login(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Smart Meritim');
        $response->assertSee('Masuk');
        $response->assertSee('Daftar');
    }

    public function test_authenticated_users_are_redirected_from_guest_pages(): void
    {
        $user = User::create([
            'name' => 'User Auth',
            'email' => 'user_auth@smartmeritim.id',
            'password' => Hash::make('password123'),
        ]);

        $responseLogin = $this->actingAs($user)->get('/login');
        $responseLogin->assertRedirect(route('dashboard'));

        $responseRegister = $this->actingAs($user)->get('/register');
        $responseRegister->assertRedirect(route('dashboard'));
    }

    public function test_user_seeder_creates_at_least_five_faker_accounts_with_hashed_passwords(): void
    {
        $this->seed(UserSeeder::class);

        $users = User::all();
        $this->assertGreaterThanOrEqual(6, $users->count()); // 1 admin + 5 dummy faker

        foreach ($users as $user) {
            $this->assertNotEmpty($user->name);
            $this->assertNotEmpty($user->email);
            // Pastikan password berupa hash bcrypt ($2y$)
            $this->assertStringStartsWith('$2y$', $user->password);
            $this->assertTrue(Hash::check('password123', $user->password));
        }
    }
}
