<?php

namespace App\ResponseBuilder;

use App\Entity\Post;
use App\Factory\PostFactory;
use App\Resource\PostResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostResponseBuilder
{

    public function __construct(private PostResource $postResource, private PostFactory $postFactory) {}
    public function storePost(Post $post, $status = 200, $headers = [], $isJson = true): JsonResponse
    {
        $postOutputDTO = $this->postFactory->makePostOutputDTO($post);
        $postResource = $this->postResource->postItem($postOutputDTO);
        return new JsonResponse($postResource, $status, $headers, $isJson);
    }
}
