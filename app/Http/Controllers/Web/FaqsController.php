<?php

namespace App\Http\Controllers\Web;

use App\DataTables\FaqsDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\FaqStoreRequest;
use App\Http\Requests\Web\FaqUpdateRequest;
use App\Services\FaqService;
use Exception;
use Illuminate\Support\Arr;

class FaqsController extends Controller
{
    public function __construct(private FaqService $faqService)
    {

    }

    public function index(FaqsDataTable $dataTable, Request $request)
    {
        userCan(request: $request, permission: 'view_faq');
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        return $dataTable->with(['filters'=>$filters])->render('Dashboard.Faqs.index');
    }//end of index

    public function edit(Request $request, $id)
    {
        userCan(request: $request, permission: 'edit_faq');
        try{
            $faq = $this->faqService->findById(id: $id);
            return view('Dashboard.Faqs.edit', compact('faq'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
        
    }//end of create

    public function create(Request $request)
    {
        userCan(request: $request, permission: 'create_faq');
        return view('Dashboard.Faqs.create');
    }//end of create

    public function store(FaqStoreRequest $request)
    {
        userCan(request: $request, permission: 'create_faq');
        try {
            $this->faqService->store($request->validated());
            return redirect()->route('faqs.index')->with('message', __('lang.success_operation'));
        } catch (Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }//end of store

    public function update(FaqUpdateRequest $request, $id)
    {
        userCan(request: $request, permission: 'edit_faq');
        try {
            $this->faqService->update($id, $request->validated());
            return redirect()->route('faqs.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

    public function destroy(Request $request, $id)
    {
        userCan(request: $request, permission: 'delete_faq');
        try {
            $result = $this->faqService->destroy($id);
            if(!$result)
                return apiResponse(message: trans('lang.not_found'),code: 404);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (\Exception $e) {
            return apiResponse(message: $e->getMessage(),code: 422);
        }
    } //end of destroy

    public function show(Request $request, $id)
    {
        userCan(request: $request, permission: 'view_faq');
        try{
            $faq = $this->faqService->findById(id: $id);
            return view('Dashboard.Faqs.show', compact('faq'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
    } //end of show

}
