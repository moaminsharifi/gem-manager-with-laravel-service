<?php

namespace App\Contracts;

use App\Models\Gem;
use App\Models\GemTransaction;

interface InsertGemTransaction
{
    /**
     * insert new Transaction.
     *
     * @param array $attributes
     * @return GemTransaction
     */
    public function insertGemTransaction(array $attributes, Gem $gem): GemTransaction;
}
