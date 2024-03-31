<?php

namespace App\Http\Controllers\Web;

use App\DataTables\UsersDataTable;
use App\Enum\ActivationStatusEnum;
use App\Enum\UserTypeEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserProfileRequest;
use App\Http\Requests\Web\UsersImportRequest;
use App\Http\Requests\Web\UserStoreRequest;
use App\Http\Requests\Web\UserUpdateRequest;
use App\Imports\UsersImport;
use App\Services\UserService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function __construct(private UserService $userService)
    {

    }

    public function index(UsersDataTable $dataTable, Request $request)
    {
        userCan(request: $request, permission: 'view_user');
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        $filters['type'] = UserTypeEnum::SUPERVISOR;
        $withRelations = [];
        return $dataTable->with(['filters'=>$filters])->render('Dashboard.Users.index');
    }//end of index

    

    public function create(Request $request)
    {
        userCan(request: $request, permission: 'create_user');
        $permissions = Permission::all();
        $permissions = $permissions->groupBy('category');
        return view('Dashboard.Users.create', compact('permissions'));
    }//end of create

    public function store(UserStoreRequest $request)
    {
        userCan(request: $request, permission: 'create_user');
        try {
            $this->userService->store($request->validated());
            return redirect()->route('users.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('message', $e->getMessage());
        }
    }//end of store

    public function edit(Request $request, $id)
    {
        userCan(request: $request, permission: 'edit_user');
        try{
            $user = $this->userService->findById(id: $id);
            $permissions = Permission::all();
            $permissions = $permissions->groupBy('category');
            return view('Dashboard.Users.edit', compact('user', 'permissions'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
        
    }//end of create

    public function supervisorClients(Request $request, $id)
    {
        try{
            $user = $this->userService->findById(id: $id);
            $supervisorsFilters['is_active'] = ActivationStatusEnum::ACTIVE;
            $supervisorsFilters['type'] = UserTypeEnum::SUPERVISOR;
    
            $supervisors = $this->userService->getAll(filters: $supervisorsFilters);
                return view('Datatables.SupervisorClients', compact('user', 'supervisors'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
        
    }//end of create

    public function update(UserUpdateRequest $request, $id)
    {
        userCan(request: $request, permission: 'edit_user');
        try {
            $this->userService->update($id, $request->validated());
            return redirect()->route('users.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

    public function destroy(Request $request, $id)
    {
        userCan(request: $request, permission: 'delete_user');
        try {
            $result = $this->userService->destroy($id);
            if(!$result)
                return apiResponse(message: trans('lang.not_found'),code: 404);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (\Exception $e) {
            return apiResponse(message: $e->getMessage(),code: 422);
        }
    } //end of destroy

    public function profileView()
    {
        try {
            $user = Auth::user();
            return view('Dashboard.Users.profile', compact('user'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of destroy

    public function profile(UserProfileRequest $request)
    {
        try {
            $userId = Auth::user()->id;
            $result = $this->userService->update(id: $userId, data: $request->validated());
            if (!$result)
                return redirect()->back()->with("message", __('lang.not_found'));
            return redirect()->back()->with("message", __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of destroy


    public function importView(Request $request) 
    {
        userCan(request: $request, permission: 'import_client');
        $supervisorsFilters['is_active'] = ActivationStatusEnum::ACTIVE;
        $supervisorsFilters['type'] = UserTypeEnum::SUPERVISOR;
        $permissions = Permission::all();
        $permissions = $permissions->groupBy('category');
        return View('Dashboard.Users.import', compact('permissions'));
    }

    public function import(UsersImportRequest $request) 
    {
        try{
            $import = new UsersImport(permissions: $request->permissions);

            // Use the import object with the request data
            Excel::import($import, $request->file('file'));
        
            return redirect()->route('users.index')->with('message', __('lang.success_operation'));
    
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            
            return redirect()->back()->with(compact('failures'));
       } catch (Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }

    }

}
