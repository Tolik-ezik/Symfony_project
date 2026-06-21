<?php

namespace App\Factory;

use App\DTO\Input\StorePostInputDTO;
use App\DTO\Output\Post\PostOutputDTO;
use App\Entity\Category;
use App\Entity\Post;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class PostFactory
{
    public function __construct(private EntityManagerInterface $em) {}
    public function makePost(StorePostInputDTO $storePostInputDTO): Post
    {
        $category = $this->em->getReference(Category::class, $storePostInputDTO->categoryId);
        $post = new Post();
        $post->setTitle($storePostInputDTO->title);
        $post->setDescription($storePostInputDTO->description);
        $post->setContent($storePostInputDTO->content);
        $post->setPublishedAt($storePostInputDTO->publishedAt);
        $post->setStatus($storePostInputDTO->status);
        $post->setCategory($category);
        return $post;
    }

    public function makeStorePostInoutDTO(array $data): StorePostInputDTO
    {
        $post = new StorePostInputDTO();
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->content = $data['content'];
        $post->publishedAt = new DateTimeImmutable($data['published_at']);
        $post->status = $data['status'];
        $post->categoryId = $data['category_id'];
        return $post;
    }

    public function makePostOutputDTO(Post $post): PostOutputDTO
    {
        $postOutout = new PostOutputDTO();
        $postOutout->title = $post->getTitle();
        $postOutout->description = $post->getDescription();
        $postOutout->content = $post->getContent();
        $postOutout->publishedAt = $post->getPublishedAt();
        $postOutout->status = $post->getStatus();
        $postOutout->category = $post->getCategory();
        return $postOutout;
    }
}
