<?php

namespace App\Http\Controllers\Web;

use App\Enum\ActivationStatusEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ComplaintService;
use Exception;

class ComplaintsController extends Controller
{
    public function __construct(private ComplaintService $complaintService)
    {

    }

    public function index(Request $request)
    {
        $filters =  $request->all();
        $filters['is_active'] = ActivationStatusEnum::ACTIVE;
        $complaints = $this->complaintService->getAll(filters: $filters);
        return View('Dashboard.Complaints.index', compact(['complaints']));
    }//end of index

    public function destroy($id)
    {
        try {
            $result = $this->complaintService->destroy($id);
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
