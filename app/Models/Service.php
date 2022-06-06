<?php

namespace App\Models;

use App\Http\Traits\HasImage;
use App\Scopes\orderScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $ar_name
 * @property string $en_name
 * @property string|null $image
 * @property string|null $ar_description
 * @property string|null $en_description
 * @property int|null $sort_number
 * @property int $is_active
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read mixed $description
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Provider[] $provider
 * @property-read int|null $provider_count
 * @method static \Illuminate\Database\Eloquent\Builder|Service active()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereArDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereEnDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereSortNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\ServiceFactory factory(...$parameters)
 */
class Service extends Model
{
    use HasFactory,HasImage;

    protected static function booted()
    {
        static::addGlobalScope(new orderScope);
    }

    protected $fillable = ['ar_name', 'en_name', 'ar_description','en_description', 'sort_number','image', 'is_active','category_id'];

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->attributes['ar_name'] : $this->attributes['en_name'];
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->attributes['ar_description'] : $this->attributes['en_description'];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

     public function provider()
    {
        return $this->hasMany(Provider::class);
    }

    public function scopeActive($query)
    {
        return $query->whereIsActive(1);
    }


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            if ($model->image) {
                deleteImage('uploads', $model->image);
            }
        });
    }
}
