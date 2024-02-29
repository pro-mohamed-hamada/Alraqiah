<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Website;
use App\QueryFilters\WebsitesFilter;
use Illuminate\Database\Eloquent\Model;

class WebsiteService extends BaseService
{
    public function __construct(private Website $model){

    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function queryGet(array $filters = [] , array $withRelations = []) :builder
    {
        $website = $this->getModel()->query()->with($withRelations);
        return $website->filter(new WebsitesFilter($filters));
    }

    public function getAll(array $filters = [] , array $withRelations =[], $perPage = null ): \Illuminate\Contracts\Pagination\CursorPaginator|\Illuminate\Database\Eloquent\Collection
    {
        if($perPage)
            return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
        else
            return $this->queryGet(filters: $filters,withRelations: $withRelations)->get();
    }

    public function store(array $data = []):Website|Model|bool
    {
        $website = $this->getModel()->create($data);
        if (!$website)
            return false ;
        return $website;
    } //end of store

    public function update(int $id, array $data=[])
    {
        $website = $this->findById($id);
        
        return $website->update($data);
    }

    /**
     * @throws NotFoundException
     */
    public function destroy($id)
    {
        $website = $this->findById($id);
        return $website->delete();
    } //end of delete

    public function status($id)
    {
        $website = $this->findById($id);
        $website->is_active = !$website->is_active;
        return $website->save();

    }//end of status

}
