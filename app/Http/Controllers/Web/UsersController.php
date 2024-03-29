<?php

namespace App\Http\Controllers\Web;

use App\DataTables\UsersDataTable;
use App\Enum\UserTypeEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserProfileRequest;
use App\Http\Requests\Web\UserStoreRequest;
use App\Http\Requests\Web\UserUpdateRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
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
            return view('Datatables.SupervisorClients', compact('user'));
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
            if (!$result)
                return redirect()->back()->with("message", __('lang.not_found'));
            return redirect()->back()->with("message", __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
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

}
