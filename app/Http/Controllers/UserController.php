<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use App\Traits\CaptureIpTrait;
use Carbon\Carbon;
use App\Models\ContractType;
use App\Models\Carport;
use App\Models\Fee;
use App\Models\Bill;
use App\Models\DayPower;
use App\Models\File;
use App\Models\Invoice;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportData;
use App\Exports\InvoiceExport;
use ZipArchive;
use DB;
use Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = Auth::user();

        $latestInvoices = [];
        $latestInvoiceData = [];
        $powerInvoices = [];
        
        $latestCSVFile = File::where('user_id', $currentUser->id)->orderBy('id','DESC')->first();
        
        if( $latestCSVFile !== null ) {
            $maxDate = "";
            $maxDateQuery = DayPower::query();
            $maxDateQuery->where('user_id', $currentUser->id)->where('file_id', $latestCSVFile->id);
            if( $currentUser->term->deadline == 30 ) {
                $maxDate = $maxDateQuery->max(DB::raw('DATE_ADD(measured_at, INTERVAL 1 MONTH)'));
            } else {
                $maxDate = $maxDateQuery->max(DB::raw('DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH)'));
            }

            $maxYear = Carbon::createFromFormat('Y-m-d', $maxDate)->format('Y');
            $maxMonth = Carbon::createFromFormat('Y-m-d', $maxDate)->format('n');

            $latestInvoicesQuery = DayPower::query();

            if( $maxYear && $maxMonth ) {
                if( $currentUser->term->deadline == 30 ) {
                    $latestInvoicesQuery->select('id', DB::raw('COUNT(id) AS count'), 'uuid', 'company', 'user_id', 'carport_id', 'file_id', DB::raw('SUM(used_amount) AS used_amount'), DB::raw('SUM(generated_amount) AS generated_amount'), DB::raw('SUM(purchased_amount) AS purchased_amount'), DB::raw('SUM(solded_amount) AS solded_amount'), DB::raw('SUM(self_amount) AS self_amount'), 'purchase_method', DB::raw('YEAR(DATE_ADD(measured_at, INTERVAL 1 MONTH)) AS year'), DB::raw('MONTH(DATE_ADD(measured_at, INTERVAL 1 MONTH)) AS month'))
                                        ->where('user_id', $currentUser->id)
                                        ->where('file_id', $latestCSVFile->id)
                                        ->where(DB::raw('YEAR(DATE_ADD(measured_at, INTERVAL 1 MONTH))'), $maxYear)
                                        ->where(DB::raw('MONTH(DATE_ADD(measured_at, INTERVAL 1 MONTH))'), $maxMonth)
                                        ->groupBy('file_id', 'uuid', DB::raw('MONTH(measured_at)'), DB::raw('YEAR(measured_at)'));
                } else {
                    $latestInvoicesQuery->select('id', DB::raw('COUNT(id) AS count'), 'uuid', 'company', 'user_id', 'carport_id', 'file_id', DB::raw('SUM(used_amount) AS used_amount'), DB::raw('SUM(generated_amount) AS generated_amount'), DB::raw('SUM(purchased_amount) AS purchased_amount'), DB::raw('SUM(solded_amount) AS solded_amount'), DB::raw('SUM(self_amount) AS self_amount'), 'purchase_method', DB::raw('YEAR(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH)) AS year'), DB::raw('MONTH(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH)) AS month'))
                                        ->where('user_id', $currentUser->id)
                                        ->where('file_id', $latestCSVFile->id)
                                        ->where(DB::raw('YEAR(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH))'), $maxYear)
                                        ->where(DB::raw('MONTH(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH))'), $maxMonth)
                                        ->groupBy('file_id', 'uuid', DB::raw('MONTH(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY))'), DB::raw('YEAR(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY))'));
                }
            }

            $latestInvoicesQuery->orderBy('file_id', 'DESC')
                                ->orderBy('year', 'DESC')
                                ->orderBy('month', 'DESC');

            $latestInvoices = $latestInvoicesQuery->get();

            $latestInvoiceData['label'] = $currentUser->term->get_invoice_label($maxYear, $maxMonth);
            $latestInvoiceData['period'] = $currentUser->term->get_invoice_period($maxYear, $maxMonth);
            $latestInvoiceData['count'] = 0;
            $latestInvoiceData['amount'] = 0.0;
            $latestInvoiceData['price'] = 0;
            $latestInvoiceUuids = [];

            foreach ($latestInvoices as $invoiceItem) {
                $latestInvoiceData['count'] += $invoiceItem->count;
                $latestInvoiceData['amount'] += $invoiceItem->used_amount;
                $latestInvoiceData['price'] += round( $invoiceItem->used_amount * $invoiceItem->carport->unit_price, 2 );
                $feeValueSum = 0.0;
                foreach( $invoiceItem->carport->fee->get_data() as $feeItem ) {
                    $feeValueSum += $feeItem->value;
                }
                $latestInvoiceData['price'] += $feeValueSum;

                $latestInvoiceUuids[] = $invoiceItem->user->id . '_' . $invoiceItem->file_id . '_' . $invoiceItem->carport_id . '_' . $invoiceItem->year . '_' . $invoiceItem->month;
            }

            $latestInvoiceData['uuidJson'] = json_encode( $latestInvoiceUuids );

            $powerInvoicesQuery = DayPower::query();

            if( $currentUser->term->deadline == 30 ) {
                $powerInvoicesQuery->select('id', DB::raw('COUNT(id) AS count'), 'uuid', 'company', 'user_id', 'carport_id', 'file_id', DB::raw('SUM(used_amount) AS used_amount'), DB::raw('SUM(generated_amount) AS generated_amount'), DB::raw('SUM(purchased_amount) AS purchased_amount'), DB::raw('SUM(solded_amount) AS solded_amount'), DB::raw('SUM(self_amount) AS self_amount'), 'purchase_method', DB::raw('YEAR(DATE_ADD(measured_at, INTERVAL 1 MONTH)) AS year'), DB::raw('MONTH(DATE_ADD(measured_at, INTERVAL 1 MONTH)) AS month'));
            } else {
                $powerInvoicesQuery->select('id', DB::raw('COUNT(id) AS count'), 'uuid', 'company', 'user_id', 'carport_id', 'file_id', DB::raw('SUM(used_amount) AS used_amount'), DB::raw('SUM(generated_amount) AS generated_amount'), DB::raw('SUM(purchased_amount) AS purchased_amount'), DB::raw('SUM(solded_amount) AS solded_amount'), DB::raw('SUM(self_amount) AS self_amount'), 'purchase_method', DB::raw('YEAR(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH))  AS year'), DB::raw('MONTH(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH)) AS month'));
            }

            if( $currentUser->term->deadline == 30 ) {
                $powerInvoicesQuery->groupBy('file_id', 'uuid', DB::raw('MONTH(measured_at)'), DB::raw('YEAR(measured_at)'));
            } else {
                $powerInvoicesQuery->groupBy('file_id', 'uuid', DB::raw('MONTH(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY))'), DB::raw('YEAR(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY))'));
            }

            $powerInvoicesQuery->orderBy('file_id', 'DESC')
                               ->orderBy('year', 'DESC')
                               ->orderBy('month', 'DESC');

            $powerInvoices = $powerInvoicesQuery->paginate(6);
        }

        return view('pages.user.home', compact('latestInvoiceData', 'powerInvoices'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function carportShow(Request $request)
    {
        $searchData = [
            'keyword' => $request->keyword,
            'contract_type_id' => $request->contract_type_id,
        ];

        $currentUser = Auth::user();
        $carportsQuery = Carport::query();
        
        if( $request->keyword ) {
            $keyword = $request->keyword;
            $carportsQuery->where('uuid', 'like', '%'.$keyword.'%')
                          ->orWhere('company', 'like', '%'.$keyword.'%')
                          ->orWhere('address', 'like', '%'.$keyword.'%');
        }

        if( $request->contract_type_id ) {
            $contract_type_id = (int)$request->contract_type_id;
            $carportsQuery->where('contract_type_id', $contract_type_id);
        }

        $carports = $carportsQuery->paginate(20);

        return view('pages.user.carport', compact('searchData', 'carports'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoiceShow(Request $request)
    {
        $searchData = [
            'keyword' => $request->keyword,
            'year' => $request->year,
            'month' => $request->month,
            'invoice_id' => $request->invoice_id,
        ];
        
        $currentUser = Auth::user();

        $maxYear = Carbon::now()->year;
        $maxMonth = Carbon::now()->month;

        $minDate = Carbon::now()->format('Y-m-d');

        $minDateQuery = DayPower::query();
        if( $currentUser->term->deadline == 30 ) {
            $minDate = $minDateQuery->min(DB::raw('DATE_ADD(measured_at, INTERVAL 1 MONTH)'));
        } else {
            $minDate = $minDateQuery->min(DB::raw('DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH)'));
        }

        $minYear = Carbon::createFromFormat('Y-m-d', $minDate)->format('Y');
        $minMonth = Carbon::createFromFormat('Y-m-d', $minDate)->format('m');

        $start = Carbon::create($minYear, $minMonth, 1);
        $end = Carbon::create($maxYear, $maxMonth, 1);

        $monthsDifference = $start->diffInMonths($end);

        $invoiceIDs[] = $start->format('Y-n');

        while ($start->lt($end)) {
            $start->addMonths(1);
            $invoiceIDs[] = $start->format('Y-n');
        }

        $invoiceIDs = array_reverse( $invoiceIDs );

        $selectedInvoiceID = $request->invoice_id ? $request->invoice_id : Carbon::now()->format('Y-n');

        $selectedYear = explode('-', $selectedInvoiceID)[0];
        $selectedMonth = explode('-', $selectedInvoiceID)[1];


        $mergedInvoiceIds = DayPower::query()->groupBy('uuid', 'user_id', 'carport_id', 'measured_at')->pluck('id')->toArray();

        $selectedInvoicesQuery = DayPower::query();

        if( $currentUser->term->deadline == 30 ) {
            $selectedInvoicesQuery->select('id', DB::raw('COUNT(id) AS count'), 'uuid', 'company', 'measured_at', 'user_id', 'carport_id', 'file_id', DB::raw('SUM(used_amount) AS used_amount'), DB::raw('SUM(generated_amount) AS generated_amount'), DB::raw('SUM(purchased_amount) AS purchased_amount'), DB::raw('SUM(solded_amount) AS solded_amount'), DB::raw('SUM(self_amount) AS self_amount'), 'purchase_method', DB::raw('YEAR(DATE_ADD(measured_at, INTERVAL 1 MONTH)) AS year'), DB::raw('MONTH(DATE_ADD(measured_at, INTERVAL 1 MONTH)) AS month'))
                                ->whereIn('id', $mergedInvoiceIds)
                                ->where('user_id', $currentUser->id)
                                ->where(DB::raw('YEAR(DATE_ADD(measured_at, INTERVAL 1 MONTH))'), $selectedYear)
                                ->where(DB::raw('MONTH(DATE_ADD(measured_at, INTERVAL 1 MONTH))'), $selectedMonth)
                                ->groupBy('uuid', 'carport_id', DB::raw('MONTH(measured_at)'), DB::raw('YEAR(measured_at)'));
        } else {
            $selectedInvoicesQuery->select('id', DB::raw('COUNT(id) AS count'), 'uuid', 'company', 'user_id', 'carport_id', 'file_id', DB::raw('SUM(used_amount) AS used_amount'), DB::raw('SUM(generated_amount) AS generated_amount'), DB::raw('SUM(purchased_amount) AS purchased_amount'), DB::raw('SUM(solded_amount) AS solded_amount'), DB::raw('SUM(self_amount) AS self_amount'), 'purchase_method', DB::raw('YEAR(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH)) AS year'), DB::raw('MONTH(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH)) AS month'))
                                ->whereIn('id', $mergedInvoiceIds)
                                ->where('user_id', $currentUser->id)
                                ->where(DB::raw('YEAR(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH))'), $selectedYear)
                                ->where(DB::raw('MONTH(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH))'), $selectedMonth)
                                ->groupBy('uuid', 'carport_id', DB::raw('MONTH(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY))'), DB::raw('YEAR(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY))'));
        }

        $selectedInvoicesQuery->orderBy('year', 'DESC')
                              ->orderBy('month', 'DESC');
        
        $selectedInvoices = $selectedInvoicesQuery->get();
        
        $tempTotalCount = 0;
        $tempTotalAmount = 0.0;
        $tempTotalUuids = [];
        $tempTotalPrice = 0.0;

        foreach ($selectedInvoices as $invoiceItem) {
            $tempTotalCount ++;
            $tempTotalAmount += $invoiceItem->used_amount;
            $tempTotalPrice += $invoiceItem->used_amount * $invoiceItem->carport->unit_price;
            foreach( $invoiceItem->carport->fee->get_data() as $feeItem ) {
                $tempTotalPrice += $feeItem->value;
            }
            $tempTotalUuids[] = $invoiceItem->user->id . '_' . $invoiceItem->file_id . '_' . $invoiceItem->carport_id . '_' . $invoiceItem->year . '_' . $invoiceItem->month;
        }

        $selectedInvoiceData['label'] = $currentUser->term->get_invoice_label($selectedYear, $selectedMonth);
        $selectedInvoiceData['period'] = $currentUser->term->get_invoice_period($selectedYear, $selectedMonth);
        $selectedInvoiceData['count'] = $tempTotalCount;
        $selectedInvoiceData['amount'] = $tempTotalAmount;
        $selectedInvoiceData['price'] = round($tempTotalPrice, 2);
        $selectedInvoiceData['uuidJson'] = json_encode( $tempTotalUuids );

        $powerInvoicesQuery = DayPower::query();

        if( $currentUser->term->deadline == 30 ) {
            $powerInvoicesQuery->select('id', DB::raw('COUNT(id) AS count'), 'uuid', 'company', 'user_id', 'carport_id', 'file_id', DB::raw('SUM(used_amount) AS used_amount'), DB::raw('SUM(generated_amount) AS generated_amount'), DB::raw('SUM(purchased_amount) AS purchased_amount'), DB::raw('SUM(solded_amount) AS solded_amount'), DB::raw('SUM(self_amount) AS self_amount'), 'purchase_method', DB::raw('YEAR(DATE_ADD(measured_at, INTERVAL 1 MONTH)) AS year'), DB::raw('MONTH(DATE_ADD(measured_at, INTERVAL 1 MONTH)) AS month'));
        } else {
            $powerInvoicesQuery->select('id', DB::raw('COUNT(id) AS count'), 'uuid', 'company', 'user_id', 'carport_id', 'file_id', DB::raw('SUM(used_amount) AS used_amount'), DB::raw('SUM(generated_amount) AS generated_amount'), DB::raw('SUM(purchased_amount) AS purchased_amount'), DB::raw('SUM(solded_amount) AS solded_amount'), DB::raw('SUM(self_amount) AS self_amount'), 'purchase_method', DB::raw('YEAR(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH))  AS year'), DB::raw('MONTH(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH)) AS month'));
        }

        $powerInvoicesQuery->whereIn('id', $mergedInvoiceIds);

        if($request->keyword) {
            $keyword = $request->keyword;
            $powerInvoicesQuery->where('uuid', 'like', '%'.$keyword.'%');
            $powerInvoicesQuery->orWhereHas('carport', function($query) use ($keyword) {
                $query->where('company', 'like', '%'.$keyword.'%')->orWhere('address', 'like', '%'.$keyword.'%');
            });
        }

        if( $request->year ) {
            $year = (int)$request->year;
            if( $currentUser->term->deadline == 30 ) {
                $powerInvoicesQuery->where(DB::raw('YEAR(DATE_ADD(measured_at, INTERVAL 1 MONTH))'), $year);
            } else {
                $powerInvoicesQuery->where(DB::raw('YEAR(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH))'), $year);
            }
        }

        if( $request->month ) {
            $month = (int)$request->month;
            if( $currentUser->term->deadline == 30 ) {
                $powerInvoicesQuery->where(DB::raw('MONTH(DATE_ADD(measured_at, INTERVAL 1 MONTH))'), $month);
            } else {
                $powerInvoicesQuery->where(DB::raw('MONTH(DATE_ADD(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY), INTERVAL 1 MONTH))'), $month);
            }
        }

        if( $currentUser->term->deadline == 30 ) {
            $powerInvoicesQuery->groupBy('uuid', 'carport_id', DB::raw('MONTH(measured_at)'), DB::raw('YEAR(measured_at)'));
        } else {
            $powerInvoicesQuery->groupBy('uuid', 'carport_id', DB::raw('MONTH(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY))'), DB::raw('YEAR(DATE_SUB(measured_at, INTERVAL ' . $currentUser->term->deadline . ' DAY))'));
        }

        $powerInvoicesQuery->orderBy('year', 'DESC')
                           ->orderBy('month', 'DESC');

        $powerInvoices = $powerInvoicesQuery->paginate(20);

        return view('pages.user.invoice', compact('invoiceIDs', 'searchData', 'selectedInvoiceData', 'powerInvoices'));
    }

    /**
     * Display a export data
     *
     * @return \Illuminate\Http\Response
     */
    public function powerInvoiceExport(Request $request)
    {
        $csvfile = $this->InvoiceCSVStore( $request );
        
        return response()->download(storage_path('app/' . $csvfile));
    }

    /**
     * Display a export data
     *
     * @return \Illuminate\Http\Response
     */
    public function InvoiceCSVStore($powerInvoiceData)
    {
        $data = [];
        $powerInvoice = $powerInvoiceData['powerData'];
        $invoiceComment = $powerInvoiceData['comment'];
        
        $billTotalPrice = 0;

        $firstRowData = [
            '20101',
            '請求書',
            '本文',
            '請求書',
            Carbon::create($powerInvoice->year, $powerInvoice->month)->format('n月請求分'),
            Carbon::create($powerInvoice->year, $powerInvoice->month)->lastOfMonth()->format('Y/m/d'),
            Carbon::create($powerInvoice->year, ($powerInvoice->month + 1))->lastOfMonth()->format('Y/m/d'),
            '',
            Carbon::create($powerInvoice->year, $powerInvoice->month)->lastOfMonth()->format('Y/m/d'),
            '御中',
            $powerInvoice->carport->bill->zipcode,
            $powerInvoice->carport->bill->name,
            $powerInvoice->carport->bill->address1,
            $powerInvoice->carport->bill->address2,
            $powerInvoice->carport->manager,
            $powerInvoice->user->zipcode,
            $powerInvoice->user->address1,
            $powerInvoice->user->address2,
            $powerInvoice->user->name,
            $invoiceComment,
            $powerInvoice->user->bank->name . ' ' . $powerInvoice->user->bank->branch . ' ' . $powerInvoice->user->bank->number,
            '内税',
            '自家消費電力',
            '¥'.$powerInvoice->carport->unit_price,
            $powerInvoice->used_amount,
            'kWh',
            '¥'.round( $powerInvoice->used_amount * $powerInvoice->carport->unit_price, 0 ),
            '',
        ];

        $billTotalPrice += round($powerInvoice->used_amount * $powerInvoice->carport->unit_price, 0);

        $data[] = $firstRowData;

        $billFeeData = $powerInvoice->carport->fee->get_data();

        foreach ($billFeeData as $feeData) {
            $rowData = [
                '20101',
                '請求書',
                '明細',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '内税',
                $feeData->name,
                '¥'.$feeData->value,
                '1',
                $feeData->unit,
                '¥'. $feeData->value,
                '',
            ];

            $data[] = $rowData;
            $billTotalPrice += (float)$feeData->value;
        }

        $lastRowData = [
            '20101',
            '請求書',
            '明細',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '内税',
            '総請求額',
            '',
            '',
            '',
            '¥'.round( $billTotalPrice, 0 ),
            '',
        ];
        $data[] = $lastRowData;

        $file_name = 'invoice_'.$powerInvoice->carport->uuid.'_'.date('Y-m-d').'_'.time().'.csv';

        Excel::store(new InvoiceExport($data), $file_name, '', \Maatwebsite\Excel\Excel::CSV);

        return $file_name;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function powerRegister()
    {
        $currentUser = Auth::user();
        $dayPowers = DayPower::where('user_id',$currentUser->id)->orderBy('id','desc')->paginate(20);
        $files = File::where('user_id', $currentUser->id)->orderBy('id','desc')->paginate(20);

        return view('pages.user.power-register', compact('files'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function carportStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'uuid' => 'required|max:255|unique:carports',
                'company' => 'required|max:255',
                'address' => 'required|max:255',
                'phone' => 'required|min:10',
                'email' => 'required|email|max:255',
                'manager' => 'required|max:255',
                'contract_type_id' => 'required',
                'started_at' => 'required|date_format:Y年m月d日|max:255',
                'unit_price' => 'required|max:255',
                'bill_name' => 'required|max:255',
                'bill_zipcode' => 'required|max:255',
                'bill_address1' => 'required|max:255',

            ],
            [
                'uuid.required' => trans('auth.CarportUuidRequired'),
                'uuid.unique' => trans('auth.CarportUuidTaken'),
                'company.required' => trans('auth.CarportCompanyRequired'),
                'address.required' => trans('auth.CarportAddressRequired'),
                'phone.required' => trans('auth.PhoneRequired'),
                'phone.min' => trans('auth.PhoneInvalid'),
                'email.required' => trans('auth.emailRequired'),
                'email.email' => trans('auth.emailInvalid'),
                'email.unique' => trans('auth.emailUnique'),
                'manager.required' => trans('auth.NameRequired'),
                'contract_type_id.required' => trans('auth.CarportTypeRequired'),
                'started_at.required' => trans('auth.StartedAtRequired'),
                'started_at.date_format' => trans('auth.StartedAtInvalid'),
                'unit_price.required' => trans('auth.UnitPriceRequired'),
                'bill_name.required' => trans('auth.BillNameRequired'),
                'bill_zipcode.required' => trans('auth.BillZipcodeRequired'),
                'bill_address1.required' => trans('auth.BillAddress1Required'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();

        $carport = Carport::create([
            'uuid' => $request->input('uuid'),
            'company' => $request->input('company'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'manager' => $request->input('manager'),
            'contract_type_id' => $request->input('contract_type_id'),
            'started_at' => Carbon::createFromFormat('Y年m月d日', $request->input('started_at'))->startOfDay()->format('Y-m-d H:i:s'),
            'registered_at' => Carbon::now(),
            'unit_price' => (float)$request->input('unit_price'),
            'user_id'=> Auth::user()->id,
            'signup_ip_address' => $ipAddress->getClientIp(),
        ]);

        $fee = new Fee();
        $fee_name_arr = $request->input('fee_name');
        $fee_unit_arr = $request->input('fee_unit');
        $fee_value_arr = $request->input('fee_value');
        $fee_comment = $request->input('fee_comment');
        $fee_arr = [];
        for ($i=0; $i < count($fee_name_arr); $i++) { 
            if( $fee_name_arr[$i] ) {
                $item = [
                    'name' => $fee_name_arr[$i],
                    'unit' => $fee_unit_arr[$i],
                    'value' => $fee_value_arr[$i] ? $fee_value_arr[$i] : 0,
                ];
                $fee_arr[] = $item;
            }
        }
        $fee->fill([
            'data' => json_encode( $fee_arr ),
            'comment' => $fee_comment
        ]);

        $carport->fee()->save($fee);

        $bill = new Bill();

        $bill_input = [
            'name' => $request->input('bill_name'),
            'zipcode' => $request->input('bill_zipcode'),
            'address1' => $request->input('bill_address1'),
            'address2' => $request->input('bill_address2'),
        ];

        $bill->fill( $bill_input );

        $carport->bill()->save($bill);

        $carport->activated = 1;
        $carport->save();

        return redirect('carport')->with('success', trans('usersmanagement.alerts.createSuccess'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dropzoneStore(Request $request)
    {

        $data = [];

        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required|mimes:csv,txt|max:5120',
            ],
            [
                'file.required' => trans('power.messages.fileRequired'),
                'file.mimes' => trans('power.messages.fileMimes'),
                'file.max' => trans('power.messages.fileMax'),
            ]
        );

        if ($validator->fails()) {
            $data['success'] = false;
            $data['error'] = $validator->errors()->first('file');
        } else {
            if($request->file('file')) {
                $file = $request->file('file');
                $filename = time().'_'.$file->getClientOriginalName();

                // File upload location
                $location = public_path('uploads/');

                // Upload file
                $file->move($location, $filename);

                

                $file = new File();
                $file->name = $filename;
                $file->path = 'uploads/' . $filename;
                $file->user_id = Auth::user()->id;
                $file->uploaded_at = Carbon::now();
                $file->save();

                try {
                    Excel::import(new ImportData($file->id ), $location.$filename);

                    // Response
                    $data['success'] = true;
                    $data['message'] = '正常にアップロードされました!';
                    $data['data'] = $file;
                } catch (\Exception $e) {

                    $file->delete();

                    // Response
                    $data['success'] = false;
                    $data['message'] = $e;
                }

            } else {
                // Response
                $data['success'] = false;
                $data['message'] = 'ファイルがアップロードされていません。'; 
            }
        }

        return response()->json([
            json_encode($data),
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function carportUpdate(Request $request, $id)
    {
        $carport = Carport::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'uuid' => 'required|max:255|unique:carports,uuid,' . $carport->id,
                'company' => 'required|max:255',
                'address' => 'required|max:255',
                'phone' => 'required|min:10',
                'email' => 'required|email|max:255',
                'manager' => 'required|max:255',
                'contract_type_id' => 'required',
                'unit_price' => 'required|max:255',
                'bill_name' => 'required|max:255',
                'bill_zipcode' => 'required|max:255',
                'bill_address1' => 'required|max:255',
            ],
            [
                'uuid.required' => trans('auth.CarportUuidRequired'),
                'uuid.unique' => trans('auth.CarportUuidTaken'),
                'company.required' => trans('auth.CarportCompanyRequired'),
                'address.required' => trans('auth.CarportAddressRequired'),
                'phone.required' => trans('auth.PhoneRequired'),
                'phone.min' => trans('auth.PhoneInvalid'),
                'email.required' => trans('auth.emailRequired'),
                'email.email' => trans('auth.emailInvalid'),
                'email.unique' => trans('auth.emailUnique'),
                'manager.required' => trans('auth.NameRequired'),
                'contract_type_id.required' => trans('auth.CarportTypeRequired'),
                'unit_price.required' => trans('auth.UnitPriceRequired'),
                'bill_name.required' => trans('auth.BillNameRequired'),
                'bill_zipcode.required' => trans('auth.BillZipcodeRequired'),
                'bill_address1.required' => trans('auth.BillAddress1Required'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();

        $carport->update([
            'uuid' => $request->input('uuid'),
            'company' => $request->input('company'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'manager' => $request->input('manager'),
            'contract_type_id' => $request->input('contract_type_id'),
            'unit_price' => (float)$request->input('unit_price'),
            'user_id'=> Auth::user()->id,
            'updated_ip_address' => $ipAddress->getClientIp(),
        ]);

        $fee_name_arr = $request->input('fee_name');
        $fee_unit_arr = $request->input('fee_unit');
        $fee_value_arr = $request->input('fee_value');
        $fee_comment = $request->input('fee_comment');
        $fee_arr = [];
        for ($i=0; $i < count($fee_name_arr); $i++) { 
            if( $fee_name_arr[$i] ) {
                $item = [
                    'name' => $fee_name_arr[$i],
                    'unit' => $fee_unit_arr[$i],
                    'value' => $fee_value_arr[$i] ? $fee_value_arr[$i] : 0,
                ];
                $fee_arr[] = $item;
            }
        }

        $fill_input = [
            'data' => json_encode( $fee_arr ),
            'comment' => $fee_comment
        ];

        if ($carport->fee === null) {
            $fee = new Fee();
            $fee->fill($fill_input);
            $carport->fee()->save($fee);
        } else {
            $carport->fee->fill($fill_input)->save();
        }

        $bill_input = [
            'name' => $request->input('bill_name'),
            'zipcode' => $request->input('bill_zipcode'),
            'address1' => $request->input('bill_address1'),
            'address2' => $request->input('bill_address2'),
        ];

        if ($carport->bill === null) {
            $bill = new Bill();
            $bill->fill($bill_input);
            $carport->bill()->save($bill);
        } else {
            $carport->bill->fill($bill_input)->save();
        }

        return redirect('carport')->with('success', trans('usersmanagement.alerts.updateSuccess'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invoiceUpdate(Request $request)
    {
        $uuid = $request->uuid;
        
        $invoice = Invoice::updateOrCreate(
            ['uuid' => $uuid],
            [
                'year' => $request->year,
                'month' => $request->month,
                'user_id' => $request->user_id,
                'file_id' => $request->file_id,
                'carport_id' => $request->carport_id,
                'comment' => $request->comment,
            ]
        );

        return redirect('invoice')->with('success', trans('usersmanagement.alerts.updateSuccess'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invoiceDownload($uuid)
    {
        $params = explode('_', $uuid);
        $invoice = Invoice::updateOrCreate(
            ['uuid' => $uuid],
            [
                'year' => $params[3],
                'month' => $params[4],
                'user_id' => $params[0],
                'file_id' => $params[1],
                'carport_id' => $params[2]
            ]
        );

        $powerInvoice = $invoice->get_data();

        $filename = $this->InvoiceCSVStore( $powerInvoice );

        return response()->download(storage_path('app/' . $filename));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invoiceZipfile(Request $request)
    {
        $uuidJson = $request->uuidsJson;
        $uuids = json_decode( $uuidJson );

        $data = [];

        foreach ($uuids as $uuid) {
            $params = explode('_', $uuid);
            $invoice = Invoice::updateOrCreate(
                ['uuid' => $uuid],
                [
                    'year' => $params[3],
                    'month' => $params[4],
                    'user_id' => $params[0],
                    'file_id' => $params[1],
                    'carport_id' => $params[2]
                ]
            );
            $powerInvoiceData = $invoice->get_data();
            
            $powerInvoice = $powerInvoiceData['powerData'];
            $invoiceComment = $powerInvoiceData['comment'];
            
            $billTotalPrice = 0;

            $firstRowData = [
                '20101',
                '請求書',
                '本文',
                '請求書',
                Carbon::create($powerInvoice->year, $powerInvoice->month)->format('n月請求分'),
                Carbon::create($powerInvoice->year, $powerInvoice->month)->lastOfMonth()->format('Y/m/d'),
                Carbon::create($powerInvoice->year, ($powerInvoice->month + 1))->lastOfMonth()->format('Y/m/d'),
                '',
                Carbon::create($powerInvoice->year, $powerInvoice->month)->lastOfMonth()->format('Y/m/d'),
                '御中',
                $powerInvoice->carport->bill->zipcode,
                $powerInvoice->carport->bill->name,
                $powerInvoice->carport->bill->address1,
                $powerInvoice->carport->bill->address2,
                $powerInvoice->carport->manager,
                $powerInvoice->user->zipcode,
                $powerInvoice->user->address1,
                $powerInvoice->user->address2,
                $powerInvoice->user->name,
                $invoiceComment,
                $powerInvoice->user->bank->name . ' ' . $powerInvoice->user->bank->branch . ' ' . $powerInvoice->user->bank->number,
                '内税',
                '自家消費電力',
                '¥'.$powerInvoice->carport->unit_price,
                $powerInvoice->used_amount,
                'kWh',
                '¥'.round( $powerInvoice->used_amount * $powerInvoice->carport->unit_price, 0 ),
                '',
            ];

            $billTotalPrice += round($powerInvoice->used_amount * $powerInvoice->carport->unit_price, 0);

            $data[] = $firstRowData;

            $billFeeData = $powerInvoice->carport->fee->get_data();

            foreach ($billFeeData as $feeData) {
                $rowData = [
                    '20101',
                    '請求書',
                    '明細',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '内税',
                    $feeData->name,
                    '¥'.$feeData->value,
                    '1',
                    $feeData->unit,
                    '¥'. $feeData->value,
                    '',
                ];

                $data[] = $rowData;
                $billTotalPrice += (float)$feeData->value;
            }

            $lastRowData = [
                '20101',
                '請求書',
                '明細',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '内税',
                '総請求額',
                '',
                '',
                '',
                '¥'.round( $billTotalPrice, 0 ),
                '',
            ];

            $data[] = $lastRowData;

        }

        $file_name = 'invoice('.$params[3].'-'.$params[4].')_'.date('Y-m-d').'_'.time().'.csv';

        Excel::store(new InvoiceExport($data), $file_name, '', \Maatwebsite\Excel\Excel::CSV);

        return response()->download(storage_path('app/' . $file_name));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxCarportShow(Request $request)
    {
        if( $request->input('id') ) {
            $carport_id = $request->input('id');
            $carport = Carport::findOrFail($carport_id);
            return view('modals.carport-detail-template', compact('carport'));
        }
        return "";
    }

    /**
     * Method to search the users.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchCarports(Request $request)
    {
        $keyword = $request->input('keyword');
        $contract_type_id = $request->input('contract_type_id');

        $carports_query = Carport::query();

        if( !empty( $keyword ) ) {
            $carports_query->where('uuid', 'like', '%'.$keyword.'%')
                            ->orWhere('company', 'like', '%'.$keyword.'%')
                            ->orWhere('address', 'like', '%'.$keyword.'%');
        }

        if( !empty( $contract_type_id ) ) {
            $carports_query->where('contract_type_id', $contract_type_id);
        }

        $results = $carports_query->get();

        // Attach roles to results
        foreach ($results as $result) {
            $contract_type = [
                'contract_type' => $result->contract_type,
            ];
            $result->push($contract_type);
        }

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}