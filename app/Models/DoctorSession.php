<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * App\Models\DoctorSession
 *
 * @property int $id
 * @property int $doctor_id
 * @property string $session_meeting_time
 * @property string $session_gap
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Doctor $doctor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WeekDay[] $sessionWeekDays
 * @property-read int|null $session_week_days_count
 * @method static \Database\Factories\DoctorSessionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorSession whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorSession whereSessionGap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorSession whereSessionMeetingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DoctorSession whereUpdatedAt($value)
 * @mixin Model
 */
class DoctorSession extends Model
{
    use HasFactory;

    protected $table = 'doctor_sessions';

    public $fillable = [
        'doctor_id',
        'session_meeting_time',
        'session_gap',
    ];

    const MALE = 1;
    const FEMALE = 2;

    const GENDER = [
        self::MALE   => 'Male',
        self::FEMALE => 'Female',
    ];
    
    const GAPS = [
        '5'  => '5 minutes',
        '10' => '10 minutes',
        '15' => '15 minutes',
        '20' => '20 minutes',
        '25' => '25 minutes',
        '30' => '30 minutes',
        '45' => '45 minutes',
        '60' => '1 hour',
    ];

    const SESSION_MEETING_TIME = [
        '5'  => '5 minutes',
        '10' => '10 minutes',
        '15'  => '15 minutes',
        '30'  => '30 minutes',
        '45'  => '45 minutes',
        '60'  => '1 hour',
        '90'  => '1.5 hour',
        '120' => '2 hour',
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'doctor_id'            => 'required',
        'session_meeting_time' => 'required',
        'session_gap'          => 'required',
    ];

    /**
     *
     * @return HasMany
     */
    public function sessionWeekDays()
    {
        return $this->hasMany(WeekDay::class);
    }

    /**
     *
     * @return BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

}
