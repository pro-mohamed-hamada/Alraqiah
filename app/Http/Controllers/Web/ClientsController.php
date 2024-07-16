<?php

namespace App\Http\Controllers\Web;

use App\DataTables\ClientsDataTable;
use App\Enum\ActivationStatusEnum;
use App\Enum\UserTypeEnum;
use App\Events\ComplaintCountEvent;
use Illuminate\Http\Request;
use App\Services\ClientService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ClientsReassignRequest;
use App\Http\Requests\Web\ClientStoreRequest;
use App\Http\Requests\Web\ClientUpdateRequest;
use App\Http\Requests\Web\ImportClientRequest;
use App\Services\SiteService;
use App\Services\UserService;
use Exception;
use App\Imports\ClientsImport;
use App\Imports\ClientsWithRelativesImport;
use Maatwebsite\Excel\Facades\Excel;
class ClientsController extends Controller
{
    public function __construct(
        private ClientService $clientService,
        private UserService $userService,
        private SiteService $siteService
        )
    {

    }

    public function index(ClientsDataTable $dataTable, Request $request)
    {
        userCan(request: $request, permission: 'view_client');
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        $withRelations = ['relatives'];
        $supervisorsFilters['type'] = UserTypeEnum::SUPERVISOR;
        $supervisors = $this->userService->getAll(filters: $supervisorsFilters);
        return $dataTable->with(['filters'=>$filters, 'withRelations'=>$withRelations])->render('Dashboard.Clients.index', compact('supervisors'));
    }//end of index

    public function edit(Request $request, $id)
    {
        userCan(request: $request, permission: 'edit_client');
        $client = $this->clientService->findById(id: $id, withRelations:['user', 'relatives']);
        if (!$client)
        {
            return redirect()->back()->with("message", __('lang.not_found'));
        }
        $supervisorsFilters['is_active'] = ActivationStatusEnum::ACTIVE;
        $supervisorsFilters['type'] = UserTypeEnum::SUPERVISOR;

        $supervisors = $this->userService->getAll(filters: $supervisorsFilters);
        $sites = $this->siteService->getAll();
        return view('Dashboard.Clients.edit', compact('client', 'supervisors', 'sites'));
    }//end of create
    public function clientRelatives(Request $request, $id)
    {
        $client = $this->clientService->findById(id: $id, withRelations:['user', 'relatives']);
        if (!$client)
        {
            return redirect()->back()->with("message", __('lang.not_found'));
        }
        return view('Datatables.ClientRelativesDatatable', compact('client'));
    }//end of create

    public function create(Request $request)
    {
        userCan(request: $request, permission: 'create_client');
        $supervisorsFilters['is_active'] = ActivationStatusEnum::ACTIVE;
        $supervisorsFilters['type'] = UserTypeEnum::SUPERVISOR;

        $supervisors = $this->userService->getAll(filters: $supervisorsFilters);
        $sites = $this->siteService->getAll();
        return view('Dashboard.Clients.create', compact('supervisors', 'sites'));
    }//end of create

    public function store(ClientStoreRequest $request)
    {
        userCan(request: $request, permission: 'create_client');
        // try {
            $this->clientService->store($request->validated());
            return redirect()->route('clients.index')->with('message', __('lang.success_operation'));
        // } catch (\Exception $e) {
        //     return redirect()->route('clients.index')->with('message', $e->getMessage());
        // }
    }//end of store

    public function update(ClientUpdateRequest $request, $id)
    {
        userCan(request: $request, permission: 'edit_client');
        try {
            $this->clientService->update($id, $request->validated());
            return redirect()->route('clients.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

    public function reassignClients(ClientsReassignRequest $request, $id)
    {
        userCan(request: $request, permission: 'reassign_clients');
        try {
            $this->clientService->reassignClients($id, $request->validated());
            return redirect()->route('users.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

    public function destroy(Request $request, $id)
    {
        userCan(request: $request, permission: 'delete_client');
        try {
            $result = $this->clientService->destroy($id);
            if(!$result)
                return apiResponse(message: trans('lang.not_found'),code: 404);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (\Exception $e) {
            return apiResponse(message: $e->getMessage(),code: 422);
        }
    } //end of destroy

    public function deleteMultiple(Request $request)
    {
        userCan(request: $request, permission: 'delete_client');

        try {
            $ids = $request->ids;
            $result = $this->clientService->deleteMultiple($ids);
            if(!$result)
                return apiResponse(message: trans('lang.not_found'),code: 404);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (\Exception $e) {
            return apiResponse(message: $e->getMessage(),code: 422);
        }
    } //end of destroy

    public function show(Request $request, $id)
    {
        try{
            $client = $this->clientService->findById(id: $id);
            $supervisorsFilters['is_active'] = ActivationStatusEnum::ACTIVE;
            $supervisorsFilters['type'] = UserTypeEnum::SUPERVISOR;

            $supervisors = $this->userService->getAll(filters: $supervisorsFilters);
            $sites = $this->siteService->getAll();
            return view('Dashboard.Clients.show', compact('client', 'supervisors', 'sites'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
    } //end of show

    public function importView(Request $request)
    {
        userCan(request: $request, permission: 'import_client');
        $supervisorsFilters['is_active'] = ActivationStatusEnum::ACTIVE;
        $supervisorsFilters['type'] = UserTypeEnum::SUPERVISOR;

        $supervisors = $this->userService->getAll(filters: $supervisorsFilters);

        return View('Dashboard.Clients.import', compact('supervisors'));
    }

    public function import(ImportClientRequest $request)
    {
        try{
            $import = new ClientsWithRelativesImport();

            // Use the import object with the request data
            Excel::import($import, $request->file('file'));

            return redirect()->route('clients.index')->with('message', __('lang.success_operation'));

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            return redirect()->back()->with(compact('failures'));
       } catch (Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }

    }
}
