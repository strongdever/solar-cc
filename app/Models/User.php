<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use HasRoleAndPermission;
    use Notifiable;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
        'password',
        'remember_token',
        'activated',
        'token',
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
        'name',
        'company',
        'zipcode',
        'address1',
        'address2',
        'phone',
        'email',
        'password',
        'activated',
        'token',
        'signup_ip_address',
        'signup_confirmation_ip_address',
        'signup_sm_ip_address',
        'admin_ip_address',
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
        'name'                              => 'string',
        'company'                           => 'string',
        'address'                           => 'string',
        'phone'                             => 'string',
        'email'                             => 'string',
        'password'                          => 'string',
        'activated'                         => 'boolean',
        'token'                             => 'string',
        'signup_ip_address'                 => 'string',
        'signup_confirmation_ip_address'    => 'string',
        'signup_sm_ip_address'              => 'string',
        'admin_ip_address'                  => 'string',
        'updated_ip_address'                => 'string',
        'deleted_ip_address'                => 'string',
    ];

    /**
     * Get the socials for the user.
     */
    public function social()
    {
        return $this->hasMany(\App\Models\Social::class);
    }

    /**
     * The carports with the user.
     */
    public function carports()
    {
        return $this->hasMany(\App\Models\Carport::class);
    }

    /**
     * The day_powers with the user.
     */
    public function day_powers()
    {
        return $this->hasMany(\App\Models\DayPower::class);
    }

    /**
     * The invoices with the user.
     */
    public function invoices()
    {
        return $this->hasMany(\App\Models\Invoice::class);
    }

    /**
     * The profiles that belong to the user.
     */
    public function profiles()
    {
        return $this->belongsToMany(\App\Models\Profile::class)->withTimestamps();
    }

    /**
     * Check if a user has a profile.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasProfile($name)
    {
        foreach ($this->profiles as $profile) {
            if ($profile->name === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add/Attach a profile to a user.
     *
     * @param  Profile  $profile
     */
    public function assignProfile(Profile $profile)
    {
        return $this->profiles()->attach($profile);
    }

    /**
     * Remove/Detach a profile to a user.
     *
     * @param  Profile  $profile
     */
    public function removeProfile(Profile $profile)
    {
        return $this->profiles()->detach($profile);
    }

    /**
     * Get the term associated with the user.
     */
    public function term()
    {
        return $this->hasOne(\App\Models\Term::class);
    }

    /**
     * The terms that belong to the user.
     */
    public function terms()
    {
        return $this->belongsToMany(\App\Models\Term::class)->withTimestamps();
    }

    /**
     * Check if a user has a term.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasTerm($name)
    {
        foreach ($this->terms as $term) {
            if ($term->name === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add/Attach a term to a user.
     *
     * @param  Term  $term
     */
    public function assignTerm(Term $term)
    {
        return $this->terms()->attach($term);
    }

    /**
     * Remove/Detach a term to a user.
     *
     * @param  Term  $term
     */
    public function removeTerm(Term $term)
    {
        return $this->terms()->detach($term);
    }

    /**
     * Get the bank associated with the user.
     */
    public function bank()
    {
        return $this->hasOne(\App\Models\Bank::class);
    }

    /**
     * The banks that belong to the user.
     */
    public function banks()
    {
        return $this->belongsToMany(\App\Models\Bank::class)->withTimestamps();
    }

    /**
     * Check if a user has a bank.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasBank($name)
    {
        foreach ($this->banks as $bank) {
            if ($bank->name === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add/Attach a bank to a user.
     *
     * @param  Bank  $bank
     */
    public function assignBank(Bank $bank)
    {
        return $this->banks()->attach($bank);
    }

    /**
     * Remove/Detach a bank to a user.
     *
     * @param  Bank  $bank
     */
    public function removeBank(Bank $bank)
    {
        return $this->banks()->detach($bank);
    }
}
