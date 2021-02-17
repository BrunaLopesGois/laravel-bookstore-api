<?php

namespace App\Repositories;

interface BookRepositoryInterface
{
    public function findAll();
    public function findById($id);
}
