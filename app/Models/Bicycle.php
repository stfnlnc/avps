<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $picture
 * @property string $qr_code
 * @property string $name
 * @property string|null $serial_number
 * @property string|null $ref_number
 * @property string $slug
 * @property string|null $recipient
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $delivery_date
 * @property string|null $delivery_location
 * @property string|null $delivery_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle whereFrameSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle whereRefNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle whereRepair($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicycle whereWheelSize($value)
 * @mixin \Eloquent
 */
class Bicycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture',
        'qr_code',
        'name',
        'slug',
        'serial_number',
        'ref_number',
        'start_date',
        'end_date',
        'recipient',
        'delivery_date',
        'delivery_location',
        'delivery_status'
    ];
}
