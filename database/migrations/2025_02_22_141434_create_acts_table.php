<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('acts', function (Blueprint $table) {
            $table->id();
            $table->string('act_number')->nullable();
            $table->string('check_type')->nullable();
            $table->string('location')->nullable();
            $table->date('date')->nullable();
            $table->string('executor')->nullable();
            $table->string('object_type')->nullable();
            $table->string('object_address')->nullable();
            $table->string('channels_count')->nullable();
            $table->string('equipment')->nullable();
            $table->string('customer_type')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('dk_material')->nullable();
            $table->string('dk_material_2')->nullable();
            $table->string('dk1_area')->nullable();
            $table->string('dk2_area')->nullable();
            $table->string('vk1_area')->nullable();
            $table->string('vk2_area')->nullable();
            $table->string('pipe_material')->nullable();
            $table->string('pipe_area')->nullable();
            $table->string('pipe_length')->nullable();
            $table->string('pipe_turns')->nullable();
            $table->string('partition_condition')->nullable();
            $table->string('channel_condition')->nullable();
            $table->string('channel_separation')->nullable();
            $table->string('chimney_head')->nullable();
            $table->string('chimney_position_roof')->nullable();
            $table->string('chimney_position_wind')->nullable();
            $table->string('chimney_cracks')->nullable();
            $table->string('ventilation_cracks')->nullable();
            $table->string('cleaning_lid')->nullable();
            $table->string('draft_dk1')->nullable();
            $table->string('draft_dk2')->nullable();
            $table->string('draft_vk1')->nullable();
            $table->string('draft_vk2')->nullable();
            $table->string('measuring_tool')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('last_check_date')->nullable();
            $table->string('air_exchange')->nullable();
            $table->string('air_exchange_verified')->nullable();
            $table->string('air_exchange_tool_serial')->nullable();
            $table->date('air_exchange_tool_last_check')->nullable();
            $table->string('conclusion')->nullable();
            $table->string('reason_unfit')->nullable()->nullable();
            $table->string('customer_type_accusative')->nullable();
            $table->string('owner_informed')->nullable();
            $table->timestamp('ban_date')->nullable();
            $table->string('executor_rep')->nullable();
            $table->string('customer_rep')->nullable();
            $table->string('pdf_path')->nullable();  // Шлях до PDF
            $table->string('signed_pdf_path')->nullable();  // Шлях до підписаного PDF
            $table->string('qr_code')->nullable();  // Шлях до QR-коду
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acts');
    }
};
