<?php

namespace App\DTO\Output\Post;

use App\Entity\Category;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints\Collection;

class PostOutputDTO
{
    #[Groups(groups: ['post:item'])]

    public ?int $id = null;

    #[Groups(groups: ['post:item'])]
    public ?string $title = null;

    #[Groups(groups: ['post:item'])]
    public ?string $description = null;

    #[Groups(groups: ['post:item'])]
    public ?string $content = null;

    #[Groups(groups: ['post:item'])]
    public ?\DateTimeImmutable $publishedAt = null;

    #[Groups(groups: ['post:item'])]
    public ?int $status = 1;

    #[Groups(groups: ['post:item'])]
    public ?Category $category = null;

    #[Groups(groups: ['post:item'])]
    public Collection $tags;
}
