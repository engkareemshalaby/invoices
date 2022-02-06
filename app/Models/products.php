<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Model\secions;

class products extends Model
{
    protected $fillable = [
        'product_name',
        'description',
        'section_id',
        'created_by',
    ];

    public function section()
    {
        return $this->belongsTo(sections::class);
    }

    use HasFactory;
}
