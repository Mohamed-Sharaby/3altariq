<?php

namespace App\Models;

use App\Http\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blog
 *
 * @property int $id
 * @property string $ar_name
 * @property string $en_name
 * @property string|null $ar_description
 * @property string|null $en_description
 * @property string|null $image
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $description
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|Blog active()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereArDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereEnDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Blog extends Model
{
    use HasFactory,HasImage;

    protected $fillable = ['ar_name', 'en_name', 'ar_description', 'en_description', 'image', 'is_active','url'];

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->attributes['ar_name'] : $this->attributes['en_name'];
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->attributes['ar_description'] : $this->attributes['en_description'];
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
                $image = str_replace(url('/') . '/storage/', '', $model->image);
                deleteImage('uploads', $image);
            }
        });
    }
}
