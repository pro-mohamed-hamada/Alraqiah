<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\FaqStoreRequest;
use App\Http\Requests\Web\FaqUpdateRequest;
use App\Models\Relative;
use App\Services\FaqService;
use App\Services\RelativeService;
use Exception;

class RelativesController extends Controller
{
    public function __construct(private RelativeService $relativeService)
    {

    }

    public function destroy($id)
    {
        try {
            $result = $this->relativeService->destroy($id);
            if (!$result)
                return redirect()->back()->with("message", __('lang.not_found'));
            return redirect()->back()->with("message", __('lang.success_operation'));
        } catch (\Exception $e) {
            return redirect()->back()->with("message", $e->getMessage());
        }
    } //end of destroy

}
