<?php
namespace Modules\Video\Src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Video\Src\Models\Video;
use Modules\Video\Src\Repositories\VideoRepositoryInterface;


class VideoRepository extends BaseRepository implements VideoRepositoryInterface {

    public function getModel()
    {
        return Video::class;
    }

    public function createVideo($data, $url)
    {
        return $this->model->firstOrcreate($data, ['url' => $url]);
    }

}
