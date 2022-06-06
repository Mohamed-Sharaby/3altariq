<?php

namespace App\Models;

use App\Http\Traits\HasImage;
use App\Services\FirestoreProviders;
use Google\Cloud\Core\GeoPoint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Tymon\JWTAuth\Contracts\JWTSubject;


/**
 * App\Models\Provider
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $password
 * @property string|null $image
 * @property string|null $address
 * @property string $location
 * @property int $is_active
 * @property int $is_confirmed
 * @property int $is_verified
 * @property array|null $photos
 * @property \Illuminate\Support\Carbon|null $expire_at
 * @property int|null $category_id
 * @property int|null $service_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $country_id
 * @property string|null $country_code
 * @property string|null $fcm_token_android
 * @property string|null $fcm_token_ios
 * @property string|null $confirmation_code
 * @property string|null $reset_code
 * @property string|null $confirmed_at
 * @property string|null $reset_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cart[] $orders
 * @property-read int|null $carts_count
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\Country $country
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Service|null $service
 * @method static \Illuminate\Database\Eloquent\Builder|Provider active()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newQuery()
 * @method static \Illuminate\Database\Query\Builder|Provider onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereConfirmationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereExpireAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereFcmTokenAndroid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereFcmTokenIos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereResetAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereResetCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Provider withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Provider withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $bio
 * @property int $profile_counter
 * @property int $phone_counter
 * @property int $whatsapp_counter
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $CanceledOrders
 * @property-read int|null $canceled_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $FinishedOrders
 * @property-read int|null $finished_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $OnTheWayOrders
 * @property-read int|null $on_the_way_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $PendingOrders
 * @property-read int|null $pending_orders_count
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Verification[] $verifications
 * @property-read int|null $verifications_count
 * @method static \Database\Factories\ProviderFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider wherePhoneCounter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereProfileCounter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereWhatsappCounter($value)
 */
class Provider extends Authenticatable implements JWTSubject, HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia,HasImage;

    protected $fillable = ['name', 'phone', 'password', 'image', 'is_active', 'address', 'location', 'country_code',
        'fcm_token_android', 'fcm_token_ios', 'confirmation_code', 'reset_code', 'is_verified', 'expire_at',
        'is_confirmed', 'confirmed_at', 'reset_at', 'category_id', 'service_id', 'country_id','bio',
        'profile_counter','phone_counter','whatsapp_counter','is_reviewed','locale'];

    protected $hidden = ['password'];

    protected $casts = [
        // 'photos' => 'array',
        'expire_at' => 'date'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($pass)
    {
        if (!empty($pass)) {
            $this->attributes['password'] = bcrypt($pass);
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
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

            if ($model->getMedia('photos')) {
                $model->clearMediaCollection('photos');
            }
        });

    }
    public function verifications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Verification::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function PendingOrders()
    {
        return $this->hasMany(Order::class)->where('status','pending');
    }
    public function CanceledOrders()
    {
        return $this->hasMany(Order::class)->where('status','canceled');
    }
    public function FinishedOrders()
    {
        return $this->hasMany(Order::class)->where('status','finished');
    }
    public function OnTheWayOrders()
    {
        return $this->hasMany(Order::class)->whereIn('status',['on_the_way','confirmed']);
    }

    public function getHasAcceptedOrderAttribute()
    {
        return $this->OnTheWayOrders()->exists();
    }
}
