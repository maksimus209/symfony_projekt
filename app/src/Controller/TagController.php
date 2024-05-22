<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\Type\TagType;
use App\Service\TagServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TagController
 * @package App\Controller
 */
#[Route('/tag')]
class TagController extends AbstractController
{
    /**
     * @var TagServiceInterface
     */
    private TagServiceInterface $tagService;

    /**
     * TagController constructor.
     *
     * @param TagServiceInterface $tagService
     */
    public function __construct(TagServiceInterface $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     * Display a list of tags.
     *
     * @Route('/', name: 'tag_index', methods: ['GET'])
     * @return Response
     */
    #[Route('/', name: 'tag_index', methods: ['GET'])]
    public function index(): Response
    {
        $tags = $this->tagService->getAllTags();

        return $this->render('tag/index.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * Create a new tag.
     *
     * @Route('/new', name: 'tag_new', methods: ['GET', 'POST'])
     * @param Request $request
     * @return Response
     */
    #[Route('/new', name: 'tag_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->tagService->createTag($tag);

            return $this->redirectToRoute('tag_index');
        }

        return $this->render('tag/new.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Display a specific tag.
     *
     * @Route('/{id}', name: 'tag_show', methods: ['GET'])
     * @param Tag $tag
     * @return Response
     */
    #[Route('/{id}', name: 'tag_show', methods: ['GET'])]
    public function show(Tag $tag): Response
    {
        return $this->render('tag/show.html.twig', [
            'tag' => $tag,
        ]);
    }

    /**
     * Edit a tag.
     *
     * @Route('/{id}/edit', name: 'tag_edit', methods: ['GET', 'POST'])
     * @param Request $request
     * @param Tag $tag
     * @return Response
     */
    #[Route('/{id}/edit', name: 'tag_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tag $tag): Response
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->tagService->updateTag($tag);

            return $this->redirectToRoute('tag_index');
        }

        return $this->render('tag/edit.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete a tag.
     *
     * @Route('/{id}', name: 'tag_delete', methods: ['POST'])
     * @param Request $request
     * @param Tag $tag
     * @return Response
     */
    #[Route('/{id}', name: 'tag_delete', methods: ['POST'])]
    public function delete(Request $request, Tag $tag): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tag->getId(), $request->request->get('_token'))) {
            $this->tagService->deleteTag($tag);
        }

        return $this->redirectToRoute('tag_index');
    }
}
