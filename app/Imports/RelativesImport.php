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

class RelativesImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow
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
        $user = User::where('phone', $row['phone'])->first();
        if(!$user)
            return null;
        $client = $user->client;
        if(!$client)
            return null;
        $relative = $client->relatives()->create([
            'name'=> $row['name'],
            'gender'=> $row['gender'],
            'identity_number'=> $row['identity_number'],
            'seat_number'=> $row['seat_number'],
            'country'=> $row['country'],
            'city'=> $row['incoming_city'],
            'chronic_disease' => isset($row['chronic_disease']) ? ActivationStatusEnum::ACTIVE:ActivationStatusEnum::NOT_ACTIVE,
            'chronic_disease_discription'=> $row['chronic_disease_discription'],
            'client_id'=> $client->id,
         ]);

        return $relative;

    }

    public function rules(): array
    {
        return [
            'name'=>['required', 'string'],
            'phone'=>['required', 'exists:users,phone'],
            'seat_number'=>['required'],
            'gender'=>['required', 'string'],
            'identity_number'=>['required'],
            'country'=>['required', 'string'],
            'incoming_city'=>['required', 'string'],
            'chronic_disease'=>['nullable', 'integer'],
            'chronic_disease_discription'=>['nullable', 'string'],
        ];
    }

}
