<?php

namespace App\Services;

use App\Events\PushEvent;
use App\Exceptions\NotFoundException;
use App\Models\Complaint;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Faq;
use App\Models\FcmMessage;
use App\Models\User;
use App\Notifications\SendEmailNotification;
use App\QueryFilters\ComplaintsFilter;
use App\QueryFilters\FaqsFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        $data['user_id'] = auth('sanctum')->user()->id;
        $complaint = $this->getModel()->create($data);
        if (!$complaint)
            return false ;
        $users[0] = User::find(1);
        event(new PushEvent( users: $users, action: FcmMessage::CREAET_NEW_COMPLAINT));

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

    public function status($id)
    {
        $complaint = $this->findById(id: $id);
        $complaint->is_active = !$complaint->getRawOriginal('is_active');
        return $complaint->save();

    }//end of status

}
