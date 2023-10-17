<?php

namespace App\Contracts\Dao;

interface CommentDaoInterface
{
    public function createComment(array $data);

    public function updateComment(array $data, int $id);

    public function deleteCommentById(int $id);

    public function getCommentById(int $id);
}
