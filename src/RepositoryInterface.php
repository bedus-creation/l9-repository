<?php

namespace Aammui\L9Repository;

interface RepositoryInterface
{
    public function findOrFail(int $id, $columns = ['*']);
}
