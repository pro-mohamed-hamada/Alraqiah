<?php

namespace App\Services;

use App\Enum\ActivationStatusEnum;
use App\Enum\ClientStatusEnum;
use App\Enum\UserTypeEnum;
use App\Exceptions\NotFoundException;
use App\Models\Client;
use App\QueryFilters\ClientsFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\BadRequestHttpException;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ClientService extends BaseService
{
    public function __construct(private Client $model){

    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function queryGet(array $filters = [] , array $withRelations = []) :builder
    {
        $clients = $this->getModel()->query()->with($withRelations);
        return $clients->filter(new ClientsFilter($filters));
    }

    public function getAll(array $filters = [] , array $withRelations =[], $perPage = 10 ): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function store(array $data = []):Client|Model|bool
    {
        DB::beginTransaction();
        $clientData = $this->prepareClientData(data: $data);
        $client = $this->getModel()->create($clientData);

        // $userData['client_id'] = $client['id'];
        $userData = $this->prepareUserData(data: $data);
        $user = $client->user()->create($userData);
        $relativesData = $this->prepareRelativesData(data: $data);
        $client->relatives()->createMany($relativesData);

        if(isset($data['sites']))
            $client->sites()->sync($data['sites']);
        DB::commit();
        return $client;

    } //end of store

    private function prepareUserData(array $data): array
    {
        $userData['name'] = $data['name'];
        $userData['phone'] = $data['phone'];
        $userData['password'] = "123456";
        $userData['type'] = UserTypeEnum::CLIENT;
        $userData['is_active'] = ActivationStatusEnum::ACTIVE;

        return $userData;
    }

    private function prepareClientData(array $data): array
    {
        $clientData['chronic_disease'] = isset($data['chronic_disease']) ? ActivationStatusEnum::ACTIVE:ActivationStatusEnum::NOT_ACTIVE;
        $clientData['chronic_disease_discription'] = $data['chronic_disease_discription'];
        $clientData['reservation_number'] = $data['reservation_number'];
        $clientData['package'] = $data['package'];
        $clientData['launch_date'] = $data['launch_date'];
        $clientData['seat_number'] = $data['seat_number'];
        $clientData['gender'] = $data['gender'];
        $clientData['identity_number'] = $data['identity_number'];
        $clientData['country'] = $data['country'];
        $clientData['city'] = $data['city'];
        $clientData['supervisor_id'] = $data['supervisor_id'];
        return $clientData;
    }

    private function prepareRelativesData(array $data): array
    {
        $relativesData = [];
        if(isset($data['relatives_name']))
            for($i = 0; $i< count($data['relatives_name']); $i++)
            {
                $relativesData[$i]['name'] = $data['relatives_name'][$i];
                $relativesData[$i]['gender'] = $data['relatives_gender'][$i];
                $relativesData[$i]['identity_number'] = $data['relatives_identity_number'][$i];
                $relativesData[$i]['seat_number'] = $data['relatives_seat_number'][$i];
                $relativesData[$i]['country'] = $data['relatives_country'][$i];
                $relativesData[$i]['city'] = $data['relatives_city'][$i];
            }

        return $relativesData;
    }

    public function subscribe(array $data = []): bool
    {
        $user = auth('sanctum')->user();
        $parentId = User::where('phone', $data['parent_phone'])->first()->client_id;
        if(!$parentId)
            throw new NotFoundException(__('lang.not_found'));
        $user->client->update([
            'parent_id'=>$parentId,
        ]);

        return true;
    } //end of location

    public function reassignClients($id, array $data = []): bool
    {
        $status = $this->getModel()->where('supervisor_id', $id)->update(['supervisor_id'=> $data['supervisor_id']]);
        if(!$status)
            throw new NotFoundException(__('lang.something_went_wrong'));
        return true;
    } //end of location

    public function changeStatus(int $id, array $data):bool
    {
        $client = $this->findById($id);
        // $this->checkClientLatestStatus(client: $client, newStatus: $data['status']);
        $client->clientHistory()->create($data);
        if (!$client)
            return false ;
        return true;
    } //end of store

    public function checkClientLatestStatus(Client $client, int $newStatus)
    {
        $latestStatus = $client->latestStatus;
        dd($latestStatus->id);
        if($latestStatus->status == $newStatus)
            throw new Exception(message: __('lang.the_status_can_not_be_the_same'), code: 442);
    }

    public function update(int $id, array $data=[])
    {
        $client = $this->findById($id);
        if (!$client)
            return false;

        DB::beginTransaction();
        $clientData = $this->prepareClientData(data: $data);
        $client->update($clientData);

        $userData = $this->prepareUserData(data: $data);
        $userData['password'] = bcrypt($userData['password']);
        $user = $client->user()->update($userData);
        $relativesData = $this->prepareRelativesData(data: $data);
        $client->relatives()->delete();
        $client->relatives()->createMany($relativesData);

        if(isset($data['sites']))
            $client->sites()->sync($data['sites']);
        DB::commit();
        return $client;
    }

    /**
     * @throws NotFoundException
     */
    public function destroy($id)
    {
        $client = $this->findById($id);
        return $client->delete();
    } //end of delete

    public function deleteMultiple($ids = [])
    {
        return $this->getModel()->whereIn('id', $ids)->delete();
    } //end of delete

    public function status($id)
    {
        $doctor = $this->findById($id);
        $doctor->is_active = !$doctor->is_active;
        return $doctor->save();

    }//end of status

}
