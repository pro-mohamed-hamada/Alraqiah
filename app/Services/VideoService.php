<?php

namespace App\Services;

use App\Enum\ImageTypeEnum;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Media;
use App\Models\Video;
use App\QueryFilters\MediaFilter;
use App\QueryFilters\VideosFilter;
use Illuminate\Database\Eloquent\Model;

class VideoService extends BaseService
{
    public function __construct(private Video $model){

    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function queryGet(array $filters = [] , array $withRelations = []) :builder
    {
        $videos = $this->getModel()->query()->with($withRelations);
        return $videos->filter(new VideosFilter($filters));
    }

    public function getAll(array $filters = [] , array $withRelations =[], $perPage = 10 ): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function store(array $data = []):Video|Model|bool
    {
        $video = $this->getModel()->create($data);
        if (!$video)
            return false ;
        if (isset($data['video_file']))
        {
            $video->addMediaFromRequest('video_file')->toMediaCollection('media');
        }
        return $video;
    } //end of store

    public function update(int $id, array $data=[])
    {
        $video = $this->findById($id);
        if (isset($data['video_file']))
        {
            $video->clearMediaCollection('media');
            $video->addMediaFromRequest('video_file')->toMediaCollection('media');
        }
        return $video->update($data);
    }

    /**
     * @throws NotFoundException
     */
    public function destroy($id)
    {
        $video = $this->findById($id);
        $video->clearMediaCollection('media');
        return $video->delete();
    } //end of delete

    public function status($id)
    {
        $video = $this->findById($id);
        $video->is_active = !$video->is_active;
        return $video->save();

    }//end of status

}
