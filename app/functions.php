<?php

use App\Enums\UserRoleEnum;

if (!function_exists('user')) {
    function user(): ?object
    {
        return auth()->guard('web')->user();
    }
}

if (!function_exists('admin')) {
    function admin(): ?object
    {
        return auth()->guard('admin')->user();
    }
}

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin(): bool
    {
        return admin() && admin()->role === UserRoleEnum::SUPER_ADMIN;
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin(): bool
    {
        return admin() && admin()->role === UserRoleEnum::ADMIN;
    }
}

if (!function_exists('isDoctor')) {
    function isDoctor(): bool
    {
        return auth()->guard('doctor')->check();
    }
}
