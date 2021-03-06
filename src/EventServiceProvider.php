<?php

namespace Yeganehha\DynamicForms;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Yeganehha\DynamicForms\app\Events\bladeDynamicFormsEvent;
use Yeganehha\DynamicForms\app\Events\typefieldsForDynamicFormsEvent;
use Yeganehha\DynamicForms\app\Listeners\defaultFieldsDynamicFormsListener;
use Yeganehha\DynamicForms\app\Listeners\defaultTemplatesDynamicFormsListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        typefieldsForDynamicFormsEvent::class=>[
            defaultFieldsDynamicFormsListener::class,
        ],
        bladeDynamicFormsEvent::class=>[
            defaultTemplatesDynamicFormsListener::class,
        ]
    ];

}
