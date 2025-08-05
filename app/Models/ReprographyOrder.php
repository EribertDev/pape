<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReprographyOrder extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'user_id', 'contact', 'file_path', 'service_types', 'color', 'option',
        'format', 'binding', 'binding_type', 'lamination', 'page_count', 'copy_count',
        'delivery_mode', 'commune', 'neighborhood', 'address_details', 'gps_location',
        'relay_point', 'student_tariff', 'order_cost', 'delivery_cost', 'total_cost'
    ];

    protected $casts = [
        'service_types' => 'array',
        'binding' => 'boolean',
        'lamination' => 'boolean',
        'student_tariff' => 'boolean',
    ];
}
