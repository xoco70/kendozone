<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;


class UserAvatarTest extends BrowserKitTest
{
    use DatabaseMigrations;

//    use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;

    /** @test */
    public function only_members_can_add_avatars()
    {

        $user = factory(App\User::class)->create();
        $this->json('POST', 'api/v1/users/' . $user->slug . '/avatar')
            ->see('Unauthenticated');
    }

    /** @test */
    public function a_valid_avatar_must_be_provided()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user, 'api')
            ->json('POST', 'api/v1/users/' . $user->slug . '/avatar', [
                'file' => 'not-an-image'
            ])->see('The file must be an image');
    }

//    /** @test */
//    public function a_user_may_add_an_avatar_to_their_profile()
//    {
//        $this->signIn();
//
//        Storage::fake('public');
//
//        $this->json('POST', 'api/users/' . auth()->id() . '/avatar', [
//            'avatar' => $file = UploadedFile::fake()->image('avatar.jpg')
//        ]);
//
//        $this->assertEquals('avatars/' . $file->hashName(), auth()->user()->avatar_path);
//
//        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
//    }


}
