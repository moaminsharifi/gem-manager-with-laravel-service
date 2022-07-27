<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GemTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gem_id',
        'before',
        'value',
        'type',
        'sing',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sing' => 'boolean',
    ];

    /**
     * Get the gem that owns the gemTransaction.
     */
    public function gem()
    {
        return $this->belongsTo(Gem::class);
    }

    /**
     * isIncremental function.
     *
     * @return bool
     */
    public function isIncremental()
    {
        return $this->sing;
    }

    /**
     * isDecremental function.
     *
     * @return bool
     */
    public function isDecremental()
    {
        return !$this->sing;
    }
}
