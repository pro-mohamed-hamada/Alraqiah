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
            if(!$result)
                return apiResponse(message: trans('lang.not_found'),code: 404);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (\Exception $e) {
            return apiResponse(message: $e->getMessage(),code: 422);
        }
    } //end of destroy

}
