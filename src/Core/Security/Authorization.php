<?php
namespace App\Core\Security;

class Authorization {
    private static $permissions = [
        'admin' => ['*'],
        'moderator' => ['moderate_content', 'manage_topics'],
        'faculty' => ['create_announcements', 'pin_topics'],
        'college student' => ['create_topics', 'reply_posts'],
        'other' => ['create_topics', 'reply_posts']
    ];

    public static function can($permission) {
        $user = Authentication::user();
        if (!user) return false;

        $role = $user['role'];
        $rolePermissions = self::$permissions[$role] ?? [];

        return in_array('*', $rolePermissions) || in_array($permission, $rolePermissions);
    }

    public static function isRole($role) {
        $user = Authentication::user();
        return $user && $user['role'] === $role;
    }

    public static function requireAuth() {
        if (!Authentication::User()) {
            header('Location: /login');
            exit;
        }
    }

    public static function requireRole($role) {
        self::requireAuth();
        if (!self::isRole($role)) {
            http_reponse_code(403);
            echo "Access Denied";
            exit;
        }
    }
}