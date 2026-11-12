<?php

namespace App\Controller;

use App\Service\NotificationService;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class TestController
{

    public function __construct(
        private NotificationService $notificationService
    ) {}


    #[Route('/', name: 'attribute_test')]
    public function test(): Response
    {

        $email = $this->notificationService->sendEmailNotification('Test email');
        $cms = $this->notificationService->sendSmsNotification('Test SMS');

        return new Response(
            '<html>
                        <body>
                            <h1>Test of the using the own attribute for method\'s flag </h1>
                            <p>Parameter AB in .env = '.$_ENV['AB'] . '</p>
                            <ul>
                            <li><strong>Email</strong>: ' . $email . '</li>
                            <li><strong>SMS</strong>: ' . $cms . '</li>
                            </ul>
                            <input type="button" value="Reload page" onclick="location.href=\'/?x=\'+Date.now();"
                        </body>
                    </html>'
        );
    }
}
