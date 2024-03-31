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

class UsersImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow
{

    // Add a constructor to accept the request
    public function __construct(private array $permissions)
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
         $user = User::create([
            'name'=> $row['name'],
            'email'=> $row['email'],
            'phone'=> $row['phone'],
            'password'=> "123456",
            'type'=> UserTypeEnum::SUPERVISOR,
            'is_active'=> ActivationStatusEnum::ACTIVE,
        ]);

        if (!$user)
            return null;
        $user->givePermissionTo($this->permissions);

        return $user;
        
    }

    public function rules(): array
    {
        return [
            'name'=>['required', 'string'],
            'email'=>['required', 'email', 'unique:users,email'],
            'phone'=>['required', 'unique:users,phone'],
        ];
    }

}
