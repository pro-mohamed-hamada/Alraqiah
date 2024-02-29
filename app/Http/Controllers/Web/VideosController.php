<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\VideoStoreRequest;
use App\Http\Requests\Web\VideoUpdateRequest;
use App\Services\VideoService;
use Exception;

class VideosController extends Controller
{
    public function __construct(private VideoService $videoService)
    {

    }

    public function index(Request $request)
    {
        
        $filters =  $request->all();
        $videos = $this->videoService->getAll(['filters'=>$filters]);
        return View('Dashboard.Videos.index', compact(['videos']));
    }//end of index

    public function edit(Request $request, $id)
    {
        try{
            $video = $this->videoService->findById(id: $id, withRelations:[]);
            return view('Dashboard.Videos.edit', compact('video'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
        
    }//end of create

    public function create(Request $request)
    {
        return view('Dashboard.Videos.create');
    }//end of create

    public function store(VideoStoreRequest $request)
    {
        try {
            $this->videoService->store($request->validated());
            return redirect()->route('videos.index')->with('message', __('lang.success_operation'));
        } catch (Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }//end of store

    public function update(VideoUpdateRequest $request, $id)
    {
        try {
            $this->videoService->update($id, $request->validated());
            return redirect()->route('videos.index')->with('message', __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of update

    public function destroy($id)
    {
        try {
            $result = $this->videoService->destroy($id);
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
            $video = $this->videoService->findById(id: $id, withRelations:['attachments']);
            return view('Dashboard.Videos.show', compact('video'));
        }catch(Exception $e){
            return redirect()->back()->with("message", __('lang.something_went_wrong'));
        }
    } //end of show

}
