<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CommentServiceInterface;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse
     */
    public function storeComment(Request $request): JsonResponse
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
     * @param  int $id
     * @return JsonResponse
     */
    public function updateComment(Request $request, int $id): JsonResponse
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
     * @param  int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $comment = $this->commentService->deleteCommentById($id);
        return response()->json($comment);
    }
}
