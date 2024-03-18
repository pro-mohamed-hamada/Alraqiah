<?php

namespace App\Services;

use App\Models\FcmMessage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\QueryFilters\FcmMessagesFilter;

class FcmMessageService extends BaseService
{

    public function __construct(private FcmMessage $model)
    {
        
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function queryGet(array $filters = [], $withRelation = []): Builder
    {
        $fcmMessage = $this->getModel()->query()->with($withRelation);
        return $fcmMessage->filter(new FcmMessagesFilter($filters));
    }

    public function getAll(array $filters = [], array $withRelation = [], $perPage = null): \Illuminate\Contracts\Pagination\CursorPaginator|\Illuminate\Database\Eloquent\Builder
    {
        if($perPage)
            return $this->queryGet(filters: $filters, withRelation: $withRelation)->cursorPaginate($perPage);
        else
            return $this->queryGet(filters: $filters, withRelation: $withRelation);
    }


    public function store(array $data = [])
    {
        $data['is_active'] = isset($data['is_active'])  ? 1 :  0;
        $fcm_message = $this->getModel()->create($data);
        return $fcm_message;
    } //end of store

    public function update(int $id, array $data=[])
    {
        $fcmMessage = $this->findById(id: $id);
        $data['is_active'] = isset($data['is_active'])  ? 1 :  0;
        return $fcmMessage->update($data);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        $fcmMessage = $this->findById(id: $id);
        return $fcmMessage->delete();
    } //end of delete

    public function status($id)
    {
        $fcm_message = $this->findById(id: $id);
        $fcm_message->is_active = !$fcm_message->is_active;
        return $fcm_message->save();

    }//end of status

}
