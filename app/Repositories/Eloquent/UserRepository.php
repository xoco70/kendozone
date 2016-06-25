<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Exceptions\ValidatorException;
use App\User;

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
     * @return mixed
     */

    public function firstByField($field = null, $value = null, $columns = ['*'])
    {
        return User::where($field, '=', $value)->first($columns);

    }
    
    public function findBySlug($userSlug = null)
    {
        return User::findBySlug($userSlug);

    }

    public function findBySlugWithTrashed($userSlug = null, $columns = ['*'])
    {
        return User::withTrashed()->whereSlug($userSlug)->get($columns) ;

    }


    public function getUsersWithCountriesAndRoles()
    {
        return User::with('country','role');
    }
    public function getSoftDeletedUserBySlug($slug){
        return User::onlyTrashed()->where('slug', '=', $slug)->first();

    }
    public function getSoftDeletedUser(User $user){
        return User::onlyTrashed()->where('email', '=', $user->email)->first();
    }

    /**
     * @param $attributes
     * @return static $user
     */
    public static function registerUserToCategory($attributes)
    {
        $user = User::where(['email' => $attributes['email']])->withTrashed()->first();

        if ($user == null) {
            $password = null;
            $user = new User;
            $user->name = $attributes['name'];
            $user->email = $attributes['email'];
            $password = User::generatePassword();
            $user->password = bcrypt($password);
            $user->verified = 1;
            $user->save();
            $user->clearPassword = $password;
        } // If user is deleted, this is restoring the user only, but not his asset ( tournaments, categories, etc.)
        else if ($user->isDeleted()) {
            $user->deleted_at = null;
            $user->save();
        }

        // Fire Events

        return $user;
    }


//    public function with($relations)
//    {
//        if (is_string($relations)) $relations = func_get_args();
//
//        $this->with = $relations;
//
//        return $this;
//    }

//    protected function eagerLoadRelations($with)
//    {
//        if (!is_null($with)) {
//            foreach ($with as $relation) {
//                $this->with($relation);
//            }
//        }
//
//        return $this;
//    }
    /**
     * Retrieve data array for populate field select
     *
     * @param string $column
     * @param string|null $key
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function lists($column, $key = null)
    {
        // TODO: Implement lists() method.
    }

    /**
     * Retrieve all data of repository, paginated
     *
     * @param null $limit
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        // TODO: Implement paginate() method.
    }

    /**
     * Retrieve all data of repository, simple paginated
     *
     * @param null $limit
     * @param array $columns
     *
     * @return mixed
     */
    public function simplePaginate($limit = null, $columns = ['*'])
    {
        // TODO: Implement simplePaginate() method.
    }

    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhere(array $where, $columns = ['*'])
    {
        // TODO: Implement findWhere() method.
    }

    /**
     * Find data by multiple values in one field
     *
     * @param       $field
     * @param array $values
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhereIn($field, array $values, $columns = ['*'])
    {
        // TODO: Implement findWhereIn() method.
    }

    /**
     * Find data by excluding multiple values in one field
     *
     * @param       $field
     * @param array $values
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhereNotIn($field, array $values, $columns = ['*'])
    {
        // TODO: Implement findWhereNotIn() method.
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        // TODO: Implement update() method.
    }

    /**
     * Update or Create an entity in repository
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     * @param array $values
     *
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        // TODO: Implement updateOrCreate() method.
    }

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * Order collection by a given column
     *
     * @param string $column
     * @param string $direction
     *
     * @return $this
     */
    public function orderBy($column, $direction = 'asc')
    {
        // TODO: Implement orderBy() method.
    }

    /**
     * Load relations
     *
     * @param $relations
     *
     * @return $this
     */
    public function with($relations)
    {
        // TODO: Implement with() method.
    }
}