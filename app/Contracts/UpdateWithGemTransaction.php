<?php

namespace App\Contracts;

use App\Models\Gem;
use App\Models\GemTransaction;

interface UpdateWithGemTransaction
{
    /**
     * update with update With GemTransaction.
     *
     * @param GemTransaction $gemTransaction
     * @return Gem
     */
    public function updateWithGemTransaction(Gem $gem, GemTransaction $gemTransaction): Gem;
}
