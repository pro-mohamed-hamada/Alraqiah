<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Rate;
use App\QueryFilters\RatesFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class RateService extends BaseService
{

    public function __construct(private Rate $model)
    {

    }

    public function getModel(): Model
    {
        return $this->model;
    }
    public function queryGet(array $filters = [] , array $withRelations = []) :builder
    {
        $rates = $this->getModel()->query()->with($withRelations);
        return $rates->filter(new RatesFilter($filters));
    }

    public function getAll(array $filters = [] , array $withRelations =[], $perPage = 10 ): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
    }

    /**
     * deleting rate
     * @param int $id
     * @throws NotFoundException
     * @return bool
     */
    public function destroy($id): bool
    {
        $rate = $this->findById(id: $id);
        
        $rate->delete();
        return true;
    }

    public function status($id)
    {
        $rate = $this->findbyId($id);
        $rate->is_active = !$rate->getRawOriginal('is_active');
        return $rate->save();

    }//end of status

    // ///////////////////////
    /**
     * @param array $data
     * @return Rate
     */
    public function store(array $data)
    {
        $user = auth('sanctum')->user();
        $rate = $user->client->rates()->updateOrCreate(['client_id'=> $user->client_id],[
            'client_id'   => $user->client_id,
            'rate_number' => $data['rate_number'],
            'comment'     => $data['comment'],
            'is_active'   => 1
        ]);
        
        return $rate;

    }

}
