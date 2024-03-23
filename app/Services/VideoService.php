<?php

namespace App\Services;

use App\Enum\ActivationStatusEnum;
use App\Enum\ImageTypeEnum;
use App\Exceptions\NotFoundException;
use App\Jobs\StoreVideoJob;
use App\Jobs\UpdateVideoJob;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Media;
use App\Models\Video;
use App\QueryFilters\MediaFilter;
use App\QueryFilters\VideosFilter;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data['is_active'] = isset($data['is_active']) ? ActivationStatusEnum::ACTIVE:ActivationStatusEnum::NOT_ACTIVE;
        $video = $this->getModel()->create($data);
        if (!$video)
            return false ;
        if (isset($data['video_file']))
        {
            $path = Request()->file('video_file')->store('temporary_videos');
            StoreVideoJob::dispatch($video, $path);
        }
        return $video;
    } //end of store

    public function update(int $id, array $data=[])
    {
        $video = $this->findById($id);
        $data['is_active'] = isset($data['is_active']) ? ActivationStatusEnum::ACTIVE:ActivationStatusEnum::NOT_ACTIVE;
        if (isset($data['video_file']))
        {
            $path = Request()->file('video_file')->store('temporary_videos');
            UpdateVideoJob::dispatch($video, $path);
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
        $video->is_active = !$video->getRawOriginal('is_active');
        return $video->save();

    }//end of status

}
