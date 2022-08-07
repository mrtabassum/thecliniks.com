<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiveConsultation extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'live_consultations';

    const OPD = 0;
    const IPD = 1;

    const HOST_ENABLE = 1;
    const HOST_DISABLED = 0;

    const CLIENT_ENABLE = 1;
    const CLIENT_DISABLED = 0;

    const STATUS_AWAITED = 0;
    const STATUS_CANCELLED = 1;
    const STATUS_FINISHED = 2;

    const STATUS_TYPE = [
        self::OPD => 'OPD',
        self::IPD => 'IPD',
    ];

    const status = [
        self::STATUS_AWAITED   => 'Awaited',
        self::STATUS_CANCELLED => 'Cancelled',
        self::STATUS_FINISHED  => 'Finished',
    ];

//    /**
//     * @var string[]
//     */
//    protected $appends = ['status_text'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'consultation_title',
        'consultation_date',
        'consultation_duration_minutes',
        'type',
        'type_number',
        'description',
        'created_by',
        'status',
        'meta',
        'meeting_id',
        'time_zone',
        'password',
        'host_video',
        'participant_video',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id'                    => 'required',
        'doctor_id'                     => 'required',
        'consultation_title'            => 'required',
        'consultation_date'             => 'required',
        'consultation_duration_minutes' => 'required|numeric|min:0|max:720',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'meta' => 'array',
    ];

//    /**
//     * @return string
//     */
//    public function getStatusTextAttribute()
//    {
//        return self::status[$this->status];
//    }

    /**
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    /**
     * @return BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
