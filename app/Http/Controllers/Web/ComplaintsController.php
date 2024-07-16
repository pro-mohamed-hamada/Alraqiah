<?php

namespace App\Http\Controllers\Web;

use App\DataTables\ComplaintsDataTable;
use App\Enum\ActivationStatusEnum;
use App\Events\MessageEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ComplaintService;
use Exception;

class ComplaintsController extends Controller
{
    public function __construct(private ComplaintService $complaintService)
    {

    }

    public function index(ComplaintsDataTable $dataTable, Request $request)
    {
        userCan(request: $request, permission: 'view_complaint');
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        return $dataTable->with(['filters'=>$filters])->render('Dashboard.Complaints.index');
    }//end of index

    public function destroy(Request $request, $id)
    {
        userCan(request: $request, permission: 'delete_complaint');
        try {
            $result = $this->complaintService->destroy($id);
            if(!$result)
                return apiResponse(message: trans('lang.not_found'),code: 404);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (\Exception $e) {
            return apiResponse(message: $e->getMessage(),code: 422);
        }
    } //end of destroy

    public function complaintReplies(Request $request, $id)
    {
        $complaint = $this->complaintService->findById(id: $id);
        if (!$complaint)
        {
            return redirect()->back()->with("message", __('lang.not_found'));
        }
        return view('Datatables.ComplaintRepliesDatatable', compact('complaint'));
    }//end of create

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     * status method for change is_active column only
     */
    public function status(int $id)
    {
        try {
            $result = $this->complaintService->status(id: $id);
            if (!$result)
                return apiResponse(message: __('lang.something_went_wrong'), code: 442);
            return apiResponse(message: __('lang.success_operation'));
        } catch (\Exception $e) {
            return apiResponse(message: $e->getMessage(), code: 442);
        }
    } //end of status


}
