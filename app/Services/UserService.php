<?php

namespace App\Services;

use App\Enum\ActivationStatusEnum;
use App\Enum\UserTypeEnum;
use App\Exceptions\NotFoundException;
use App\Models\User;
use App\QueryFilters\UsersFilter;
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
        $data['is_active'] = isset($data['is_active']) ? ActivationStatusEnum::ACTIVE:ActivationStatusEnum::NOT_ACTIVE;
        $data['type'] = UserTypeEnum::SUPERVISOR;
        $user = $this->getModel()->create($data);
        if (!$user)
            return false ;
        $user->givePermissionTo($data['permissions']);
        if (isset($data['logo']))
        {
            $user->addMediaFromRequest('logo')->toMediaCollection('users');
        }
        return $user;
    } //end of store

    public function update(int $id, array $data = [])
    {
        $data['is_active'] = isset($data['is_active']) ? ActivationStatusEnum::ACTIVE:ActivationStatusEnum::NOT_ACTIVE;
        $user = $this->findById(id: $id);
        
        if (isset($data['logo']))
        {
            $user->clearMediaCollection('users');
            $user->addMediaFromRequest('logo')->toMediaCollection('users');
        }
        $user->update(Arr::except($data, 'logo'));
        $user->syncPermissions($data['permissions']);
        return true;
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
        $user->clearMediaCollection('users');
        return $user->delete();
    } //end of delete

}
