<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminPageController
 * @package App\Controller
 * @Route("/admin", name="admin_")
 */
class AdminPageController extends AbstractController
{
    /**
     * @Route("/product", name="product", methods={"GET"})
     * @param Request $request
     * @param ProductRepository $productRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function productShow(
        Request $request,
        ProductRepository $productRepository,
        PaginatorInterface $paginator
    ): Response {

        $donnees = $productRepository->findAll();
        $products = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('admin/product.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/category", name="category", methods={"GET"})
     * @param Request $request
     * @param CategoryRepository $categoryRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function categoryShow(
        Request $request,
        CategoryRepository $categoryRepository,
        PaginatorInterface $paginator
    ): Response {

        $donnees = $categoryRepository->findAll();
        $categories = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('admin/category.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete", methods={"DELETE"})
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_product');
    }
}
