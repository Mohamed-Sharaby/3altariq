<?php

namespace App\Models;

use App\Http\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Verification
 *
 * @property int $id
 * @property int $provider_id
 * @property string $email
 * @property string $status
 * @property string $ssn
 * @property string|null $image
 * @property string|null $ssn_image
 * @property string|null $licence_image
 * @property string|null $car_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Verification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Verification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Verification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereCarImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereLicenceImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereSsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereSsnImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Provider $provider
 */
class Verification extends Model
{
    use HasFactory , HasImage;

    protected $fillable = ['provider_id', 'email', 'status', 'ssn', 'image', 'ssn_image', 'licence_image', 'car_image'];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function setImageAttribute($image)
    {
        if (!is_null($image)) {
            $this->attributes['image'] = uploadImage('uploads', $image);
        }
    }



    public function getLicenceImageAttribute($image)
    {
        if (is_null($image)) {
            return asset('logo/user.png');
        }
        return asset($image);
    }

    public function setSsnImageAttribute($image)
    {
        if (!is_null($image)) {
            $this->attributes['ssn_image'] = uploadImage('uploads', $image);
        }
    }

    public function getSsnImageAttribute($image)
    {
        if (is_null($image)) {
            return asset('logo/user.png');
        }
        return asset($image);
    }


    public function setCarImageAttribute($image)
    {
        if (!is_null($image)) {
            $this->attributes['car_image'] = uploadImage('uploads', $image);
        }
    }

    public function getCarImageAttribute($image)
    {
        if (is_null($image)) {
            return asset('logo/user.png');
        }
        return asset($image);
    }
}
