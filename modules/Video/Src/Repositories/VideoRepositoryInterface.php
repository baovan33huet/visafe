<?php
namespace Modules\Video\Src\Repositories;

use App\Repositories\RepositoryInterface;

interface VideoRepositoryInterface extends RepositoryInterface {
    public function createVideo($data, $url);

}
