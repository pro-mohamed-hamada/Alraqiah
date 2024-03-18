<?php

namespace App\Services;

use App\Enum\ActivationStatusEnum;
use App\Enum\UserTypeEnum;
use App\Events\PushEvent;
use App\Exceptions\NotFoundException;
use App\Models\Complaint;
use App\Models\ComplaintReplay;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Faq;
use App\Models\FcmMessage;
use App\QueryFilters\ComplaintsFilter;
use App\QueryFilters\FaqsFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ComplaintReplayService extends BaseService
{
    public function __construct(private ComplaintReplay $model){

    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function store(array $data = []):Faq|Model|bool
    {
        $data['sender_id'] = auth()->user()->id;
        $complaint = Complaint::find($data['complaint_id']);
        $complaintReplay = $this->getModel()->create($data);
        if (!$complaintReplay)
            return false ;
        $complaint->is_active = ActivationStatusEnum::ACTIVE;
        $complaint->save();

        //notify the users the complaint created
        $userType = Auth::user()->type;
        if($userType != UserTypeEnum::CLIENT)
        {
            $users[0] = $complaint->user;
            event(new PushEvent( users: $users, action: FcmMessage::SUPERVISOR_REPLIED_ON_COMPLAINT));
        }
        
        return $complaintReplay;
    } //end of store

    public function update(int $id, array $data=[])
    {
        $complaintReplay = $this->findById($id);
        $data['sender_id'] = auth()->user()->id;
        $complaintReplay->update($data);
        return $complaintReplay;
    }

    /**
     * @throws NotFoundException
     */
    public function destroy($id)
    {
        $complaintReplay = $this->findById($id);
        return $complaintReplay->delete();
    } //end of delete

}
