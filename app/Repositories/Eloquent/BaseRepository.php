<?php

namespace App\Repositories\Eloquent;


use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;

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
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();

    }

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

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();

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
     * @param string $column
     * @param string|null $key
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function pluck($column, $key = null)
    {
        return $this->model->pluck($column, $key);
    }


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


    public function orderBy($column, $direction = 'asc')
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

}