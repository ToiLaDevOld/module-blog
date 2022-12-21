<?php

namespace ToiLaDev\Blog\DataTables;

use Illuminate\Database\Eloquent\Builder;
use ToiLaDev\Blog\Repositories\PostRepository;
use ToiLaDev\DataTables\Base\Acast;
use ToiLaDev\DataTables\Base\Action;
use ToiLaDev\DataTables\Base\BaseDataTable;
use ToiLaDev\DataTables\Base\Date;
use ToiLaDev\DataTables\Base\Id;
use ToiLaDev\DataTables\Base\Image;
use ToiLaDev\DataTables\Base\Normal;

class PostsDataTable extends BaseDataTable
{

    protected function columns(): array
    {
        return [
            new Id(),
            new Image(),
            new Normal('name'),
            new Date('created_at'),
            new Acast()
        ];
    }

    public function query(PostRepository $repository): Builder
    {
        return $repository->datatable('cast');
    }
}
