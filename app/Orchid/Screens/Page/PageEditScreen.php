<?php

namespace App\Orchid\Screens\Page;

use App\Models\Page;
use App\Orchid\Layouts\SlugListener;
use Illuminate\Support\Str;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class PageEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Редактировать страницу';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = '';

    private $page;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Page $page): array
    {
        $this->page = $page;

        if (!$page->exists) {
            $this->name = 'Добавить страницу';
        }

        return [
            'page' => $page
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }


    /**
     * @param $title
     * @return array
     */
    public function asyncSlugListener($title)
    {

        $slug = Str::slug($title, '-');
        return [
            'page.slug' => $slug
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::tabs([
                'Содержимое' => [
                    Layout::rows([
                        Group::make([
                            Input::make('page.title')
                                ->title('Заголовок')
                                ->placeholder('Введите заголовок страницы')
                                ->required(),

                            Input::make('page.slug')
                                ->title('Введите "SLUG"')
                                ->placeholder()
                                ->help("Допускоется введение символов a-z, 0-9 и _-")
                                ->required()
                        ]),

                        Group::make([
                            Relation::make('page.')
                                ->fromModel(Page::class, 'title', "parent_id")
                                ->title('Вложенность'),
                            RadioButtons::make('page.published')
                                ->title('Активность')
                                ->options([
                                    1 => 'Активна',
                                    0 => 'Не активна',
                                ])
                                ->value(1),
                        ]),

                    ]),

                    Layout::rows([
                        Quill::make('page.content')
                            ->title('')
                            ->popover(''),

                    ])
                ],
                'SEO' => [
                    Layout::rows([
                        Input::make('meta_title')
                            ->title('TITLE - заголовок')
                            ->placeholder('Введите заголовок страницы'),

                        TextArea::make('meta_description')
                            ->rows(5)
                            ->title('Description - описание')
                            ->placeholder('Введите описание страницы'),
                    ])
                ]

            ]),

            SlugListener::class
        ];
    }
}
