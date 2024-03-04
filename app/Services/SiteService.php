<?php

namespace App\Services;

use App\Enum\ActivationStatusEnum;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Site;
use App\QueryFilters\SitesFilter;
use Illuminate\Database\Eloquent\Model;

class SiteService extends BaseService
{
    public function __construct(private Site $model){

    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function queryGet(array $filters = [] , array $withRelations = []) :builder
    {
        $site = $this->getModel()->query()->with($withRelations);
        return $site->filter(new SitesFilter($filters));
    }

    public function getAll(array $filters = [] , array $withRelations =[], $perPage = null ): \Illuminate\Contracts\Pagination\CursorPaginator|\Illuminate\Database\Eloquent\Collection
    {
        if($perPage)
            return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
        else
            return $this->queryGet(filters: $filters,withRelations: $withRelations)->get();
    }

    public function store(array $data = []):Site|Model|bool
    {
        $data['is_active'] = isset($data['is_active']) ? ActivationStatusEnum::ACTIVE:ActivationStatusEnum::NOT_ACTIVE;
        $site = $this->getModel()->create($data);
        if (!$site)
            return false ;
        return $site;
    } //end of store

    public function update(int $id, array $data=[])
    {
        $site = $this->findById($id);
        $data['is_active'] = isset($data['is_active']) ? ActivationStatusEnum::ACTIVE:ActivationStatusEnum::NOT_ACTIVE;
        return $site->update($data);
    }

    /**
     * @throws NotFoundException
     */
    public function destroy($id)
    {
        $site = $this->findById($id);
        return $site->delete();
    } //end of delete

    public function status($id)
    {
        $site = $this->findById($id);
        $site->is_active = !$site->is_active;
        return $site->save();

    }//end of status

}
