<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 9:36 PM
 */

namespace App\Repositories;


use App\ClaimImages;
use App\Claims;

class ClaimRepository implements ClaimInterface
{
    /**
     * @var Claims
     */
    private $model;
    /**
     * @var ClaimImages
     */
    private $claimImages;

    /**
     * ClaimRepository constructor.
     * @param Claims $claims
     * @param ClaimImages $claimImages
     */
    public function __construct(Claims $claims, ClaimImages $claimImages)
    {
        $this->model = $claims;
        $this->claimImages = $claimImages;
    }

    public function all($user = null)
    {
        return $this->model->all();
    }
    public function createClaim($data)
    {
        $data['user_id'] = \Auth::user()->id;
        $claim = $this->model->create($data);

        if(isset($data['images']) && count($data['images']) > 0) {
            foreach ($data['images'] as $image) {
                $this->claimImages = new ClaimImages();
                $uniqueFileName = uniqid() . $image->getClientOriginalName();
                $image->move(config('app.path_to_upload') , $uniqueFileName);
                $this->claimImages->image = $uniqueFileName;
                $this->claimImages->claim_id = $claim->id;
                $this->claimImages->save();
            }
        }

        return $claim;



    }
}