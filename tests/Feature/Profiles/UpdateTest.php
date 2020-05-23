<?php

namespace Tests\Feature\Profiles;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_update_any_user_profile()
    {
        $user = factory(User::class)->create();

        $this->get(route('profiles.edit', $user))
            ->assertRedirect(route('sessions.create'));

        $this->patch(route('profiles.update', $user))
            ->assertRedirect(route('sessions.create'));
    }

    /** @test */
    public function non_admin_users_cannot_update_other_users_profile()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $anotherUser = factory(User::class)->create();

        $this->get(route('profiles.edit', $anotherUser))
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->patch(route('profiles.update', $anotherUser))
             ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function non_admin_users_can_update_about_text_in_their_own_profile()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->get(route('profiles.edit', $user))
            ->assertStatus(Response::HTTP_OK);

        $updatedProfileData = [
            'about' => 'Updated about text'
        ];

        $this->patch(route('profiles.update', $user), $updatedProfileData)
             ->assertRedirect(route('profiles.show', $user))
             ->assertSessionMissing('errors');

        $this->get(route('profiles.show', $user))
            ->assertStatus(Response::HTTP_OK)
            ->assertSee($updatedProfileData['about']);

        $this->assertDatabaseHas('users', $updatedProfileData);
    }

    /** @test */
    public function non_admin_users_can_update_profile_image_in_their_own_profile()
    {
        Storage::fake('dropbox');

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->get(route('profiles.edit', $user))
            ->assertStatus(Response::HTTP_OK);

        $uploadedFile = UploadedFile::fake()->image('myimage.jpg');

        $updatedProfileData = [
            'about' => 'updated about text',
            'photofile' => $uploadedFile
        ];

        $this->patch(route('profiles.update', $user), $updatedProfileData)
             ->assertRedirect(route('profiles.show', $user))
             ->assertSessionMissing('errors');

        Storage::disk('dropbox')
            ->assertExists('images/' . $uploadedFile->hashName());

        $this->assertDatabaseHas('users', [
            'photourl' => 'images/' . $uploadedFile->hashName()
        ]);
    }
}
