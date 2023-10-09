<?php

namespace App\Contracts\Services;

interface PostServiceInterface
{
    public function getPosts(): object;

    public function createPost(array $data): void;

    public function getPostById(int $id): object;

    public function updatePost(array $data, int $id): void;

    public function deletePostById(int $id): void;
}
