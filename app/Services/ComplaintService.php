<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Faq;
use App\QueryFilters\ComplaintsFilter;
use App\QueryFilters\FaqsFilter;
use Illuminate\Database\Eloquent\Model;

class ComplaintService extends BaseService
{
    public function __construct(private Complaint $model){

    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function queryGet(array $filters = [] , array $withRelations = []) :builder
    {
        $complaints = $this->getModel()->query()->with($withRelations);
        return $complaints->filter(new ComplaintsFilter($filters));
    }

    public function getAll(array $filters = [] , array $withRelations =[], $perPage = 10 ): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function store(array $data = []):Faq|Model|bool
    {
        $data['client_id'] = auth('sanctum')->user()->client_id;
        $complaint = $this->getModel()->create($data);
        if (!$complaint)
            return false ;
        return $complaint;
    } //end of store

    public function update(int $id, array $data=[])
    {
        $complaint = $this->findById($id);
        $complaint->update($data);
        return $complaint;
    }

    /**
     * @throws NotFoundException
     */
    public function destroy($id)
    {
        $complaint = $this->findById($id);
        return $complaint->delete();
    } //end of delete

}
