<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_category', 'slug', 'title', 'desc', 'price', 'is_available', 'image', 'id_user'];
    protected $useTimestamps = true;

    public function getProductsWithCategory()
    {
        return $this->select('product.*, category.title as category_title')
                    ->join('category', 'category.id = product.id_category')
                    ->findAll();
    }

    public function getProductsWithCategoryAndUserAndSlugs()
    {
        return $this->select('product.*, category.title as category_title, user.name as user_name, category.slug as category_slug')
                    ->join('category', 'category.id = product.id_category')
                    ->join('user', 'user.id = product.id_user')
                    ->findAll();
    }

    public function getProductBySlugs($categorySlug, $productSlug)
    {
        return $this->select('product.*, category.title as category_title, category.slug as category_slug, user.name as user_name')
                    ->join('category', 'category.id = product.id_category')
                    ->join('user', 'user.id = product.id_user')
                    ->where('category.slug', $categorySlug)
                    ->where('product.slug', $productSlug)
                    ->first();
    }
}
