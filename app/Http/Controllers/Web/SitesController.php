<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SiteStoreRequest;
use App\Http\Requests\Web\SiteUpdateRequest;
use App\Services\SiteService;
use Exception;

class SitesController extends Controller
{
    public function __construct(private SiteService $siteService)
    {

    }

    public function index(Request $request)
    {
        userCan(request: $request, permission: 'view_site');
        $filters =  $request->all();
        $sites = $this->siteService->getAll(['filters'=>$filters]);
        return View('Dashboard.Sites.index', compact(['sites']));
    }//end of index

    public function edit(Request $request, $id)
    {
        userCan(request: $request, permission: 'edit_site');
        try{
            $site = $this->siteService->findById(id: $id);
            return view('Dashboard.Sites.edit', compact('site'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
        
    }//end of create

    public function create(Request $request)
    {
        userCan(request: $request, permission: 'create_site');
        return view('Dashboard.Sites.create');
    }//end of create

    public function store(SiteStoreRequest $request)
    {
        userCan(request: $request, permission: 'create_site');
        try {
            $this->siteService->store($request->validated());
            return redirect()->route('sites.index')->with('message', __('lang.success_operation'));
        } catch (Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }//end of store

    public function update(SiteUpdateRequest $request, $id)
    {
        try {
            $this->siteService->update($id, $request->validated());
            return redirect()->route('sites.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

    public function destroy($id)
    {
        try {
            $result = $this->siteService->destroy($id);
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
            $site = $this->siteService->findById(id: $id, withRelations:['attachments']);
            return view('Dashboard.Sites.show', compact('site'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
    } //end of show

}
