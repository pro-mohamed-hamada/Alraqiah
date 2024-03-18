<?php

namespace App\Http\Controllers\Web;

use App\DataTables\RatesDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RateService;
use Exception;

class RatesController extends Controller
{
    public function __construct(private RateService $rateService)
    {

    }

    public function index(RatesDataTable $dataTable, Request $request)
    {
        userCan(request: $request, permission: 'view_rate');
        $filters =  $request->all();
        return $dataTable->with(['filters'=>$filters])->render('Dashboard.Rates.index');
    }//end of index

    public function destroy(Request $request, $id)
    {
        userCan(request: $request, permission: 'delete_rate');
        try {
            $result = $this->rateService->destroy($id);
            if (!$result)
                return redirect()->back()->with("message", __('lang.not_found'));
            return redirect()->back()->with("message", __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of destroy

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     * status method for change is_active column only
     */
    public function status(Request $request, int $id)
    {
        try {
            $result = $this->rateService->status(id: $id);
            if (!$result)
                return apiResponse(message: __('lang.something_went_wrong'), code: 442);
            return apiResponse(message: __('lang.success_operation'));
        } catch (\Exception $e) {
            return apiResponse(message: $e->getMessage(), code: 442);
        }
    } //end of status

}
