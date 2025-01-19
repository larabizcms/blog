<?php
/**
 * LARABIZ CMS - Full SPA Laravel CMS
 *
 * @package    larabizcms/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com
 */

namespace LarabizCMS\Modules\Blog\Http\Forms;

use LarabizCMS\Core\Facades\Field;
use LarabizCMS\Core\PageBuilder\Elements\Grids\Col3;
use LarabizCMS\Core\PageBuilder\Elements\Grids\Col9;
use LarabizCMS\Modules\Blog\Models\Enums\PostStatus;
use LarabizCMS\Modules\Blog\Models\Post;
use LarabizCMS\Core\PageBuilder\Abstracts\FormBuilder;
use LarabizCMS\Core\PageBuilder\Elements\Card;
use LarabizCMS\Core\PageBuilder\Elements\Grids\Container;

class PostForm extends FormBuilder
{
    protected ?Post $model = null;

    public function withModel(Post $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function build(): static
    {
        $this->successAction()->navigate(admin_url('posts'))->after(300);

        $locale = $this->getLanguage();
        $this->model?->setDefaultLocale($locale);

        $infoCard = Card::make(['title' => __('Information')]);
        $infoCard->add(
            Container::make()->add(
                [
                    Field::text("{$locale}.title")->value($this->model?->title),
                    Field::editor("{$locale}.content")->value($this->model?->content),
				]
            )
        );

        $sidebarCard = Card::make(['title' => __('Sidebar')]);
        $sidebarCard->add(
            Container::make()->add(
                [
                    Field::language('locale')->value($locale),
                    Field::text("{$locale}.thumbnail")->value($this->model?->thumbnail),
                    Field::text("{$locale}.slug")->value($this->model?->slug),
                    Field::select('status')
                        ->options(PostStatus::options())
                        ->value($this->model?->status),
                ]
            )
        );

        $this->add(
            Col9::make()->add($infoCard),
            Col3::make()->add($sidebarCard)
        );

        return $this;
    }
}
