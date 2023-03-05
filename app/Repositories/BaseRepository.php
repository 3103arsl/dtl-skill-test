<?php

namespace App\Repositories;

use App\Helpers\FilterTrait;
use App\Helpers\UserTrait;
use Illuminate\Database\QueryException;

class BaseRepository {
    use UserTrait, FilterTrait;

    const NUMBER_OF_RECORDS = 100;
    const CREATER_RELATION = 'creator';
    const UPDATOR_RELATION = 'updator';

    /**
     * The Model name.
     *
     * @var \Illuminate\Database\Eloquent\Model;
     */
    protected $model;

    public function get() {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            //return $e->getMessage();
            dd($e->getMessage());
        }
    }

    /**
     * Paginate the given query.
     *
     * @param The number of models to return for pagination $n integer
     *
     * @return mixed
     */
    public function getPaginate($n = self::NUMBER_OF_RECORDS) {
        try {
            return $this->model->paginate($n);
        } catch (Illuminate\Database\QueryException $e) {
            dd($e->getMessage());

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @param array $data
     */
    public function create(array $data) {
        try {
            return $this->model->create($data);
        } catch (Illuminate\Database\QueryException $e) {
            dd($e->getMessage());

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @param array $data
     */
    public function insert(array $data) {
        try {
            $this->model->insert($data);
            return $this->model;
        } catch (Illuminate\Database\QueryException $e) {
            dd($e->getMessage());

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param array $data
     */
    public function save(array $data) {
        try {
            if (!empty($data)) {
                foreach ($data as $key => $input) {
                    $this->model->{$key} = $input;
                }
                $this->model->save();
                return $this->model;
            }
            return false;
        } catch (Illuminate\Database\QueryException $e) {
            dd($e->getMessage());

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @param int $id
     */
    public function getById(int $id) {
        try {
            return $this->model->findOrFail($id);
        } catch (Illuminate\Database\QueryException $e) {
            dd($e->getMessage());

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @param int $slug
     */
    public function getBySlug(string $slug) {
        try {
            return $this->model->where(['slug' => $slug])->first();
        } catch (Illuminate\Database\QueryException $e) {
            dd($e->getMessage());

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the model in the database.
     *
     * @param int $id
     * @param array $inputs
     */
    public function update(int $id, array $inputs) {
        try {
            $model = $this->getById($id);
            $model->update($inputs);
            return $model;
        } catch (Illuminate\Database\QueryException $e) {
            dd($e->getMessage());

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function updateByKeys(int $id, array $inputs) {
        try {
            $model = $this->getById($id);
            if (!empty($inputs)) {
                foreach ($inputs as $key => $input) {
                    $model->{$key} = $input;
                }
                $model->update();
                return $model;
            }
            return false;
        } catch (Illuminate\Database\QueryException $e) {
            dd($e->getMessage());

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Delete the model from the database.
     *
     * @param int $id
     *
     * @throws \Exception
     */
    public function delete(int $id) {
        try {
            return $this->getById($id)->delete();
        } catch (Illuminate\Database\QueryException $e) {
            dd($e->getMessage());

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function forceDelete(int $id) {
        try {
            return $this->getById($id)->forceDelete();
        } catch (Illuminate\Database\QueryException $e) {
            dd($e->getMessage());

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }
}
