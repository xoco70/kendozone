<?php

namespace App\Repositories\Eloquent;

use App\User;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository
{

    public function findByUserNameOrCreate($userData, $provider)
    {

        $user = User::where('provider_id', '=', $userData->id)->first();
        if (!$user) {
            // Check if there is no other user with same email
            $user = User::where('email', '=', $userData->email)->first();
            if (!$user) {

                // get Large avatar
                $avatar = str_replace('sz=50', 'sz=200', $userData->avatar);
                $avatar = str_replace('type=normal', 'type=large ', $avatar);
                $user = User::create([
                    'provider' => $provider,
                    'provider_id' => $userData->id,
                    'name' => $userData->name,
                    'firstname' => $userData->name,
                    'slug' => str_slug($userData->name),
                    'email' => $userData->email,
                    'avatar' => $avatar,
                    'role_id' => config('constants.ROLE_USER'),
                    'verified' => 1,
                ]);
            } else {
                return null;
            }
        }

        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user)
    {

        $socialData = [
            'avatar' => $userData->avatar,
            'email' => $userData->email,
            'firstname' => $userData->name,
            'name' => $userData->nickname,
        ];
        $dbData = [
            'avatar' => $user->avatar,
            'email' => $user->email,
            'firstname' => $user->name,
            'name' => $user->username,
        ];

        if (!empty(array_diff($socialData, $dbData))) {

            $avatar = str_replace('sz=50', 'sz=200', $userData->avatar);
            $avatar = str_replace('type=normal', 'type=large', $avatar);

            $user->avatar = $avatar;
            $user->slug = str_slug($userData->name);
            $user->email = $userData->email;
            $user->firstname = $userData->name;
            if (strlen($userData->nickname) != 0)
                $user->name = $userData->nickname;
            else
                $user->name = $userData->email;
            $user->save();
        }
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return User::class;
    }

    /**
     * Find data by field and value
     *
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return Collection
     */

    public function firstByField($field = null, $value = null, $columns = ['*'])
    {
        return User::where($field, '=', $value)->first($columns);

    }

    /**
     * @param null $userSlug
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBySlug($userSlug = null)
    {
        return User::findBySlug($userSlug);

    }

    /**
     * @param null $userSlug
     * @param array $columns
     * @return Collection
     */
    public function findBySlugWithTrashed($userSlug = null, $columns = ['*'])
    {
        return User::withTrashed()->whereSlug($userSlug)->get($columns);

    }


    /**
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    public function getUsersWithCountriesAndRoles()
    {
        return User::with('country', 'role');
    }

    /**
     * @param $slug
     * @return Collection
     */
    public function getSoftDeletedUserBySlug($slug)
    {
        return User::onlyTrashed()->where('slug', '=', $slug)->first();

    }

    /**
     * @param User $user
     * @return Collection
     */
    public function getSoftDeletedUser(User $user)
    {
        return User::onlyTrashed()->where('email', '=', $user->email)->first();
    }
}