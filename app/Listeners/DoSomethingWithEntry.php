<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Statamic\Entries\Entry;
use Statamic\View\View;

class DoSomethingWithEntry implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var Entry
     */
    protected $entry;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $this->entry = $event->entry;

        $html = (new View())
            ->template('articles/show')
            ->with(
                $this->entry
                    ->toAugmentedCollection()
                    ->map->value()
                    ->all(),
            )
            ->render();

        Log::info($html);
    }
}
