<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EditProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_edit_any_user_profile()
    {
        $user = factory(User::class)->create();

        $this->get("/profiles/edit/{$user->id}")
            ->assertRedirect('/login');

        $this->patch("/profiles/{$user->id}")
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_cannot_edit_other_users_profile()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $anotherUser = factory(User::class)->create();

        $this->get("/profiles/edit/{$anotherUser->id}")
            ->assertStatus(403);

        $this->patch("/profiles/{$anotherUser->id}")
             ->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_can_edit_about_text_in_his_own_profile()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->get("/profiles/edit/{$user->id}")
            ->assertStatus(200);

        $about = "Updated about text";

        $this->patch("/profiles/{$user->id}", ['about' => $about])
             ->assertRedirect("/profiles/{$user->id}");

        $this->get("/profiles/{$user->id}")
            ->assertSee($about);

        $this->assertDatabaseHas('users', [
            'about' => $about
        ]);
    }

    /** @test */
    public function an_authenticated_user_can_edit_profile_image_in_his_own_profile()
    {
        Storage::fake('dropbox');

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->get("/profiles/edit/{$user->id}")
            ->assertStatus(200);

        $data = [
            'about' => 'updated about text',
            'photofile' => $file = UploadedFile::fake()->image('myimage.jpg')
        ];

        $this->patch("/profiles/{$user->id}", $data)
             ->assertRedirect("/profiles/{$user->id}");

        Storage::disk('dropbox')->assertExists('images/' . $file->hashName());

        $this->assertDatabaseHas('users', [
                'photourl' => 'images/' . $file->hashName()
        ]);

    }

}
