<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CommentServiceInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{    
    /**
     * commentService
     *
     * @var mixed
     */
    private $commentService;
    
    /**
     * __construct
     *
     * @param  mixed $commentServiceInterface
     * @return void
     */
    public function __construct(CommentServiceInterface $commentServiceInterface)
    {
        $this->commentService = $commentServiceInterface;
    }
    
    /**
     * storeComment
     *
     * @param  mixed $request
     * @return void
     */
    public function storeComment(Request $request)
    {
        $request->validate([
            'post_id' => 'required|integer',
            'comment' => 'required',
        ]);
        $comment = $this->commentService->createComment($request);
        return response()->json($comment);
    }
    
    /**
     * updateComment
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function updateComment(Request $request, int $id)
    {
        $request->validate([
            'post_id' => 'integer|required',
            'comment' => 'required',
        ]);
        $comment = $request->all();
        $this->commentService->updateComment($request, $id);
        return response()->json($comment);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy(int $id)
    {
        $comment = $this->commentService->deleteCommentById($id);
        return response()->json($comment);
    }
}
