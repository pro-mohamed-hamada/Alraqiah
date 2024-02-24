<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Faq;
use App\QueryFilters\FaqsFilter;
use Illuminate\Database\Eloquent\Model;

class FaqService extends BaseService
{
    public function __construct(private Faq $model){

    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function queryGet(array $filters = [] , array $withRelations = []) :builder
    {
        $faq = $this->getModel()->query()->with($withRelations);
        return $faq->filter(new FaqsFilter($filters));
    }

    public function getAll(array $filters = [] , array $withRelations =[], $perPage = null ): \Illuminate\Contracts\Pagination\CursorPaginator|\Illuminate\Database\Eloquent\Collection
    {
        if($perPage)
            return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
        else
            return $this->queryGet(filters: $filters,withRelations: $withRelations)->get();
    }

    public function store(array $data = []):Faq|Model|bool
    {
        $faq = $this->getModel()->create($data);
        if (!$faq)
            return false ;
        return $faq;
    } //end of store

    public function update(int $id, array $data=[])
    {
        $faq = $this->findById($id);
        
        return $faq->update($data);
    }

    /**
     * @throws NotFoundException
     */
    public function destroy($id)
    {
        $faq = $this->findById($id);
        return $faq->delete();
    } //end of delete

    public function status($id)
    {
        $faq = $this->findById($id);
        $faq->is_active = !$faq->is_active;
        return $faq->save();

    }//end of status

}
