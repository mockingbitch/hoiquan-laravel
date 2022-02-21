<?php

namespace App\Repositories;

use App\Repositories\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * Model
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * @return mixed
     */
    abstract public function getModel();

    /**
     * @return void
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    /**
     * @param $attributes
     *
     * @return mixed
     */
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @param $attributes
     *
     * @return false|mixed
     */
    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if($result){
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete($id): bool
    {
        $result = $this->find($id);
        if($result){
            $result->delete();
            return true;
        }
        return false;
    }

    /**
     * @param $int
     *
     * @return mixed
     */
    public function paginate($int){
        return $this->model->paginate($int);
    }

    /**
     * @return mixed
     */
    public function count(){
        return $this->model->count();
    }


}
