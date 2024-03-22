<?php

namespace App\Services;

use App\Enum\ImageTypeEnum;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Media;
use App\Models\Setting;
use App\Models\Video;
use App\QueryFilters\MediaFilter;
use App\QueryFilters\VideosFilter;
use Illuminate\Database\Eloquent\Model;

class SettingService extends BaseService
{
    public function __construct(private Setting $model){

    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function queryGet(array $filters = [] , array $withRelations = []) :builder
    {
        return $this->getModel()->query()->with($withRelations);
    }

    public function getAll(array $filters = [] , array $withRelations =[], $perPage = 10 ): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function update(string $id, array $data = []):Setting|Model|bool
    {
        $setting = $this->findById(id: $id);
        $status = $setting->update($data);
        if (!$status)
            return false ;
        return $setting;
    } //end of store

}
