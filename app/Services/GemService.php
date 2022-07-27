<?php

namespace App\Services;

use App\Contracts\UpdateWithGemTransaction;
use App\Exceptions\GemNegativeValueException;
use App\Models\Gem;
use App\Models\GemTransaction;
use Illuminate\Database\Eloquent\Collection;

class GemService extends Service implements UpdateWithGemTransaction
{
    /**
     * find gem By Id.
     *
     * @param int $key
     * @return Gem
     */
    public function findById(int $key): Gem
    {
        return Gem::find($key);
    }

    /**
     * find All Gems.
     *
     * @return Collection set of gems
     */
    public function findAll() : Collection
    {
        return Gem::all();
    }

    /**
     * updateWithGemTransaction function.
     *
     * @param Gem $gem
     * @param GemTransaction $gemTransaction
     * @return Gem
     */
    public function updateWithGemTransaction(Gem $gem, GemTransaction $gemTransaction) : Gem
    {
        $oldGemCount = $gem->gem;
        $newGemCount = $gemTransaction->isIncremental() ?
         $oldGemCount + $gemTransaction->value :
          $oldGemCount - $gemTransaction->value;

        if ($newGemCount < 0) {
            throw new GemNegativeValueException('Transaction->value is not valid and make new gem count lower than zero');
        }
        $gem->update(
            ['gem'=>$newGemCount]
        );
        $gemTransaction->update(
            ['before' => $oldGemCount]
        );

        return $gem;
    }
}
