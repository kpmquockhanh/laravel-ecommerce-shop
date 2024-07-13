<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'created_by',
        'slug',
        'active',
        'price',
        'image',
        'description',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'entity_id')->where('entity_type', 'product');
    }

    public function thumbnail(): Attribute
    {
        return Attribute::make(
            get: function () {
                $image = $this->images->firstWhere('is_thumbnail', true);
                return $image ? $image->href : asset('backend/img/placeholder.jpg');
            },
        );
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function canChange(): bool
    {
        return Auth::guard('admin')->check() && ($this->created_by == Auth::guard('admin')->id() || Auth::guard('admin')->user()->type == Admin::ADMIN_CODE);
    }

}
