<?php

namespace App\Service;

use App\Attribute\CheckEnvironmentFlag;

class NotificationService
{

    #[CheckEnvironmentFlag(paramName: 'AB')]
    public function sendSmsNotification(string $message): string
    {
        // This code will execute ONLY if AB=1 is specified in .env
        return "SMS отправлено: " . $message;
    }

    public function sendEmailNotification(string $message): string
    {
        // This method will always execute, as it does not have an attribute.
        return "Email отправлен: " . $message;
    }
}
