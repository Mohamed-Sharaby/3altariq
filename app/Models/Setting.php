<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string|null $ar_value
 * @property string|null $en_value
 * @property string|null $page
 * @property string|null $slug
 * @property string|null $ar_title
 * @property string|null $en_title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $title
 * @property-read mixed $value
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereArTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereArValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereEnTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereEnValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['name','type','ar_value','en_value','page','slug','ar_title','en_title'];

    /**
     * @return mixed
     */
    public function getValueAttribute(){
        if(app()->getLocale() == 'ar')
            return $this->ar_value;
        return $this->en_value;
    }

    /**
     * @return mixed
     */
    public function getTitleAttribute(){
        if(app()->getLocale() == 'ar')
            return $this->ar_title;
        return $this->en_title;
    }
}
