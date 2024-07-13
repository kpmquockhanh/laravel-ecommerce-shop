<?php

namespace App\enums;

enum PermissionEnum: string
{
    case VIEW_PRODUCT = 'view_product';
    case EDIT_PRODUCT = 'edit_product';
    case CREATE_PRODUCT = 'create_product';
    case DELETE_PRODUCT = 'delete_product';
    case VIEW_CATEGORY = 'view_category';
    case EDIT_CATEGORY = 'edit_category';
    case CREATE_CATEGORY = 'create_category';
    case DELETE_CATEGORY = 'delete_category';
    case VIEW_BLOG = 'view_blog';
    case CREATE_BLOG = 'create_blog';
    case EDIT_BLOG = 'edit_blog';
    case DELETE_BLOG = 'delete_blog';
    case VIEW_BLOG_CATEGORY = 'view_blog_category';
    case CREATE_BLOG_CATEGORY = 'create_blog_category';
    case EDIT_BLOG_CATEGORY = 'edit_blog_category';
    case DELETE_BLOG_CATEGORY = 'delete_blog_category';
    case MANAGE_ACCOUNTS = 'manage_account';
    case MANAGE_SETTINGS = 'manage_settings';
    case MANAGE_IMAGES = 'manage_images';

    public function label(): string
    {
        return match ($this) {
// Product
            static::VIEW_PRODUCT => 'View Product',
            static::EDIT_PRODUCT => 'Edit Product',
            static::CREATE_PRODUCT => 'Create Product',
            static::DELETE_PRODUCT => 'Delete Product',
// Category
            static::VIEW_CATEGORY => 'View Category',
            static::EDIT_CATEGORY => 'Edit Category',
            static::CREATE_CATEGORY => 'Create Category',
            static::DELETE_CATEGORY => 'Delete Category',
// Blog
            static::VIEW_BLOG => 'View Blog',
            static::CREATE_BLOG => 'Create Blog',
            static::EDIT_BLOG => 'Edit Blog',
            static::DELETE_BLOG => 'Delete Blog',
// Blog Category
            static::VIEW_BLOG_CATEGORY => 'View Blog Category',
            static::CREATE_BLOG_CATEGORY => 'Create Blog Category',
            static::EDIT_BLOG_CATEGORY => 'Edit Blog Category',
            static::DELETE_BLOG_CATEGORY => 'Delete Blog Category',
// Account
            static::MANAGE_ACCOUNTS => 'Manage Accounts',
// Settings
            static::MANAGE_SETTINGS => 'Manage Settings',
// Image
            static::MANAGE_IMAGES => 'Manage Images',
            default => $this->value,
        };
    }
}
