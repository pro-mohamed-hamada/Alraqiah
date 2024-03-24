<?php

namespace App\Imports;

use App\Enum\ActivationStatusEnum;
use App\Enum\UserTypeEnum;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class ClientsImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow
{

    protected $supervisor_id;

    // Add a constructor to accept the request
    public function __construct(int $supervisor_id)
    {
        $this->supervisor_id = $supervisor_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $client = Client::create([
            'reservation_number'=> $row['reservation_number'],
            'package'=> $row['package'],
            'launch_date'=> Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['launch_date'])),
            'seat_number'=> $row['seat_number'],
            'gender'=> $row['gender'],
            'identity_number'=> $row['identity_number'],
            'country'=> $row['country'],
            'city'=> $row['incoming_city'],
            'supervisor_id'=> $this->supervisor_id,
         ]);
         $client->user()->create([
            'name'=> $row['name'],
            'phone'=> $row['phone'],
            'password'=> "123456",
            'type'=> UserTypeEnum::CLIENT,
            'is_active'=> ActivationStatusEnum::ACTIVE,
        ]);

        return $client;
        
    }

    public function rules(): array
    {
        return [
            'name'=>['required', 'string'],
            'phone'=>['required', 'unique:users,phone'],
            'reservation_number'=>['required', 'integer'],
            'package'=>['required'],
            'launch_date'=>['required'],
            'seat_number'=>['required'],
            'gender'=>['required', 'string'],
            'identity_number'=>['required'],
            'country'=>['required', 'string'],
            'incoming_city'=>['required', 'string'],
        ];
    }

    // public function headingRow(): int
    // {
    //     return 2;
    // }
}
