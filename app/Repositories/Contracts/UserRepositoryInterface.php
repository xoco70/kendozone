<?php
namespace App\Repositories\Contracts;

interface UserRepositoryInterface {

    public function all();
    public function findByField($field, $value = null, $columns = ['*']);
    public function firstByField($field, $value = null, $columns = ['*']);
//    public function getUsersWith($with);

}