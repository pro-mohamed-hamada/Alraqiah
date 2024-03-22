<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SettingStoreRequest;
use App\Http\Requests\Web\SettingUpdateRequest;
use App\Models\Setting;
use App\Services\SettingService;
use Exception;

class SettingsController extends Controller
{
    public function __construct(private SettingService $settingService)
    {

    }

    public function index(Request $request)
    {
        userCan(request: $request, permission: 'view_settings');
        try{
            $setting = Setting::first();
            return view('Dashboard.Settings.index', compact('setting'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
        
    }//end of create

    public function update(SettingUpdateRequest $request, $id)
    {
        userCan(request: $request, permission: 'edit_settings');
        try {
            $this->settingService->update($id, $request->validated());
            return redirect()->route('home')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

}
