<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 9:36 PM
 */

namespace App\Repositories;


use App\ClaimConversation;
use App\ClaimConversationFiles;
use Carbon\Carbon;

class ClaimConversationRepository implements ClaimConversationInterface
{
    /**
     * @var ClaimConversation
     */
    private $model;
    /**
     * @var ClaimConversationFiles
     */
    private $claimConversationFiles;
    /**
     * @var ClaimInterface
     */
    private $claim;

    /**
     * ClaimConversationRepository constructor.
     * @param ClaimConversation $claimConversation
     * @param ClaimConversationFiles $claimConversationFiles
     * @param ClaimInterface $claim
     */
    public function __construct(ClaimConversation $claimConversation,
                                ClaimConversationFiles $claimConversationFiles,
                                ClaimInterface $claim)
    {
        $this->model = $claimConversation;
        $this->claimConversationFiles = $claimConversationFiles;
        $this->claim = $claim;
    }

    public function getOne($id)
    {
        return $this->model->find($id);
    }

    public function all()
    {
        return $this->model->all();
    }
    public function create($data)
    {
        $data['user_id'] = \Auth::user()->id;
        $claimConversation = $this->model->create($data);

        /*$email = 'mno@bk-as.dk';
        $claim = $this->claim->getOne($data['claim_id']);
        $customer = ($claim->customer) ? $claim->customer : null;
        $this->claim->sendEmailOnUpdate($email, $customer, $claim);*/

        if(isset($data['file']) && count($data['file']) > 0) {

            foreach ($data['file'] as $file) {
                $this->claimConversationFiles = new ClaimConversationFiles();
                $fileName = explode(',', $file->getClientOriginalName());
                $uniqueFileName = uniqid();
                $now = Carbon::now();
                $unique_code = $now->format('YmdHisu');
//                if(isset($fileName[1])) {
//                    $uniqueFileName = $uniqueFileName . '_' . $fileName[0] . '_'. $fileName[1];
//                } else {
//                    $uniqueFileName = $uniqueFileName . '_' . $fileName[0];
//                }
                $uniqueFileName = $uniqueFileName."_".$unique_code;
                $uniqueFileName = $uniqueFileName.'.'.$file->getClientOriginalExtension();
                $file->move(config('app.path_to_upload_files') , $uniqueFileName);
                $this->claimConversationFiles->file_name = $uniqueFileName;
                $this->claimConversationFiles->claim_conversation_id = $claimConversation->id;
                $this->claimConversationFiles->save();
            }
        }

        return $claimConversation;
    }

    public function delete($id)
    {
        $file = $this->claimConversationFiles->find($id);
        if($file) {
            return $file->delete();
        }
        return false;
    }
}
