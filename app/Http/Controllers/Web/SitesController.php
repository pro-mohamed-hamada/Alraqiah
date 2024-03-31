<?php

namespace App\Http\Controllers\Web;

use App\DataTables\SitesDataTable;
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

    public function index(SitesDataTable $dataTable, Request $request)
    {
        userCan(request: $request, permission: 'view_site');
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        return $dataTable->with(['filters'=>$filters])->render('Dashboard.Sites.index');
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
        userCan(request: $request, permission: 'edit_site');
        try {
            $this->siteService->update($id, $request->validated());
            return redirect()->route('sites.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

    public function destroy(Request $request, $id)
    {
        userCan(request: $request, permission: 'delete_site');
        try {
            $result = $this->siteService->destroy($id);
            if(!$result)
                return apiResponse(message: trans('lang.not_found'),code: 404);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (\Exception $e) {
            return apiResponse(message: $e->getMessage(),code: 422);
        }
    } //end of destroy

    public function show(Request $request, $id)
    {
        userCan(request: $request, permission: 'view_site');
        try{
            $site = $this->siteService->findById(id: $id);
            return view('Dashboard.Sites.show', compact('site'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
    } //end of show

}
