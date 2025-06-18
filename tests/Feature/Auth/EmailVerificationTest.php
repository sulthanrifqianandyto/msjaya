<?php

namespace Tests\Feature\Auth;

use App\Models\Pelanggan;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered(): void
    {
        $pelanggan = Pelanggan::factory()->unverified()->create();

        $response = $this->actingAs($pelanggan)->get('/verify-email');

        $response->assertStatus(200);
    }

    public function test_email_can_be_verified(): void
    {
        $pelanggan = Pelanggan::factory()->unverified()->create();

        Event::fake();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $pelanggan->id, 'hash' => sha1($pelanggan->email)]
        );

        $response = $this->actingAs($pelanggan)->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($pelanggan->fresh()->hasVerifiedEmail());
        $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
    }

    public function test_email_is_not_verified_with_invalid_hash(): void
    {
        $pelanggan = Pelanggan::factory()->unverified()->create();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $pelanggan->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($pelanggan)->get($verificationUrl);

        $this->assertFalse($pelanggan->fresh()->hasVerifiedEmail());
    }
}
