<?php

namespace App\Observers;

use App\Models\Event;

class EventObserver
{
    public function deleted(Event $event)
    {
        // вызов метода отправки почты при удалении записи
    }
}
