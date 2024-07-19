<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Relative;
use App\QueryFilters\RelativesFilter;
use App\QueryFilters\ReservationsFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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

    public function updateChronicDisease(string $id, array $data = [])
    {
        $relative = $this->findById(id: $id);
        DB::beginTransaction();
        $relative->update($data);
        DB::commit();

        return true;
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

}
