<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\FaqStoreRequest;
use App\Http\Requests\Web\FaqUpdateRequest;
use App\Services\FaqService;
use Exception;

class ComplaintsController extends Controller
{
    public function __construct(private FaqService $faqService)
    {

    }

    public function index(Request $request)
    {
        
        $filters =  $request->all();
        $faqs = $this->faqService->getAll(['filters'=>$filters]);
        return View('Dashboard.Faqs.index', compact(['faqs']));
    }//end of index

    public function edit(Request $request, $id)
    {
        try{
            $faq = $this->faqService->findById(id: $id);
            return view('Dashboard.Faqs.edit', compact('faq'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
        
    }//end of create

    public function create(Request $request)
    {
        return view('Dashboard.Faqs.create');
    }//end of create

    public function store(FaqStoreRequest $request)
    {
        try {
            $this->faqService->store($request->validated());
            return redirect()->route('faqs.index')->with('message', __('lang.success_operation'));
        } catch (Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }//end of store

    public function update(FaqUpdateRequest $request, $id)
    {
        try {
            $this->faqService->update($id, $request->validated());
            return redirect()->route('faqs.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

    public function destroy($id)
    {
        try {
            $result = $this->faqService->destroy($id);
            if (!$result)
                return redirect()->back()->with("message", __('lang.not_found'));
            return redirect()->back()->with("message", __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of destroy

    public function show(Request $request, $id)
    {
        try{
            $faq = $this->faqService->findById(id: $id, withRelations:['attachments']);
            return view('Dashboard.Faqs.show', compact('faq'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
    } //end of show

}
