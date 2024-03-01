<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\ClientService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ClientStoreRequest;
use App\Http\Requests\Web\ClientUpdateRequest;

class ClientsController extends Controller
{
    public function __construct(private ClientService $clientService)
    {

    }

    public function index(Request $request)
    {
        
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        $withRelations = ['relatives'];
        $clients = $this->clientService->getAll(['filters'=>$filters, 'withRelations'=>$withRelations, 'perPage'=>25]);
        return View('Dashboard.Clients.index', compact(['clients']));
    }//end of index

    public function edit(Request $request, $id)
    {

        $client = $this->clientService->findById(id: $id, withRelations:['user', 'relatives']);
        if (!$client)
        {
            return redirect()->back()->with("message", __('lang.not_found'));
        }
        return view('Dashboard.Clients.edit', compact('client'));
    }//end of create

    public function create(Request $request)
    {
        userCan(request: $request, permission: 'create_client');
        return view('Dashboard.Clients.create');
    }//end of create

    public function store(ClientStoreRequest $request)
    {
        try {
            $this->clientService->store($request->validated());
            return redirect()->route('clients.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->route('clients.index')->with('message', $e->getMessage());
        }
    }//end of store

    public function update(ClientUpdateRequest $request, $id)
    {
        try {
            $this->clientService->update($id, $request->validated());
            return redirect()->route('clients.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

    public function destroy($id)
    {
        try {
            $result = $this->clientService->destroy($id);
            if (!$result)
                return redirect()->back()->with("message", __('lang.not_found'));
            return redirect()->back()->with("message", __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of destroy

    // public function show(Request $request, $id)
    // {
    //     userCan(request: $request, permission: 'view_category');
    //     $category = $this->categoryService->find($id);
    //     if (!$category)
    //     {
    //         $toast = ['type' => 'error', 'title' => trans('lang.error'), 'message' => trans('lang.category_not_found')];
    //         return back()->with('toast', $toast);
    //     }
    //    return view('dashboard.categories.show', compact('category'));
    // } //end of show

    // public function changeStatus(Request $request)
    // {
    //     try {
    //         $result =  $this->categoryService->changeStatus($request->id);
    //         if (!$result)
    //             return apiResponse(message: trans('lang.not_found'), code: 404);
    //         return apiResponse(message: trans('lang.success'));
    //     } catch (\Exception $exception) {
    //         return apiResponse(message: $exception->getMessage(), code: 422);
    //     }

    // } //end of changeStatus
}
