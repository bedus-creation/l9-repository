<?php

namespace Aammui\L9Repository\Transformers;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;

trait HasTransformer
{
    public function transform($data)
    {
        if ( empty($this->transformer) ) {
            return $data;
        }

        $resource = null;
        $fractal  = new Manager();
        // TODO: set serializer from config
        $fractal->setSerializer(new ArraySerializer());

        if ( $data instanceof Model ) {
            $resource = new Item($data, new $this->transformer);
        }
        else if ( $data instanceof EloquentCollection ) {
            $resource = new Collection($data, new $this->transformer);
        }
//        else if ( $data instanceof ){
//            $resource = new Collection($data->getCollection(), new $this->transformer);
//            $resource->setPaginator(new IlluminatePaginatorAdapter($data));
//        }

        return $fractal->createData($resource);
    }
}
