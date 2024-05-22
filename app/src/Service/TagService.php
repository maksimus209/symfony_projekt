<?php

namespace App\Service;

use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TagService
 *
 * @package App\Service
 */
class TagService implements TagServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * TagService constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Create a new Tag.
     *
     * @param Tag $tag
     * @return void
     */
    public function create(Tag $tag): void
    {
        $this->entityManager->persist($tag);
        $this->entityManager->flush();
    }

    /**
     * Update an existing Tag.
     *
     * @param Tag $tag
     * @return void
     */
    public function update(Tag $tag): void
    {
        $this->entityManager->flush();
    }

    /**
     * Delete a Tag.
     *
     * @param Tag $tag
     * @return void
     */
    public function delete(Tag $tag): void
    {
        $this->entityManager->remove($tag);
        $this->entityManager->flush();
    }
}
