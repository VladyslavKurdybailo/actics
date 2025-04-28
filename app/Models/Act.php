<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    use HasFactory;

    protected $fillable = [
        'act_number',
        'check_type',
        'location',
        'date',
        'executor',
        'object_type',
        'object_address',
        'channels_count',
        'equipment',
        'customer_type',
        'customer_name',
        'dk_material',
        'dk_material_2',
        'dk1_area',
        'dk2_area',
        'vk1_area',
        'vk2_area',
        'pipe_material',
        'pipe_area',
        'pipe_length',
        'pipe_turns',
        'partition_condition',
        'channel_condition',
        'channel_separation',
        'chimney_head',
        'chimney_position_roof',
        'chimney_position_wind',
        'chimney_cracks',
        'ventilation_cracks',
        'cleaning_lid',
        'draft_dk1',
        'draft_dk2',
        'draft_vk1',
        'draft_vk2',
        'measuring_tool',
        'serial_number',
        'last_check_date',
        'air_exchange',
        'air_exchange_verified',
        'air_exchange_tool_serial',
        'air_exchange_tool_last_check',
        'conclusion',
        'reason_unfit',
        'customer_type_accusative',
        'owner_informed',
        'ban_date',
        'executor_rep',
        'customer_rep',
        'pdf_path',
        'signed_pdf_path',
        'qr_code',
        'pdf_path',
        'signed_pdf_path',
        'qr_code',
    ];
}
