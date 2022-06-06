<?php

namespace App\Models;

use App\Http\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Banner
 *
 * @property int $id
 * @property string $ar_name
 * @property string $en_name
 * @property string|null $image
 * @property string|null $type
 * @property string|null $device_type
 * @property string|null $url
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $country_id
 * @property-read \App\Models\Country $country
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder|Banner active()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereDeviceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUrl($value)
 * @mixin \Eloquent
 */
class Banner extends Model
{
    use HasFactory,HasImage;

    protected $fillable = ['ar_name', 'en_name', 'type', 'device_type','url_type', 'country_id', 'url', 'image', 'is_active'];

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->attributes['ar_name'] : $this->attributes['en_name'];
    }


    public function scopeActive($query)
    {
        return $query->whereIsActive(1);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
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
