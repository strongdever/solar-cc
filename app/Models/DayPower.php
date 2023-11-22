<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayPower extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'day_powers';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that are hidden.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'company',
        'sensor_number',
        'sensor_id',
        'prefecture',
        'measured_at',
        'used_amount',
        'generated_amount',
        'purchased_amount',
        'solded_amount',
        'self_amount',
        'purchase_method',
        'user_id',
        'carport_id',
        'file_id',
        'comment',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'measured_at' => 'datetime',
        'used_amount' => 'decimal:4',
        'generated_amount' => 'decimal:4',
        'purchased_amount' => 'decimal:4',
        'solded_amount' => 'decimal:4',
        'self_amount' => 'decimal:4',
    ];

    /**
     * The carports that belong to the user.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * The carports that belong to the day_power.
     */
    public function carport()
    {
        return $this->belongsTo(\App\Models\Carport::class);
    }

    /**
     * The file that belong to the day_power.
     */
    public function file()
    {
        return $this->belongsTo(\App\Models\File::class);
    }
}
