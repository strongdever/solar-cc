<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class InvoiceExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    protected $data;

    /**
     * Write code on Method
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    
	/**
	 * @return array
	 */
	public function getCsvSettings(): array {

        return [
            'delimiter' => ',',
            'enclosure' => '"',
            'output_encoding' => 'SJIS',
            'line_ending' => PHP_EOL,
            'include_separator_line' => false,
            'excel_compatibility' => false,
        ];
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }

    
	/**
	 * @return array
	 */
	public function headings(): array {
        return [
            'csv_type(変更不可)',
            '書類種別',
            '行形式',
            '件名',
            '概要',
            '発行日',
            '期限',
            '番号',
            '計上日',
            '取引先敬称',
            '取引先郵便番号',
            '取引先名称',
            '取引先住所1',
            '取引先住所2',
            '取引先担当者氏名',
            '発行元郵便番号',
            '発行元住所1',
            '発行元住所2',
            '発行元担当者氏名',
            '備考',
            '振込先',
            '内税/外税',
            '品名',
            '単価',
            '数量',
            '単位',
            '金額',
            '消費税'
        ];
	}

}
