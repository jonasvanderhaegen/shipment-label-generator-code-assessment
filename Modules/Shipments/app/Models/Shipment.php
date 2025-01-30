<?php

namespace Modules\Shipments\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Shipments\Database\Factories\ShipmentFactory;

/**
 * Class Shipment
 *
 * @property int $id
 * @property string $order_number
 * @property int|null $company_id
 * @property int $brand_id
 * @property int $combination_id
 * @property string $delivery_company_name
 * @property string $delivery_name
 * @property string $delivery_street
 * @property string $delivery_housenumber
 * @property string $delivery_zipcode
 * @property string $delivery_city
 * @property string $delivery_country
 * @property int|null $api_shipment_id
 * @property string|null $api_tracking_id
 * @property string|null $api_tracking_url
 * @property string|null $api_label_pdf_url
 * @property string|null $pdf_path
 * @property string|null $pdf_filename
 * @property string|null $base64String
 *
 * Relations:
 * @property-read \Modules\Shipments\Models\Combination $combination
 */
class Shipment extends Model
{
    /**
     * Use HasFactory with explicit generic type.
     *
     * @template TFactory of \Illuminate\Database\Eloquent\Factories\Factory<static>
     *
     * @use HasFactory<ShipmentFactory>
     */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [
        'id', // Assuming 'id' is the primary key and should not be mass assignable
        // Add any other attributes you want to guard
    ];

    protected static function newFactory(): ShipmentFactory
    {
        return ShipmentFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'brand_id',
        'company_id',
        'order_number',
        'billing_name',
        'billing_company_name',
        'billing_street',
        'billing_housenumber',
        'billing_zipcode',
        'billing_city',
        'billing_country',
        'delivery_name',
        'delivery_company_name',
        'delivery_street',
        'delivery_housenumber',
        'delivery_zipcode',
        'delivery_city',
        'delivery_country',
        'api_shipment_id',
        'api_tracking_id',
        'api_tracking_url',
        'api_label_pdf_url',
        'pdf_path',
        'pdf_filename',
        'combination_id',
    ];

    /**
     * Get the combination for the shipment.
     *
     * @return BelongsTo<Combination,$this>
     */
    public function combination(): BelongsTo
    {
        return $this->belongsTo(Combination::class);
    }
}
