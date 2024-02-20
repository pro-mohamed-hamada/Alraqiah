<?php

namespace App\Services;

use App\Enum\ImageTypeEnum;
use App\Enum\PaymentStatusEnum;
use App\Enum\UserTypeEnum;
use App\Exceptions\NotFoundException;
use App\Models\User;
use App\Models\UserPackage;
use App\QueryFilters\UsersFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class UserService extends BaseService
{

    public function __construct(private User $model)
    {
        
    }

    public function getAll(array $filters = [] , array $withRelations =[], $perPage = 10 ): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        $filters['type'] = UserTypeEnum::SUPERVISOR;
        return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function queryGet(array $filters = [] , array $withRelations = []) :builder
    {
        $services = $this->getModel()->query()->with($withRelations);
        return $services->filter(new UsersFilter($filters));
    }

    public function getModel(): Model
    {
        return $this->model;
    }
    public function store(array $data = [])
    {
        $user = $this->getModel()->create($data);
        if (!$user)
            return false ;
        if (isset($data['logo']))
        {
            $fileData = FileService::saveImage(file: $data['logo'],path: 'uploads/users', field_name: 'logo');
            $user->storeAttachment($fileData);
        }
        return $user;
    } //end of store

    public function update(int $id, array $data = [])
    {
        $user = $this->findById(id: $id, withRelations: ['attachments']);
        
        if (isset($data['logo']))
        {
            $fileData = FileService::saveImage(file: $data['logo'],path: 'uploads/users', field_name: 'logo');
            $user->updateAttachment($fileData);
        }
        return $user->update(Arr::except($data, 'logo'));
    } //end of store


    public function changeStatus($id)
    {
        $user = $this->findById($id);
        $user->is_active = !$user->is_active;
        $user->save();
    }

    /**
     * @throws NotFoundException
     */
    public function destroy($id)
    {
        $user = $this->findById($id);
        $user->deleteAttachments();
        return $user->delete();
    } //end of delete

}
