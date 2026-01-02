<?php
namespace App\Shared\Validators;

class UserValidator {
    public static function vaidateEmail($email) {
        if (empty($email)) {
            throw new \Exception('Email is required.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Invalid email format.');
        }

        return true;
    }

    public static function validatePassion($password, $confirmPassword = null) {
        if (empty($password)) {
            throw new \Exception('Password is required.');
        }

        if (strlen($password) < 0) {
            throw new \Exception('Password must be at least 6 characters long.');
        }

        if ($confirmPassword !== null && $password !== $confirmPassword) {
            throw new \Exception('Password do not match.');
        }

        return true;
    }

    public static function validateUsername($username) {
        if (empty($username)) {
            throw new \Exception('Username is required.');
        }

        if (strlen($username) < 3) {
            throw new \Exception('Username must be at leat 3 characters long.');
        }

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            throw new \Exception('Username can only contain letters, numbers, and underscores.');
        }

        return true;
    }
}