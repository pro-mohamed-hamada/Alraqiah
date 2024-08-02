<?php

namespace App\Services;

use App\Events\LiveMessageCountEvent;
use App\Events\PushEvent;
use App\Exceptions\NotFoundException;
use App\Models\LiveMessage;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Faq;
use App\Models\FcmMessage;
use App\Models\User;
use App\Notifications\AlraqiahLiveMessage;
use App\Notifications\ClientMessage;
use App\Notifications\GeneralNotification;
use App\Notifications\SendEmailNotification;
use App\QueryFilters\LiveMessagesFilter;
use App\QueryFilters\FaqsFilter;
use App\QueryFilters\LiveMessageFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LiveMessageService extends BaseService
{
    public function __construct(private LiveMessage $model){

    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function queryGet(array $filters = [] , array $withRelations = []) :builder
    {
        $liveMessages = $this->getModel()->query()->with($withRelations);
        return $liveMessages->filter(new LiveMessageFilters($filters));
    }

    public function getAll(array $filters = [] , array $withRelations =[], $perPage = 10 ): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function store(array $data = []):Faq|Model|bool
    {
        $user = auth('sanctum')->user();
        $supervisor = $user?->client?->supervisor;
        $liveMessage = $this->getModel()->create($data);
        if (!$liveMessage)
            return false ;
        $admin = User::find(1);
        $admin->notify(new ClientMessage(liveMessage: $liveMessage));
        $supervisor->notify(new ClientMessage(liveMessage: $liveMessage));
        return $liveMessage;
    } //end of store

    public function update(int $id, array $data=[])
    {
        $liveMessage = $this->findById($id);
        $liveMessage->update($data);
        return $liveMessage;
    }

    /**
     * @throws NotFoundException
     */
    public function destroy($id)
    {
        $liveMessage = $this->findById($id);
        return $liveMessage->delete();
    } //end of delete

}
