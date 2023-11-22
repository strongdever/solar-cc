<?php

namespace App\Imports;

use App\Models\DayPower;
use App\Models\Carport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Carbon\Carbon;
use Auth;

class ImportData implements ToModel, WithStartRow, WithCustomCsvSettings
{
    protected $file_id;

    public function __construct(int $file_id) 
    {
        $this->file_id = $file_id;
    }

    /**
	 * @return int
	 */
	public function startRow(): int {
        return 2;
	}
	
	/**
	 * @return array
	 */
	public function getCsvSettings(): array {
        return [
            'delimiter' => ',',
            'contiguous' => false,
            'input_encoding' => 'SJIS',
        ];
	}

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $dataRow = [];
        $count = 0;
        for ($i=0; $i < 12; $i++) { 
            if(strpos($row[$i], ',') !== false) {
                foreach( explode(',', $row[$i]) as $sub ) {
                    $dataRow[$count] = trim( $sub );
                    $count ++;
                }
            } else {
                $dataRow[$count] = trim( $row[$i] );
                $count ++;
            }
            if( $count > 11 ) {
                break;
            }
        }

        $uuid = str_replace("'", "", trim($dataRow[0]));

        $carport = Carport::where('uuid', 'like', '%'.$uuid.'%')->where('user_id', Auth::user()->id)->firstOrFail();

        $carport_id = null;

        if( $carport == null ) {
        } else {
            $carport_id = $carport->id;
        }

        return new DayPower([
            'uuid' => $uuid,
            'company' => $dataRow[1],
            'sensor_number' => $dataRow[2],
            'sensor_id' => $dataRow[3],
            'prefecture' => $dataRow[4],
            'measured_at' => Carbon::createFromFormat('Y/m/d', $dataRow[5])->format('Y-m-d'),
            'used_amount' => $dataRow[6],
            'generated_amount' => $dataRow[7],
            'purchased_amount' => $dataRow[8],
            'solded_amount' => $dataRow[9],
            'self_amount' => $dataRow[10],
            'purchase_method' => $dataRow[11],
            'user_id' => Auth::user()->id,
            'carport_id' => $carport_id,
            'file_id' => $this->file_id,
        ]);
    }
	
}
