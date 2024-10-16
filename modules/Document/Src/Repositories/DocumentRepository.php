<?php
namespace Modules\Document\Src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Document\Src\Models\Document;
use Modules\Document\Src\Repositories\DocumentRepositoryInterface;


class DocumentRepository extends BaseRepository implements DocumentRepositoryInterface {

    public function getModel()
    {
        return Document::class;
    }

    public function createDocument($data) {
        return $this->model->firstOrcreate($data);
    }

}
