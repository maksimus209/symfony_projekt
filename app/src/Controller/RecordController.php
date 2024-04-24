<?php
/**
 * Record controller.
 */
/**
 * Show action.
 *
 * @param RecordRepository $repository Record repository
 * @param int              $id         Record identifier
 *
 * @return Response HTTP response
 */
namespace App\Controller;

use App\Repository\RecordRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class RecordController.
 */
#[Route('/record')]
class RecordController extends AbstractController
{
    #[Route(name: 'record_index', methods: 'GET')]
    public function index(RecordRepository $repository): Response
    {
        var_dump($repository->findAll());
        return new Response('Records list');
    }
    #[Route(
        '/{id}',
        name: 'record_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(int $id): Response{
        return new Response ('Records details #'. $id);
    }
}





