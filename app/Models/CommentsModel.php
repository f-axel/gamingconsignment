<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentsModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_product', 'id_user', 'comment'];
    protected $useTimestamps = true;

    public function getCommentsByProduct($productId)
    {
        return $this->select('comments.*, user.name as user_name')
                    ->join('user', 'user.id = comments.id_user')
                    ->where('comments.id_product', $productId)
                    ->orderBy('comments.created_at', 'DESC')
                    ->findAll();
    }
}
