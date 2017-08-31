<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Book;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\File\File;
use AppBundle\Service\FileUploader;
use Symfony\Component\Cache\Simple\FilesystemCache;

class BookController extends Controller
{
    public function createAction(Request $request, FileUploader $fileUploader)
    {
        $book = new Book();
        $book->setDateRead(new \DateTime("today"));

        $form = $this->createFormBuilder($book)
            ->add('name', TextType::class, array('label' => 'Название', 'required' => true))
            ->add('author', TextType::class, array('label' => 'Автор', 'required' => true))
            ->add('cover', FileType::class, array('label' => 'Обложка', 'required' => false))
            ->add('dateRead', DateType::class, array('label' => 'Дата прочтения', 'required' => true))
            ->add('file', FileType::class, array('label' => 'Файл с книжкой(PDF)', 'required' => false))
            ->add('downloadable', CheckboxType::class, array('label' => 'Разрешить скачивание', 'required' => false))
            ->add('save', SubmitType::class, array('label' => 'Добавить книжку'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $book = $form->getData();
            $cover = $book->getCover();
            if($cover) {
                $book->setCover(FileUploader::generateFileName($cover));
            }
            $file = $book->getFile();
            if($file) {
                $book->setFile(FileUploader::generateFileName($file));
            }
            
            $em = $this->getDoctrine()->getManager();

            $em->persist($book);
            if($file) {
                FileUploader::upload($this->getParameter('book_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/', $file, $book->getFile());
            }

            if($cover) {
                FileUploader::upload($this->getParameter('cover_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/', $cover, $book->getCover());
            }
            $em->flush();

            return $this->redirectToRoute('listBook');
        }

        return $this->render('book/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function showAction($bookId)
    {
        $book = $this->getDoctrine()
        ->getRepository(Book::class)
        ->find($bookId);

        if (!$book) {
            throw $this->createNotFoundException(
                'No product found for id '.$bookId
            );
        }
        
        return $this->render('book/show.html.twig', array(
            'book' => $book,
        ));
    }

    public function listAction()
    {
        $cache = new FilesystemCache();
        if (!$cache->has('book.list')) {
            $repository = $this->getDoctrine()
            ->getRepository(Book::class);

            $books = $repository->findBy(
                array(),
                array('dateRead' => 'ASC')
            );

            $cache->set('book.list', $books, $this->getParameter('ct'));
        } else {
            $books = $cache->get('book.list');
        }
        
        return $this->render('book/list.html.twig', array(
            'books' => $books,
        ));
    }

    public function editAction($bookId, Request $request, FileUploader $fileUploader)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Book::class)->find($bookId);
        $filePath = $book->getFile();
        $coverPath = $book->getCover();

        if(!empty($book->getFile()) && file_exists($this->getParameter('book_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/'.$filePath)){
            $book->setFile(new File($this->getParameter('book_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/'.$filePath));
        }

        if(!empty($book->getCover()) && file_exists($this->getParameter('cover_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/'.$coverPath)){
            $book->setCover(new File($this->getParameter('cover_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/'.$coverPath));
        }

        $form = $this->createFormBuilder($book)
            ->add('name', TextType::class, array('label' => 'Название', 'required' => true))
            ->add('author', TextType::class, array('label' => 'Автор', 'required' => true))
            ->add('dateRead', DateType::class, array('label' => 'Дата прочтения', 'required' => true))
            ->add('cover', FileType::class, array('label' => 'Обложка', 'required' => false))
            ->add('file', FileType::class, array('label' => 'Файл с книжкой(PDF)', 'required' => false))
            ->add('downloadable', CheckboxType::class, array('label' => 'Разрешить скачивание', 'required' => false))
            ->add('save', SubmitType::class, array('label' => 'Изменить книжку'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $book = $form->getData();
            //echo var_dump($form);die;
            $cover = $book->getCover();
            $file = $book->getFile();
            if($cover) {
                $book->setCover(FileUploader::generateFileName($cover));
            }
            if($file) {
                $book->setFile(FileUploader::generateFileName($file));
            }
            $em->flush();

            if($file) {
                FileUploader::upload($this->getParameter('book_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/', $file, $book->getFile());
            }

            if($cover) {
                FileUploader::upload($this->getParameter('cover_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/', $cover, $book->getCover());
            }
            return $this->redirectToRoute('listBook');
        }
        return $this->render('book/edit.html.twig', array(
            'form' => $form->createView(),
            'cover' => $coverPath,
            'file' => $filePath,
            'id' => $book->getId()
        ));
    }

    public function deleteFileAction($bookId)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Book::class)->find($bookId);
        if(!empty($book->getFile()) && file_exists($this->getParameter('book_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/'.$book->getFile())){
            unlink($this->getParameter('book_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/'.$book->getFile());
        }
        $book->setFile(null);
        $em->flush();
        return $this->redirectToRoute('editBook', array("bookId" => $bookId));
    }

    public function deleteCoverAction($bookId)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Book::class)->find($bookId);
        if(!empty($book->getFile()) && file_exists($this->getParameter('cover_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/'.$book->getCover())){
            unlink($this->getParameter('cover_directory').'/'.floor($book->getId()/$this->getParameter('books_per_folder')).'/'.$book->getCover());
        }
        $book->setCover(null);
        $em->flush();
        return $this->redirectToRoute('editBook', array("bookId" => $bookId));
    }

    public function deleteAction($bookId)
    {
        $cache = new FilesystemCache();
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Book::class)->find($bookId);
        $em->remove($book);
        $em->flush();
        return $this->redirectToRoute('listBook');
    }
}
