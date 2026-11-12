<?php

namespace App\Proxy;

use App\Attribute\CheckEnvironmentFlag;
use App\Service\NotificationService;

// We inherit from the original class to bypass strict typing in the controller.
class EnvFlagProxy extends NotificationService
{
    public function __construct(
        private readonly NotificationService $originalService
    ) {}

    private function shouldExecute(string $methodName): bool
    {
        $reflectionMethod = new \ReflectionMethod($this->originalService, $methodName);
        $attributes = $reflectionMethod->getAttributes(CheckEnvironmentFlag::class);

        if (!empty($attributes)) {
            /** @var CheckEnvironmentFlag $attributeInstance */
            $attributeInstance = $attributes[0]->newInstance();

            $envValue = $_ENV[$attributeInstance->paramName]
                ?? $_SERVER[$attributeInstance->paramName]
                ?? getenv($attributeInstance->paramName)
                ?? '0';

            return (string)$envValue === '1';
        }

        return true; // If the attribute is absent, we allow execution.
    }

    // We explicitly override the methods that need to be monitored:

    public function sendSmsNotification(string $message): string
    {
        if ($this->shouldExecute(__FUNCTION__)) {
            return $this->originalService->sendSmsNotification($message);
        }
        return 'Was not executed';
    }
}
