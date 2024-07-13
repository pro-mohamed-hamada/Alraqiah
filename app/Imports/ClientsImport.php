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

    // Add a constructor to accept the request
    public function __construct()
    {
        //
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $supervisor = User::where('phone', $row['supervisor_phone'])->first();
        $client = Client::create([
            'reservation_number'=> $row['reservation_number'],
            'package'=> $row['package'],
            'launch_date'=> Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['launch_date'])),
            'seat_number'=> $row['seat_number'],
            'gender'=> $row['gender'],
            'identity_number'=> $row['identity_number'],
            'country'=> $row['country'],
            'city'=> $row['incoming_city'],
            'chronic_disease' => isset($row['chronic_disease']) ? ActivationStatusEnum::ACTIVE:ActivationStatusEnum::NOT_ACTIVE,
            'chronic_disease_discription'=> $row['chronic_disease_discription'],
            'supervisor_id'=> $supervisor->id,
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
            'launch_date'=>function($attribute, $value, $onFailure) {
                $date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format('Y-m-d');
                if ($date < Carbon::now()->format('Y-m-d')) {
                     $onFailure(__('lang.launch_date_should_be_equal_or_greater_than: '.Carbon::now()->format('Y-m-d')));
                }
            },
            'seat_number'=>['required'],
            'gender'=>['required', 'string'],
            'identity_number'=>['required'],
            'country'=>['required', 'string'],
            'incoming_city'=>['required', 'string'],
            'supervisor_phone'=>['required', 'exists:users,phone'],
            'chronic_disease'=>['nullable', 'integer'],
            'chronic_disease_discription'=>['nullable', 'string'],
        ];
    }

    // public function headingRow(): int
    // {
    //     return 2;
    // }
}
