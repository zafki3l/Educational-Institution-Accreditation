<?php

namespace App\Presentation\Http\Controllers;

use App\Business\Auth\AuthFacade;
use App\Business\Auth\LockTimeProcessor;
use App\Business\Auth\SessionProcessor;
use App\Presentation\Http\Requests\Auth\LoginRequest;
use App\Presentation\Http\Traits\HttpResponse;
use Core\Controller;

/**
 * Class AuthController
 * Handles login and logout.
 */
class AuthController extends Controller
{
    use HttpResponse;

    // Constructor
    public function __construct(
        private AuthFacade $authFacade,
        private SessionProcessor $sessionProcessor
    ) {}

    public function showLogin(): mixed
    {
        return $this->view(
            'auth/login',
            'homepage.layouts',
            ['title' => 'Login']
        );
    }

    public function login(): void
    {
        $_SESSION['attempt_failed'] = isset($_SESSION['attempt_failed']) ? $_SESSION['attempt_failed'] : 0;
        $_SESSION['lock_time'] = isset($_SESSION['lock_time']) ? $_SESSION['lock_time'] : 0;

        //Handle lock
        if (LockTimeProcessor::isLocked()) {
            $this->back();
        }

        // Get email & password from request
        $request = new LoginRequest($_POST);

        // Handles errors
        $errors = $this->authFacade->handleError($request);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $this->back();
        }

        $login_user = $this->authFacade->getLoginUser($request);

        $_SESSION['user'] = $this->sessionProcessor->setUserSession($login_user);

        $afterLoginRoute = $this->authFacade->afterLogin($_SESSION['user']['role_id']);
        $this->redirect($afterLoginRoute);

        unset($_SESSION['attempt_failed'], $_SESSION['lock_time']);
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();

            $this->redirect('/login');
        }
    }
}
