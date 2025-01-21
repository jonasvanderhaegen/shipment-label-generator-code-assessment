<?php

namespace Modules\Shipments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipments\Database\Factories\ShipmentFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    use HasFactory;

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
        'combination_id'
    ];

    /**
     * Get the combination that owns the shipment.
     */
    public function combination(): BelongsTo
    {
        return $this->belongsTo(Combination::class);
    }
}
