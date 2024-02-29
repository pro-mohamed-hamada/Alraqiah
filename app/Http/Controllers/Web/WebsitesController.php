<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\WebsiteStoreRequest;
use App\Http\Requests\Web\WebsiteUpdateRequest;
use App\Services\WebsiteService;
use Exception;

class WebsitesController extends Controller
{
    public function __construct(private WebsiteService $websiteService)
    {

    }

    public function index(Request $request)
    {
        
        $filters =  $request->all();
        $websites = $this->websiteService->getAll(['filters'=>$filters]);
        return View('Dashboard.Websites.index', compact(['websites']));
    }//end of index

    public function edit(Request $request, $id)
    {
        try{
            $website = $this->websiteService->findById(id: $id);
            return view('Dashboard.Websites.edit', compact('website'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
        
    }//end of create

    public function create(Request $request)
    {
        return view('Dashboard.Websites.create');
    }//end of create

    public function store(WebsiteStoreRequest $request)
    {
        try {
            $this->websiteService->store($request->validated());
            return redirect()->route('websites.index')->with('message', __('lang.success_operation'));
        } catch (Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }//end of store

    public function update(WebsiteUpdateRequest $request, $id)
    {
        try {
            $this->websiteService->update($id, $request->validated());
            return redirect()->route('websites.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

    public function destroy($id)
    {
        try {
            $result = $this->websiteService->destroy($id);
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
            $website = $this->websiteService->findById(id: $id, withRelations:['attachments']);
            return view('Dashboard.Websites.show', compact('website'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
    } //end of show

}
