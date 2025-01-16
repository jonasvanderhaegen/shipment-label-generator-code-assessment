<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('brand_id');
            $table->string('company_id');
            $table->string('order_number');
            $table->string('billing_company_name')->nullable();
            $table->string('billing_name');
            $table->mediumText('billing_street');
            $table->string('billing_housenumber');
            $table->string('billing_zipcode');
            $table->string('billing_city');
            $table->string('billing_country');
            $table->string('delivery_company_name');
            $table->string('delivery_name');
            $table->mediumText('delivery_street');
            $table->string('delivery_housenumber');
            $table->string('delivery_zipcode');
            $table->string('delivery_city');
            $table->string('delivery_country');

            $table->uuid('api_shipment_id')->nullable();
            $table->string('api_tracking_id')->nullable();
            $table->string('api_tracking_url')->nullable();
            $table->mediumText('api_label_pdf_url')->nullable();

            $table->string('pdf_path')->nullable();
            $table->string('pdf_filename')->nullable();

            $table->integer('combination_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
