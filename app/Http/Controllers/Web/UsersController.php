<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserStoreRequest;
use App\Http\Requests\Web\UserUpdateRequest;
use App\Services\UserService;
use Exception;

class UsersController extends Controller
{
    public function __construct(private UserService $userService)
    {

    }

    public function index(Request $request)
    {
        
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        $withRelations = [];
        $users = $this->userService->getAll(['filters'=>$filters, 'withRelations'=>$withRelations, 'perPage'=>1]);
        return View('Dashboard.Users.index', compact(['users']));
    }//end of index

    

    public function create(Request $request)
    {
        return view('Dashboard.Users.create');
    }//end of create

    public function store(UserStoreRequest $request)
    {
        try {
            $this->userService->store($request->validated());
            return redirect()->route('users.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('message', $e->getMessage());
        }
    }//end of store

    public function edit(Request $request, $id)
    {
        try{
            $user = $this->userService->findById(id: $id);
            return view('Dashboard.Users.edit', compact('user'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
        
    }//end of create

    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $this->userService->update($id, $request->validated());
            return redirect()->route('users.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

    public function destroy($id)
    {
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
