<?php
namespace Modules\Students\Src\Repositories;

use App\Repositories\RepositoryInterface;

interface StudentsRepositoryInterface extends RepositoryInterface {
    public function getStudents($limit);

    public function setPassword($password, $id);

    public function checkPassword($password, $id);
}
