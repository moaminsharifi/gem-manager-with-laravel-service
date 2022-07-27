<?php

namespace App\Services;

use App\Contracts\InsertGemTransaction;
use App\Models\Gem;
use App\Models\GemTransaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class GemTransactionService extends Service implements InsertGemTransaction
{
    /**
     * find gemTransaction By Id.
     *
     * @param int $key
     * @return GemTransaction
     */
    public function findById(int $key): GemTransaction
    {
        return GemTransaction::find($key);
    }

    /**
     * find all gemTransaction.
     *
     * @return Collection
     */
    public function findAll() : Collection
    {
        return GemTransaction::all();
    }

    public function insertGemTransaction(array $attributes, Gem $gem): GemTransaction
    {
        DB::beginTransaction();

        try {
            $gemTransaction = $gem->transactions()->create($attributes);

            (new GemService())->updateWithGemTransaction($gem, $gemTransaction);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        DB::commit();

        return $gemTransaction;
    }
}
