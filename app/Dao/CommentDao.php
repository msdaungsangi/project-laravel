<?php

namespace App\Dao;

use App\Contracts\Dao\CommentDaoInterface;
use App\Models\Comment;

class CommentDao implements CommentDaoInterface
{    
    /**
     * createComment
     *
     * @param  mixed $data
     * @return Comment
     */
    public function createComment(array $data): Comment
    {
        $comment = Comment::create($data);
        return $comment;
    }
    
    /**
     * updateComment
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateComment(array $data, int $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($data);
    }
    
    /**
     * deleteCommentById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteCommentById(int $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
    }
    
    /**
     * getCommentById
     *
     * @param  int $id
     * @return void
     */
    public function getCommentById(int $id)
    {
        return Comment::findOrFail($id);
    }
}
