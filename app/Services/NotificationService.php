<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Notification;
use App\QueryFilters\NotificationsFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NotificationService extends BaseService
{
    public function __construct(private Notification $model){

    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function queryGet(array $filters = [] , array $withRelations = []) :builder
    {
        $notification = $this->getModel()->query()->with($withRelations);
        return $notification->filter(new NotificationsFilter($filters));
    }

    public function getAll(array $filters = [] , array $withRelations =[], $perPage = 10 ): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function markAsRead(string $id): bool
    {
        $notification = $this->findById(id: $id);
        $currentDate = Carbon::now();
        return $notification->update(['read_at'=>$currentDate]);
    } //end of store

    /**
     * @throws NotFoundException
     */
    public function destroy(string $id)
    {
        $notification = $this->findById($id);
        return $notification->delete();
    } //end of delete

}
