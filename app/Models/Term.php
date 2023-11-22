<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Term extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'terms';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'deadline',
        'comment',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deadline' => 'integer'
    ];

    public function get_start_date( $year, $month) {
        $year = (int)$year;
        $month = (int)$month;
        $day = $this->deadline;
        if( $day == 30 ) {
            return Carbon::create($year, $month)->startOfMonth()->format('Y-m-d');
        } else {
            return Carbon::create($year, ($month - 1), ( $day + 1) )->format('Y-m-d');
        }
    }

    public function get_end_date( $year, $month) {
        $year = (int)$year;
        $month = (int)$month;
        $day = $this->deadline;
        if( $day == 30 ) {
            return Carbon::create($year, $month)->lastOfMonth()->format('Y-m-d');
        } else {
            return Carbon::create($year, $month, $day )->format('Y-m-d');
        }
    }

    public function get_invoice_period( $year, $month) {
        $year = (int)$year;
        $month = (int)$month;
        $day = $this->deadline;
        if( $day == 30 ) {
            return Carbon::create($year, $month)->startOfMonth()->format('Y年m月d日') . '～' . Carbon::create($year, $month)->lastOfMonth()->format('Y年m月d日');
        } else {
            return Carbon::create($year, ($month - 1), ( $day + 1) )->format('Y年m月d日') . '～' . Carbon::create($year, $month, $day )->format('Y年m月d日');
        }
    }

    public function get_invoice_label( $year, $month) {
        $year = (int)$year;
        $month = (int)$month;
        $day = $this->deadline;
        return Carbon::create($year, $month)->format('Y年n月分');
    }

    
    public function get_bill_label( $year, $month) {
        $year = (int)$year;
        $month = (int)$month;
        $day = $this->deadline;
        return Carbon::create($year, $month)->format('n月請求分');
    }

    /**
     * A profile belongs to a user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
