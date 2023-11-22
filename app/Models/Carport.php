<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carport extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'carports';

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
    protected $hidden = [
        'activated'
    ];

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
        'address',
        'phone',
        'email',
        'manager',
        'contract_type_id',
        'unit_price',
        'user_id',
        'activated',
        'registered_at',
        'started_at',
        'signup_ip_address',
        'updated_ip_address',
        'deleted_ip_address',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                                => 'integer',
        'uuid'                              => 'string',
        'company'                           => 'string',
        'address'                           => 'string',
        'phone'                             => 'string',
        'email'                             => 'string',
        'manager'                           => 'string',
        'unit_price'                        => 'decimal:2',
        'activated'                         => 'boolean',
        'signup_ip_address'                 => 'string',
        'updated_ip_address'                => 'string',
        'deleted_ip_address'                => 'string',
        'registered_at'                     => 'datetime',
        'started_at'                        => 'datetime',
    ];

    /**
     * The carports that belong to the user.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * The carports that belong to the contract_type.
     */
    public function contract_type()
    {
        return $this->belongsTo(\App\Models\ContractType::class);
    }

    /**
     * The day_powers with the carport.
     */
    public function day_powers()
    {
        return $this->hasMany(\App\Models\DayPower::class);
    }

    /**
     * Get the fee associated with the carport.
     */
    public function fee()
    {
        return $this->hasOne(\App\Models\Fee::class);
    }

    /**
     * The fees that belong to the carports.
     */
    public function fees()
    {
        return $this->belongsToMany(\App\Models\Fee::class)->withTimestamps();
    }

    /**
     * Check if a carports has a fee.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasFee($name)
    {
        foreach ($this->fees as $fee) {
            if ($fee->name === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add/Attach a fee to a carport.
     *
     * @param  Fee  $fee
     */
    public function assignFee(Fee $fee)
    {
        return $this->fees()->attach($fee);
    }

    /**
     * Remove/Detach a fee to a carport.
     *
     * @param  Fee  $fee
     */
    public function removeFee(Fee $fee)
    {
        return $this->fees()->detach($fee);
    }


    /**
     * Get the bill associated with the carport.
     */
    public function bill()
    {
        return $this->hasOne(\App\Models\Bill::class);
    }

    /**
     * The bills that belong to the carports.
     */
    public function Bills()
    {
        return $this->belongsToMany(\App\Models\Bill::class)->withTimestamps();
    }

    /**
     * Check if a carports has a bill.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasBill($name)
    {
        foreach ($this->bills as $bill) {
            if ($bill->name === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add/Attach a bill to a carport.
     *
     * @param  Bill  $bill
     */
    public function assignBill(Bill $bill)
    {
        return $this->bills()->attach($bill);
    }

    /**
     * Remove/Detach a bill to a carport.
     *
     * @param  Bill  $bill
     */
    public function removeBill(Bill $bill)
    {
        return $this->bills()->detach($bill);
    }
}
