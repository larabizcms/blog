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
use LarabizCMS\Modules\Blog\Models\Post;
use LarabizCMS\Core\PageBuilder\Abstracts\FormBuilder;
use LarabizCMS\Core\PageBuilder\Elements\Card;
use LarabizCMS\Core\PageBuilder\Elements\Grids\Container;
use LarabizCMS\Core\PageBuilder\Elements\Grids\Col12;

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

        $infoCard = Card::make(['title' => __('Information')]);
        $infoCard->add(
            Container::make()->add(
                [
					Field::text('type')->value($this->model?->type),
					Field::text('status')->value($this->model?->status)
				]
            )
        );

        $this->add(Col12::make()->add($infoCard));

        return $this;
    }
}
