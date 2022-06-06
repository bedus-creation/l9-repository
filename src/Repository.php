<?php

namespace Aammui\L9Repository;

use Aammui\L9Repository\Transformers\HasTransformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

/**
 * Class Repository
 *
 * @template T
 */
class Repository implements RepositoryInterface
{
    use HasTransformer;

    protected Builder $query;

    protected string $transformer;

    /**
     * BaseRepository constructor.
     *
     * @param T $model
     */
    public function __construct(Model $model)
    {
        $this->query = $model->newQuery();
    }

    public function get()
    {
        $results = $this->query->get();

        $this->resetModel();
    }

    /**
     * @param int   $id
     * @param array $columns
     *
     * @return T of object
     */
    public function findOrFail(int $id, $columns = ['*'])
    {
        $results = $this->query->findOrFail($id, $columns);

        $results = $this->transform($results);
        $this->resetModel();

        return $results;
    }

    public function setTransformer(string $transformer)
    {
        $this->transformer = $transformer;

        return $this;
    }

    protected function resetModel()
    {
        $this->query = $this->query->getModel()->newQuery();

        return $this;
    }

}
