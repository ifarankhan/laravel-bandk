<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 10:20 PM
 */

namespace App\Repositories;

interface ClaimInterface
{
    public function all($user = null);

    public function createClaim($data);
}