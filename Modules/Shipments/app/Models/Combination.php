<?php

namespace Modules\Shipments\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Shipments\Database\Factories\CombinationFactory;

/**
 * Class Combination
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $option_id
 *
 * Relations:
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Shipments\Models\Shipment> $shipments
 *
 * @method static CombinationFactory factory(...$parameters)
 */
class Combination extends Model
{
    /**
     * Use HasFactory with explicit generic type.
     *
     * @template TFactory of \Illuminate\Database\Eloquent\Factories\Factory<static>
     *
     * @use HasFactory<CombinationFactory>
     */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'option_id',
        'name',
    ];

    /**
     * Define factory method with correct generic type.
     */
    protected static function newFactory(): CombinationFactory
    {
        return CombinationFactory::new();
    }

    public $timestamps = false;

    /**
     * Get the shipments for the combination.
     *
     * @return HasMany<Shipment,$this>
     */
    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }
}
