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
use LarabizCMS\Modules\Blog\Models\Taxonomy;
use LarabizCMS\Core\PageBuilder\Abstracts\FormBuilder;
use LarabizCMS\Core\PageBuilder\Elements\Card;
use LarabizCMS\Core\PageBuilder\Elements\Grids\Container;
use LarabizCMS\Core\PageBuilder\Elements\Grids\Col9;

class TaxonomyForm extends FormBuilder
{
    protected ?Taxonomy $model = null;

    public function withModel(Taxonomy $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function build(): static
    {
        $this->successAction()->navigate(admin_url('taxonomies'))->after(300);

        $locale = $this->getLanguage();
        $this->model?->setDefaultLocale($locale);
        $parents = Taxonomy::withTranslation()->get()
            ->pluck('name', 'id')
            ->toArray();

        $infoCard = Card::make(['title' => __('Information')]);
        $infoCard->add(
            Container::make()->add(
                [
                    Field::text("{$locale}.name")->value($this->model?->name),
                    Field::textarea("{$locale}.description")->value($this->model?->description),
				]
            )
        );

        $sidebarCard = Card::make(['title' => __('Sidebar')]);
        $sidebarCard->add(
            Container::make()->add(
                [
                    Field::language('locale')->value($locale),
                    Field::text("{$locale}.slug")->value($this->model?->slug),
                    Field::text('type')
                        ->value($this->model?->type)
                        ->default('category'),
                    Field::select('parent_id')
                        ->autocomplete()
                        ->options($parents)
                        ->value($this->model?->parent_id),
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
