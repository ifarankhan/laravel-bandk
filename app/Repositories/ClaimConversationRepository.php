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
     * ClaimConversationRepository constructor.
     * @param ClaimConversation $claimConversation
     * @param ClaimConversationFiles $claimConversationFiles
     */
    public function __construct(ClaimConversation $claimConversation, ClaimConversationFiles $claimConversationFiles)
    {
        $this->model = $claimConversation;
        $this->claimConversationFiles = $claimConversationFiles;
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

        if(isset($data['file']) && count($data['file']) > 0) {
            foreach ($data['file'] as $file) {
                $this->claimConversationFiles = new ClaimConversationFiles();
                $fileName = explode(',', $file->getClientOriginalName());
                $uniqueFileName = uniqid();

                if(isset($fileName[1])) {
                    $uniqueFileName = $uniqueFileName . '_' . $fileName[0] . '_'. $fileName[1];
                } else {
                    $uniqueFileName = $uniqueFileName . '_' . $fileName[0];
                }
                $uniqueFileName = $uniqueFileName.'.'.$file->getClientOriginalExtension();
                $file->move(config('app.path_to_upload_files') , $uniqueFileName);
                $this->claimConversationFiles->file_name = $uniqueFileName;
                $this->claimConversationFiles->claim_conversation_id = $claimConversation->id;
                $this->claimConversationFiles->save();
            }
        }

        return $claimConversation;



    }
}