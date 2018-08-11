<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/11/2018
 * Time: 1:25 PM
 */

namespace App\Repositories;

interface ClaimConversationInterface
{
    public function getOne($id);

    public function all();

    public function create($data);
}