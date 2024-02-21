<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Complaint;
use App\Models\ComplaintReplay;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Faq;
use App\QueryFilters\ComplaintsFilter;
use App\QueryFilters\FaqsFilter;
use Illuminate\Database\Eloquent\Model;

class ComplaintReplayService extends BaseService
{
    public function __construct(private ComplaintReplay $model){

    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function store(array $data = []):Faq|Model|bool
    {
        $complaintReplay = $this->getModel()->create($data);
        if (!$complaintReplay)
            return false ;
        return $complaintReplay;
    } //end of store

    public function update(int $id, array $data=[])
    {
        $complaintReplay = $this->findById($id);
        $complaintReplay->update($data);
        return $complaintReplay;
    }

    /**
     * @throws NotFoundException
     */
    public function destroy($id)
    {
        $complaintReplay = $this->findById($id);
        return $complaintReplay->delete();
    } //end of delete

}
