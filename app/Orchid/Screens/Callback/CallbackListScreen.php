<?php

namespace App\Orchid\Screens\Callback;

use Orchid\Screen\Screen;

class CallbackListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'CallbackListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'CallbackListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
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
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [];
    }
}
