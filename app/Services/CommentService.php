<?php

namespace App\Services;

use App\Contracts\Dao\CommentDaoInterface;
use App\Contracts\Services\CommentServiceInterface;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentService implements CommentServiceInterface
{
    /**
     * CommentDao
     *
     * @var mixed
     */
    protected $CommentDao;

    /**
     * __construct
     *
     * @param  mixed $CommentDao
     * @return void
     */
    public function __construct(CommentDaoInterface $CommentDao)
    {
        $this->CommentDao = $CommentDao;
    }

    /**
     * createComment
     *
     * @param  mixed $request
     * @param  mixed $data
     * @return Comment
     */
    public function createComment(Request $request): Comment
    {
        $data = [
            'post_id' => $request->post_id,
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,
        ];
        return $this->CommentDao->createComment($data);
    }

    /**
     * updateComment
     *
     * @param  mixed $request
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateComment(Request $request, int $id)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,
        ];
        $this->CommentDao->updateComment($data, $id);
    }

    /**
     * deleteCommentById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteCommentById(int $id)
    {
        $this->CommentDao->deleteCommentById($id);
    }
}
