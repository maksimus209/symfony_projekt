<?php

namespace App\Service;

use App\Entity\Tag;

/**
 * Interface TagServiceInterface
 *
 * @package App\Service
 */
interface TagServiceInterface
{
    /**
     * Create a new Tag.
     *
     * @param Tag $tag
     * @return void
     */
    public function create(Tag $tag): void;

    /**
     * Update an existing Tag.
     *
     * @param Tag $tag
     * @return void
     */
    public function update(Tag $tag): void;

    /**
     * Delete a Tag.
     *
     * @param Tag $tag
     * @return void
     */
    public function delete(Tag $tag): void;
}
