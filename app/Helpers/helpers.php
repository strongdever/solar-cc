<?php

use Carbon\Carbon;
use App\Models\Carport;
use App\Models\ContractType;
use App\Models\Invoice;

if( !function_exists( 'get_new_carport_uuid' ) ) {
    function get_new_carport_uuid() {
        $carportItem = Carport::max('uuid');
        if( $carportItem ) {
            return $carportItem + 1;
        }
        return 10000;
    }
}

if( !function_exists( 'get_carports_uuids' ) ) {
    function get_carports_uuids() {
        $carports = Carport::all();
        $uuids = [];
        if( count( $carports ) ) {
            foreach ( $carports as $carport ) {
                $uuids[] = $carport->uuid;
            }
        }
        return $uuids;
    }
}

if( !function_exists( 'get_invoice_comment' ) ) {
    function get_invoice_comment( $uuid ) {
        $invoice = Invoice::where('uuid', $uuid)->first();
        if( $invoice !== null ) {
            return $invoice->comment;
        }
        return "";
    }
}

if( !function_exists( 'get_carport_types' ) ) {
    function get_carport_types() {
        $carport_types = ContractType::all();
        return $carport_types;
    }
}

if( !function_exists( 'get_invoice_label' ) ) {
    function get_invoice_label($year, $month) {
        return Carbon::create($year, $month)->format('Y年n月分');
    }
}

if( !function_exists( 'create_year_format' ) ) {
    function create_year_format($year) {
        return Carbon::create($year)->format('Y年');
    }
}

if( !function_exists( 'create_month_format' ) ) {
    function create_month_format($month) {
        return Carbon::create($month)->format('m月');
    }
}

if( !function_exists( 'invoice_label_format' ) ) {
    function invoice_label_format($year, $month) {
        return Carbon::create($year, $month)->format('n月請求分');
    }
}

if( !function_exists( 'invoice_date_format' ) ) {
    function invoice_date_format($year, $month) {
        return Carbon::create($year, $month)->lastOfMonth()->format('Y/m/d');
    }
}