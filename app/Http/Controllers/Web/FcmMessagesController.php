<?php

namespace App\Http\Controllers\Web;

use App\DataTables\FcmMessagesDataTable;
use App\Enum\FcmEventsNames;
use App\Enum\UserTypeEnum;
use App\Http\Requests\Web\FcmMessageStoreRequest;
use App\Http\Requests\Web\FcmMessageUpdateRequest;
use App\Services\FcmMessageService;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LiveFcmMessageRequest;
use App\Models\User;
use App\Services\UserService;

class FcmMessagesController extends Controller
{

    public function __construct(
        protected FcmMessageService $fcmMessageService,
        protected UserService $userService
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FcmMessagesDataTable $dataTable, Request $request)
    {
        userCan(request: $request, permission: 'view_fcm_message');
        try{
            $filters = array_filter($request->get('filters', []), function ($value) {
                return ($value !== null && $value !== false && $value !== '');
            });
            return $dataTable->with(['filters'=>$filters])->render('Dashboard.FcmMessages.index');
        }catch(Exception $e){
            return redirect()->back()->with("message", $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        userCan(request: $request, permission: 'create_fcm_message');
        try{
            $flags = FcmEventsNames::$FLAGS;
            $fcm_channels = FcmEventsNames::$CHANNELS;
            $fcm_actions = FcmEventsNames::$FCMACTIONS;
            return view('Dashboard.FcmMessages.create',compact('flags','fcm_channels','fcm_actions'));
        }catch(Exception $e){
            return redirect()->back()->with("message", $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FcmMessageStoreRequest $request)
    {
        userCan(request: $request, permission: 'create_fcm_message');
        try {
            $this->fcmMessageService->store(data: $request->validated());
            return redirect()->route('fcm-messages.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    }

    public function liveFcmMessageView(Request $request)
    {
        userCan(request: $request, permission: 'create_live_fcm_message');
        try {
            $flags = FcmEventsNames::$FLAGS;
            $fcm_channels = FcmEventsNames::$CHANNELS;
            $users = app()->make(UserService::class)->queryGet(filters: ['type'=>UserTypeEnum::CLIENT])->get();
            return view('Dashboard.FcmMessages.live_fcm', compact('users', 'flags', 'fcm_channels'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    }

    public function liveFcmMessage(LiveFcmMessageRequest $request)
    {
        userCan(request: $request, permission: 'create_live_fcm_message');
        try {
            $status = $this->fcmMessageService->liveFcm(data: $request->validated());
            if(!$status)
                return redirect()->back()->with("message", __('lang.something_went_wrong'));
            return redirect()->route('fcm-messages.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        try{
            $fcmMessage = $this->fcmMessageService->findById(id: $id);
            return view('Dashboard.FcmMessages.show', compact('fcmMessage'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
    } //end of show

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $id)
    {
        userCan(request: $request, permission: 'edit_fcm_message');
        try{

            $fcmMessage = $this->fcmMessageService->findById(id: $id);
            $flags = FcmEventsNames::$FLAGS;
            $fcm_channels = FcmEventsNames::$CHANNELS;
            $fcm_actions = FcmEventsNames::$FCMACTIONS;
            return view('Dashboard.FcmMessages.edit', compact('fcmMessage','flags','fcm_channels','fcm_actions'));
        
        }catch(Exception $e){
            return redirect()->back()->with("message", $e->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FcmMessageUpdateRequest $request, $id)
    {
        userCan(request: $request, permission: 'edit_fcm_message');
        try {
            $result = $this->fcmMessageService->update($id, $request->validated());
            if(!$result)
                return redirect()->route('fcm-messaegs.index')->with('message', __('lang.something_went_wrong'));
            return redirect()->route('fcm-messages.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        userCan(request: $request, permission: 'delete_fcm_message');
        try {
            $result = $this->fcmMessageService->destroy($id);
            if (!$result)
                return redirect()->back()->with("message", __('lang.something_went_wrong'));
            return redirect()->back()->with("message", __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     * status method for change is_active column only
     */
    public function status(Request $request, int $id)
    {
        userCan(request: $request, permission: 'change_fcm_message_status');
        try {
            $result = $this->fcmMessageService->status(id: $id);
            if (!$result)
                return redirect()->back()->with("message", __('lang.something_went_wrong'));
            return redirect()->back()->with("message", __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of status
}
