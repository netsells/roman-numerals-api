<?php

namespace App\Listeners;

use App\Contracts\ConversionStorage;
use App\Events\ConversionCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PersistConversionToDatabase
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ConversionStorage $model)
    {
        $this->model = $model;
    }

    /**
     * Handle the event.
     *
     * @param  ConversionCompleted  $event
     * @return void
     */
    public function handle(ConversionCompleted $event)
    {
        $this->model->persist($event->arabic, $event->roman);
    }
}
