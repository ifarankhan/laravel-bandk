<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:51 PM
 */

namespace App\Repositories;

interface UserInterface
{
    public function all();

    public function store($data);
}