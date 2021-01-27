<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\CatererRepository;
use App\Repository\ClickRepository;
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

        $donnees = $productRepository->findby([], [
            'id' => 'DESC'
        ], null, null);
        $products = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            5
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
            5
        );

        return $this->render('admin/category.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/caterer", name="caterer", methods={"GET"})
     * @param Request $request
     * @param CatererRepository $catererRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function catererShow(
        Request $request,
        CatererRepository $catererRepository,
        PaginatorInterface $paginator
    ): Response {

        $donnees = $catererRepository->findAll();
        $caterers = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/caterer.html.twig', [
            'caterers' => $caterers
        ]);
    }

    /**
     * @Route("/click", name="click_index", methods={"GET"})
     * @param Request $request
     * @param ClickRepository $clickRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function clickShow(
        Request $request,
        ClickRepository $clickRepository,
        PaginatorInterface $paginator
    ): Response {

        $donnes = $clickRepository->findby([], [
            'id' => 'DESC'
        ]);
        $productClick = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('Admin/click.html.twig', [
            'productClick' => $productClick
        ]);
    }
}
