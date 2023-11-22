<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DayPower;
use App\Models\User;
use DB;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';

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
        'year',
        'month',
        'user_id',
        'carport_id',
        'file_id',
        'comment',
    ];

    public function get_data() {
        $uuid = $this->uuid;
        $params = explode('_', $uuid);
        $user_id = $params[0];
        $file_id = $params[1];
        $carport_id = $params[2];
        $year = $params[3];
        $month = $params[4];

        $currentUser = User::findOrFail($user_id);

        $powerInvoicesQuery = DayPower::query();

        if( $currentUser->term->deadline == 30 ) {
            $powerInvoicesQuery->select('id', DB::raw('COUNT(id) AS count'), 'uuid', 'company', 'user_id', 'carport_id', 'file_id', DB::raw('SUM(used_amount) AS used_amount'), DB::raw('SUM(generated_amount) AS generated_amount'), DB::raw('SUM(purchased_amount) AS purchased_amount'), DB::raw('SUM(solded_amount) AS solded_amount'), DB::raw('SUM(self_amount) AS self_amount'), 'purchase_method', DB::raw('YEAR(DATE_ADD(measured_at, INTERVAL 1 MONTH)) AS year'), DB::raw('MONTH(DATE_ADD(measured_at, INTERVAL 1 MONTH)) AS month'))
                               ->where('user_id', $currentUser->id)
                               ->where('file_id', $file_id)
                               ->where('carport_id', $carport_id)
                               ->where(DB::raw('YEAR(DATE_ADD(measured_at, INTERVAL 1 MONTH))'), $year)
                               ->where(DB::raw('MONTH(DATE_ADD(measured_at, INTERVAL 1 MONTH))'), $month)
                               ->groupBy('file_id', 'uuid', DB::raw('MONTH(measured_at)'), DB::raw('YEAR(measured_at)'));
        } else {
            $powerInvoicesQuery->select('id', DB::raw('COUNT(id) AS count'), 'uuid', 'company', 'user_id', 'carport_id', 'file_id', DB::raw('SUM(used_amount) AS used_amount'), DB::raw('SUM(generated_amount) AS generated_amount'), DB::raw('SUM(purchased_amount) AS purchased_amount'), DB::raw('SUM(solded_amount) AS solded_amount'), DB::raw('SUM(self_amount) AS self_amount'), 'purchase_method', DB::raw('YEAR(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH))  AS year'), DB::raw('MONTH(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH)) AS month'))
                               ->where('user_id', $currentUser->id)
                               ->where('file_id', $file_id)
                               ->where('carport_id', $carport_id)
                               ->where(DB::raw('YEAR(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH))'), $year)
                               ->where(DB::raw('MONTH(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH))'), $month)
                               ->groupBy('file_id', 'uuid', DB::raw('MONTH(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY))'), DB::raw('YEAR(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY))'));
        }

        $powerInvoicesQuery->orderBy('file_id', 'DESC')
                           ->orderBy('year', 'DESC')
                           ->orderBy('month', 'DESC');

        $powerInvoice = $powerInvoicesQuery->first();

        $invoiceData = [
            'powerData' => $powerInvoice,
            'comment' => preg_replace("/\r|\n/", "", $this->comment),
        ];
        
        return $invoiceData;
    }

    /**
     * The user that belong to the fee.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * The carport that belong to the fee.
     */
    public function carport()
    {
        return $this->belongsTo(\App\Models\Carport::class);
    }

    /**
     * The carport that belong to the fee.
     */
    public function file()
    {
        return $this->belongsTo(\App\Models\File::class);
    }
}
