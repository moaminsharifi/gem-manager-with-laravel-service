<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Repository
{
    /**
     * Find model by id.
     *
     * @param  int  $key
     * @return instance of Model
     */
    public function findById(int $key): Model;

    /**
     * Find all instances.
     *
     * @param  int  $key
     * @return instance of Collection
     */
    public function findAll(): Collection;
}
