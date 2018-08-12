<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/11/2018
 * Time: 9:11 AM
 */

namespace App\Repositories;

interface CategoryInterface
{
    public function all();

    public function getOne($id);

    public function store($data);
}