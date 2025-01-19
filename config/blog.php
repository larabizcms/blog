<?php

return [
    'repositories' => [
        \LarabizCMS\Modules\Blog\Repositories\PostRepository::class => \LarabizCMS\Modules\Blog\Repositories\PostRepositoryEloquent::class,
        \LarabizCMS\Modules\Blog\Repositories\TaxonomyRepository::class => \LarabizCMS\Modules\Blog\Repositories\TaxonomyRepositoryEloquent::class,
    ],
];
