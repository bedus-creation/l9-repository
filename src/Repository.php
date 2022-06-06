<?php

namespace Aammui\L9Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /**
     * @var Builder
     */
    protected Builder $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model->newQuery();
    }

    public function get()
    {
        $results = $this->model->get();

        $this->resetModel();
    }

    protected function resetModel() {}
}
