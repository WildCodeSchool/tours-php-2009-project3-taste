<?php

namespace App\Controller;

use App\Entity\Click;
use App\Form\ClickEditType;
use App\Form\ProductClickType;
use App\Repository\ClickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/product-click", name="click_")
 */
class ProductClickController extends AbstractController
{

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     * @param Request $request
     * @param SluggerInterface $slugger
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $productClick = new Click();
        $form = $this->createForm(ProductClickType::class, $productClick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $imageFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImageFilename = $slugger->slug($imageFilename);
                $newImageFile = $safeImageFilename . '-' . uniqid('', true) . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('upload_dir'),
                        $newImageFile
                    );
                } catch (FileException $e) {
                }
                $productClick->setImage($newImageFile);
            }
            $entityManager->persist($productClick);
            $entityManager->flush();

            $this->addFlash('success', 'Image ajouté avec Succès');
            return $this->redirectToRoute('admin_click_index');
        }

        return $this->render('product_click/new.html.twig', [
            'product_click' => $productClick,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @param Click $productClick
     * @return Response
     */
    public function show(Click $productClick): Response
    {
        return $this->render('product_click/show.html.twig', [
            'product_click' => $productClick,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Click $productClick
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function edit(Request $request, Click $productClick, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClickEditType::class, $productClick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_click_index');
        }

        return $this->render('product_click/edit.html.twig', [
            'product_click' => $productClick,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param Click $productClick
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function delete(Request $request, Click $productClick, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $productClick->getId(), $request->request->get('_token'))) {
            $filename = $productClick->getImage();
            $path = $this->getParameter('upload_dir') . '/' . $filename;
            unlink($path);

            $entityManager->remove($productClick);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_click_index');
    }
}
