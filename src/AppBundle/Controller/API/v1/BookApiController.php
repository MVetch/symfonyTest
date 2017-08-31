<?php

namespace AppBundle\Controller\API\v1;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Book;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\HttpFoundation\Response;

class BookApiController extends FOSRestController
{
    public function listBooksAction(Request $request)
    {
        $cache = new FilesystemCache();
        $apiKey = (null!==$request->request->get('apiKey'))?$request->request->get('apiKey'):$request->query->get('apiKey');
        if(!empty($apiKey)) {
            if($apiKey == $this->getParameter('api_key')){
                if (!$cache->has('book.list.api')) {
                    $repository = $this->getDoctrine()
                    ->getRepository(Book::class);

                    $books = $repository->findBy(
                        array(),
                        array('dateRead' => 'ASC')
                    );
                    foreach ($books as $book) {
                        $return[] = array(
                            "id" => $book->getId(),
                            "name" => $book->getName(),
                            "author" => $book->getAuthor(),
                            "cover" => $this->getParameter('cover_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/'.$book->getCover(),
                            "file" => $this->getParameter('book_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/'.$book->getFile(),
                            "dateRead" => $book->getDateRead(),
                            "downloadable" => $book->getDownloadable()
                        );
                    }
                    $cache->set('book.list.api', $books, $this->getParameter('ct'));
                } else {
                    $books = $cache->get('book.list.api');
                }
                $return = array_merge($return, array("success" => true));
            } else {
                $return = array("success" => false, "message" => "wrong_api_key");
            }
        } else {
            $return = array("success" => false, "message" => "no_api_key");
        }
            
        return new Response(json_encode($return));
    }

    public function newBookAction(Request $request)
    {
        $apiKey = $request->request->get('apiKey')?$request->request->get('apiKey'):$request->query->get('apiKey');
        if(!empty($apiKey)) {
            if($apiKey == $this->getParameter('api_key')){
                $book = new Book();
                $form = $this->createFormBuilder($book)->getForm();
                $form->handleRequest($request);
                if ($form->isValid()) {

                    $book = $form->getData();
                    
                    $em = $this->getDoctrine()->getManager();

                    $em->persist($book);

                    $em->flush();

                    $response['success'] = true;
                    $response['newid'] = $book->getId();
                } else {
                    $return = array("success" => false, "message" => "validation_errors", "details" => json_encode($form->getErrors()));
                }
            } else{
                $return = array("success" => false, "message" => "wrong_api_key");
            }
        } else {
            $return = array("success" => false, "message" => "no_api_key");
        }
        return new Response(json_encode($response));
    }

    public function editBookAction($id, Request $request)
    {
        $apiKey = (null!==$request->request->get('apiKey'))?$request->request->get('apiKey'):$request->query->get('apiKey');
        if(!empty($apiKey)) {
            if($apiKey == $this->getParameter('api_key')){
                    
                $em = $this->getDoctrine()->getManager();

                $book = $em->getRepository(Book::class)->find($bookId);
                $form = $this->createFormBuilder($book)->getForm();
                $form->handleRequest($request);
                if ($form->isValid()) {

                    $book = $form->getData();

                    $em->flush();

                    $response['success'] = true;
                    $response['newid'] = $book->getId();
                } else {
                    $return = array("success" => false, "message" => "validation_errors", "details" => json_encode($form->getErrors()));
                }
            } else {
                $return = array("success" => false, "message" => "wrong_api_key");
            }
        } else {
            $return = array("success" => false, "message" => "no_api_key");
        }
        return new Response(json_encode($response));
    }
}
