<?php

namespace App\Command;

use App\Factory\PostFactory;
use App\ResponseBuilder\PostResponseBuilder;
use App\Service\PostService;
use App\Validator\PostValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'GoCommand',
    description: 'Add a short description for your command',
)]
class GoCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private PostService $postService,
        private PostValidator $postValidator,
        private PostResponseBuilder $responseBuilder,
        private PostFactory $postFactory,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // //Добавление в базу данных
        // $data = ['title' => 'bleble', 'description' => 'bleble', 'content' => 'bleble', 'published_at' => '2020-02-02', 'status' => 2, 'category_id' => 1];
        // $category = $this->em->getRepository(Category::class)->find($data['category_id']);

        // $post = new Post();
        // $post->setTitle($data['title']);
        // $post->setDescription($data['description']);
        // $post->setContent($data['content']);
        // $post->setPublishedAt(new DateTimeImmutable($data['published_at']));
        // $post->setStatus($data['status']);
        // $post->setCategory($category);

        // $this->em->persist($post);
        // $this->em->flush();

        // //Обновление
        // $data = ['title' => 'ble', 'description' => 'editet', 'content' => 'bleble', 'published_at' => '2020-02-02', 'status' => 2, 'category_id' => 1];
        // $category = $this->em->getRepository(Category::class)->find($data['category_id']);
        // $post = $this->em->getRepository(Post::class)->find(2);
        // $post->setTitle($data['title']);
        // $post->setDescription($data['description']);
        // $post->setContent($data['content']);
        // $post->setPublishedAt(new DateTimeImmutable($data['published_at']));
        // $post->setStatus($data['status']);
        // $post->setCategory($category);
        // $this->em->persist($post);
        // $this->em->flush();

        // //Удаление
        // $post = $this->em->getRepository(Post::class)->find(2);
        // $this->em->remove($post);
        // $this->em->flush();

        $data = ['title' => 'bleble', 'description' => 'bleble', 'content' => 'bleble', 'published_at' => '2020-02-02', 'status' => 2, 'category_id' => 1];

        $storePostInputDTO = $this->postFactory->makeStorePostInoutDTO($data);
        $this->postValidator->validate($storePostInputDTO);
        $post = $this->postService->store($storePostInputDTO);
        $res = $this->responseBuilder->storePost($post);
        dd($res);

        return Command::SUCCESS;
    }
}
