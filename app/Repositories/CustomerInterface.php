<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 9/8/2018
 * Time: 10:51 AM
 */

namespace App\Repositories;

interface CustomerInterface
{
    public function all();

    public function getOne($id);

    public function store($data);

    public function delete($id);
}