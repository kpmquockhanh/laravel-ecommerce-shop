<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'type',
        'value'
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'entity_id')->where('entity_type', 'setting');
    }
}
