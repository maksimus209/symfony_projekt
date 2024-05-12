<?php
/**
 * Task repository.
 */

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class TaskRepository.
 *
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @extends ServiceEntityRepository<Task>
 *
 * @psalm-suppress LessSpecificImplementedReturnType
 */
class TaskRepository extends ServiceEntityRepository
{
    /**
     * Items per page.
     *
     * Use constants to define configuration options that rarely change instead
     * of specifying them in configuration files.
     * See https://symfony.com/doc/current/best_practices.html#configuration
     *
     * @constant int
     */
    public const PAGINATOR_ITEMS_PER_PAGE = 10;

    /**
     * Constructor.
     *
     * @param ManagerRegistry $registry Manager registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * Query all records.
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    public function queryAll(): QueryBuilder
    {
        // Create or get an existing QueryBuilder instance
        $queryBuilder = $this->getOrCreateQueryBuilder();

        // Properly set up the query with the correct joins and selections
        return $this->createQueryBuilder('task')
            -> select('task', 'category', 'tasks')  // Selects the task and its associated category and tasks
            -> leftJoin('task.category', 'category') // Joins the Category entity with alias 'category'
            -> leftJoin('category.tasks', 'tasks')   // Joins the Tasks entity under Category with alias 'tasks'
            -> orderBy('task.createdAt', 'DESC');    // Orders the result by the creation date of the tasks
    }

    /**
     * Get or create new query builder.
     *
     * This utility method ensures there's always a query builder available,
     * either newly created or passed as an argument.
     *
     * @param QueryBuilder|null $queryBuilder Existing query builder if available
     *
     * @return QueryBuilder Newly created or passed query builder
     */
    private function getOrCreateQueryBuilder(?QueryBuilder $queryBuilder = null): QueryBuilder
    {
        // Use the existing QueryBuilder if provided, otherwise create a new one
        return $queryBuilder ?? $this->createQueryBuilder('task');
    }

}
