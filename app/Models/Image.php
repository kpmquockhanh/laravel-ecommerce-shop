<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function href(): Attribute
    {
        return Attribute::make(
            get: function () {
                $src = $this->src;
                return $src ? env('AWS_URL') . $src : asset('backend/img/placeholder.jpg');
            },
        );
    }

    protected $fillable = [
        'is_thumbnail',
        'entity_type',
        'entity_id',
        'src',
    ];
}
