<?php

namespace Modules\Shipments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Shipments\Database\Factories\CombinationFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Combination extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'option_id',
        'name'
    ];

    // protected static function newFactory(): CombinationFactory
    // {
    //     // return CombinationFactory::new();
    // }

    public $timestamps = false;

    /**
     * Get the shipments for the combination.
     */
    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }
}
