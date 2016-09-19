<?php

namespace AcmeNewsBundle\Controller;

use AcmeNewsBundle\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    const PER_PAGE = 5;

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/news.{_format}", defaults={"_format"="html"}, name="news")
     */
    public function indexAction(Request $request, $_format)
    {
        $page = $request->query->getInt('page', 1);
        //TODO Здесь нарушается принцип единственной обязанности, хотя в рамках этого прилоения, не критично.
        $list = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(News::class)
            ->getAllPublishedNews();

        $pagination = $this->get('knp_paginator')->paginate(
            $list,
            $page,
            self::PER_PAGE
        );

        return $this->render(':default:news.' . $_format . '.twig', [
            'list' => $list,
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/news/{id}", name="news_show")
     * @Method("GET")
     */
    public function showAction(News $news)
    {
        $list = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AcmeNewsBundle:News')
            ->getRandomEntities();
        
        return $this->render('default/show.html.twig',[
            'news' => $news,
            'list' => $list,
        ]);
    }

}
