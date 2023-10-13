<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface CommentServiceInterface
{
    public function createComment(Request $request);

    public function updateComment(Request $request, int $id);

    public function deleteCommentById(int $id);
}
