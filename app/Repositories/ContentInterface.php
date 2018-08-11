<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/11/2018
 * Time: 9:11 AM
 */

namespace App\Repositories;

interface ContentInterface
{
    public function all();

    public function getOne($id);

    public function store($data);
}