<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Relative;
use App\QueryFilters\RelativesFilter;
use App\QueryFilters\ReservationsFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class RelativeService extends BaseService
{

    public function __construct(private Relative $model)
    {

    }

    public function getModel(): Model
    {
        return $this->model;
    }
    public function queryGet(array $filters = [] , array $withRelations = []) :builder
    {
        $relatives = $this->getModel()->query()->with($withRelations);
        return $relatives->filter(new RelativesFilter($filters));
    }

    public function getAll(array $filters = [] , array $withRelations =[], $perPage = 10 ): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
    }

    /**
     * deleting rate
     * @param int $id
     * @throws NotFoundException
     * @return bool
     */
    public function destroy($id): bool
    {
        $relative = $this->findById(id: $id);
        
        return $relative->delete();
    }

    public function store(array $data = []):Relative|Model|bool
    {
        $relative = $this->getModel()->create($data);
        if (!$relative)
            return false ;
        return $relative;
    } //end of store

    public function update(int $id, array $data=[])
    {
        $relative = $this->findById($id);
        
        return $relative->update($data);
    }

}
