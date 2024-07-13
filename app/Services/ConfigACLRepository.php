<?php

namespace App\Services;

use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class ConfigACLRepository
 *
 * Get rules from file-manager config file - aclRules
 *
 * @package Alexusmai\LaravelFileManager\Services\ACLService
 */
class ConfigACLRepository implements ACLRepository
{
    /**
     * Get user ID
     *
     * @return mixed
     */
    public function getUserID()
    {
        return Auth::guard('admin')->id();
    }

    /**
     * Get rules from file-manger.php config file
     *
     * @return array
     */
    public function getRules(): array
    {
        if (Auth::guard('admin')->user()->isAdmin) {
            return config('file-manager.aclRules')['admin'] ?? [];
        }
        return config('file-manager.aclRules')['default'] ?? [];
    }
}
