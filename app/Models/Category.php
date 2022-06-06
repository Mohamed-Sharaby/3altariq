<?php

namespace App\Models;

use App\Http\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $ar_name
 * @property string $en_name
 * @property string|null $image
 * @property string|null $ar_description
 * @property string|null $en_description
 * @property int|null $sort_number
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $description
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Provider[] $providers
 * @property-read int|null $providers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Service[] $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category active()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereArDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereEnDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSortNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\CategoryFactory factory(...$parameters)
 */
class Category extends Model
{
    use HasFactory,HasImage;

    protected $fillable = ['ar_name', 'en_name', 'ar_description','en_description', 'sort_number','image', 'is_active'];

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->attributes['ar_name'] : $this->attributes['en_name'];
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->attributes['ar_description'] : $this->attributes['en_description'];
    }


    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function providers()
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
                $image = str_replace(url('/') . '/storage/', '', $model->image);
                deleteImage('uploads', $image);
            }
        });
    }

}
