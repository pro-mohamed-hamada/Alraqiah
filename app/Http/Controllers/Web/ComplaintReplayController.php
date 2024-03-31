<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ComplaintReplayRequest;
use App\Services\ComplaintReplayService;
use Exception;

class ComplaintReplayController extends Controller
{
    public function __construct(private ComplaintReplayService $complaintReplayService)
    {

    }

    public function store(ComplaintReplayRequest $request)
    {
        try {
            $this->complaintReplayService->store($request->validated());
            return redirect()->route('complaints.index')->with('message', __('lang.success_operation'));
        } catch (Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }//end of store

    public function update(ComplaintReplayRequest $request, $id)
    {
        try {
            $this->complaintReplayService->update($id, $request->validated());
            return redirect()->route('complaints.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

    public function destroy($id)
    {
        try {
            $result = $this->complaintReplayService->destroy($id);
            if(!$result)
                return apiResponse(message: trans('lang.not_found'),code: 404);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (\Exception $e) {
            return apiResponse(message: $e->getMessage(),code: 422);
        }
    } //end of destroy
}
