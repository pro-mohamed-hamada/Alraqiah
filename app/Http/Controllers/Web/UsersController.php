<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserStoreRequest;
use App\Http\Requests\Web\UserUpdateRequest;
use App\Services\UserService;
use Exception;
use Spatie\Permission\Models\Permission;
class UsersController extends Controller
{
    public function __construct(private UserService $userService)
    {

    }

    public function index(Request $request)
    {
        userCan(request: $request, permission: 'view_user');
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        $withRelations = [];
        $users = $this->userService->getAll(['filters'=>$filters, 'withRelations'=>$withRelations, 'perPage'=>1]);
        return View('Dashboard.Users.index', compact(['users']));
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

}
