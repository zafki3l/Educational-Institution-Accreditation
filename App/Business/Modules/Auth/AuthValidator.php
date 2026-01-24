<?php

namespace App\Business\Modules\Auth;

use App\Presentation\Http\Requests\Auth\LoginRequest;
use Core\Validator;

/**
 * This class centralizes auth validation rules.
 */
class AuthValidator extends Validator
{
    /**
     * If it returns errors, stop the login. If it returns null, keep going.
     * By returning generic messages, 
     * we prevent "Account Enumeration"—an attack where hackers find valid 
     * usernames by checking which ones return a "user not found" error.
     * 
     * @param array $user
     * @param LoginRequest $request
     * @return string[]
     */
    public function loginErrorHandling(array $user, LoginRequest $request): array
    {
        $errors = [];
        $genericError = 'Invalid email or password.';

        $isEmailExist = $this->isEmailExist($user);
        if (!$isEmailExist) {
            $errors['auth'] = $genericError;
        }

        if ($this->emptyInput($request->getEmail())) {
            $errors['email'] = $genericError;
        }

        // Verify password even if email doesnt exist. 
        // To prevents hackers can guess existed user by guessing executing time.
        $user_password = $user[0]['password'];
        $isPasswordCorrect = $this->isPasswordCorrect($user_password, $request->getPassword());
        
        if (!$isPasswordCorrect) {
            $errors['auth'] = $genericError;
            $errors['lockout'] = $this->handleFailedAttempt();
        }

        return $errors;
    }

    /**
     * Lock the user if they make too many failed attempts to prevents "Brute Force"
     */
    private function handleFailedAttempt(): string
    {
        $_SESSION['attempt_failed'] = ($_SESSION['attempt_failed'] ?? 0) + 1;

        if ($_SESSION['attempt_failed'] >= 5) {
            $_SESSION['lock_time'] = time() + LockTimeProcessor::LOCK_TIME;
            $_SESSION['attempt_failed'] = 0;

            return 'Too many attempts. Please try again later.';
        }
        
        $remain = 5 - $_SESSION['attempt_failed'];
        return "Remaining attempts: $remain";
    }

    private function isEmailExist(array $result): bool
    {
        return !empty($result);
    }

    private function isPasswordCorrect(?string $db_password, ?string $user_input): bool
    {
        return password_verify($user_input, $db_password);
    }
}