<?php
namespace App\Repositories\Eloquent;


use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\RepositoryException;
use App\Repositories\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var Application
     */
    protected $app;
    /**
     * @var Model
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    public function create(array $columns)
    {
        return $this->model->create($columns);
    }
    public function findByField($field = null, $value = null, $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)->get($columns);

    }

    public function find($value = null, $columns = ['*'])
    {
        return $this->model->where('id', '=', $value)->first($columns);

    }

/**
* Retrieve data array for populate field select
*
* @param string      $column
* @param string|null $key
*
* @return \Illuminate\Support\Collection|array
*/
    public function lists($column, $key = null)
    {
        return $this->model->lists($column, $key);
    }

    /**
     * Retrieve first data of repository
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function first($columns = ['*'])
    {
        return $this->model->first($columns);
    }
    /**
     * Retrieve all data of repository, paginated
     *
     * @param null   $limit
     * @param array  $columns
     * @param string $method
     *
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'], $method = "paginate")
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
        $results = $this->model->{$method}($limit, $columns);
        $results->appends(request()->query());

        return $results;
    }
    /**
     * Retrieve all data of repository, simple paginated
     *
     * @param null  $limit
     * @param array $columns
     *
     * @return mixed
     */
    public function simplePaginate($limit = null, $columns = ['*'])
    {
        return $this->paginate($limit, $columns, "simplePaginate");
    }




    /**
     * Save a new entity in repository
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     *
     * @return mixed
     */
//    public function create(array $attributes)
//    {
//        if (!is_null($this->validator)) {
//            // we should pass data that has been casts by the model
//            // to make sure data type are same because validator may need to use
//            // this data to compare with data that fetch from database.
//            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();
//            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
//        }
//        $model = $this->model->newInstance($attributes);
//        $model->save();
////        event(new RepositoryEntityCreated($this, $model));
//        return $model;
//    }
    /**
     * Update a entity in repository by id
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
//    public function update(array $attributes, $id)
//    {
//        $this->applyScope();
//        if (!is_null($this->validator)) {
//            // we should pass data that has been casts by the model
//            // to make sure data type are same because validator may need to use
//            // this data to compare with data that fetch from database.
//            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();
//            $this->validator->with($attributes)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);
//        }
//        $temporarySkipPresenter = $this->skipPresenter;
//        $this->skipPresenter(true);
//        $model = $this->model->findOrFail($id);
//        $model->fill($attributes);
//        $model->save();
//        $this->skipPresenter($temporarySkipPresenter);
//        $this->resetModel();
//        event(new RepositoryEntityUpdated($this, $model));
//        return $this->parserResult($model);
//    }
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
//    public function updateOrCreate(array $attributes, array $values = [])
//    {
//        $this->applyScope();
//        if (!is_null($this->validator)) {
//            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_UPDATE);
//        }
//        $temporarySkipPresenter = $this->skipPresenter;
//        $this->skipPresenter(true);
//        $model = $this->model->updateOrCreate($attributes, $values);
//        $this->skipPresenter($temporarySkipPresenter);
//        $this->resetModel();
//        event(new RepositoryEntityUpdated($this, $model));
//        return $this->parserResult($model);
//    }
//    /**
//     * Delete a entity in repository by id
//     *
//     * @param $id
//     *
//     * @return int
//     */
//    public function delete($id)
//    {
//        $this->applyScope();
//        $temporarySkipPresenter = $this->skipPresenter;
//        $this->skipPresenter(true);
//        $model = $this->find($id);
//        $originalModel = clone $model;
//        $this->skipPresenter($temporarySkipPresenter);
//        $this->resetModel();
//        $deleted = $model->delete();
//        event(new RepositoryEntityDeleted($this, $originalModel));
//        return $deleted;
//    }
//    /**
//     * Delete multiple entities by given criteria.
//     *
//     * @param array $where
//     *
//     * @return int
//     */
//    public function deleteWhere(array $where)
//    {
//        $this->applyScope();
//        $temporarySkipPresenter = $this->skipPresenter;
//        $this->skipPresenter(true);
//        $this->applyConditions($where);
//        $deleted = $this->model->delete();
//        event(new RepositoryEntityDeleted($this, $this->model));
//        $this->skipPresenter($temporarySkipPresenter);
//        $this->resetModel();
//        return $deleted;
//    }
//    /**
//     * Check if entity has relation
//     *
//     * @param string $relation
//     *
//     * @return $this
//     */
//    public function has($relation)
//    {
//        $this->model = $this->model->has($relation);
//        return $this;
//    }
    /**
     * Load relations
     *
     * @param array|string $relations
     *
     * @return $this
     */
    public function with($relations)
    {
        $this->model = $this->model->with($relations);
        return $this;
    }

    /**
     * Load relation with closure
     *
     * @param string $relation
     * @param closure $closure
     *
     * @return $this
     */
//    function whereHas($relation, $closure)
//    {
//        $this->model = $this->model->whereHas($relation, $closure);
//        return $this;
//    }
    /**
     * Set hidden fields
     *
     * @param array $fields
     *
     * @return $this
     */
//    public function hidden(array $fields)
//    {
//        $this->model->setHidden($fields);
//        return $this;
//    }
    public function orderBy($column, $direction = 'asc')
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

}