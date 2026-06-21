<?php

namespace App\Resource;

use App\DTO\Output\Post\PostOutputDTO;
use Symfony\Component\Serializer\SerializerInterface;

class PostResource
{

    public function __construct(private SerializerInterface $serializer)
    {
        
    }
    public function postItem(PostOutputDTO $post)
    {
        return $this->serializer->serialize($post, 'json', ['groups'=> ['post:item']]);
    }
}
