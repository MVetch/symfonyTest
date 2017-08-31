<?php
namespace AppBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use AppBundle\Entity\Book;
use Symfony\Component\Cache\Simple\FilesystemCache;
use AppBundle\Service\FileUploader;

class DeleteBookSubscriber implements EventSubscriber
{

    function __construct($coverDirectory, $bookDirectory, $booksPerFolder){
        $this->bookDirectory = $bookDirectory;
        $this->coverDirectory = $coverDirectory;
        $this->booksPerFolder = $booksPerFolder;
    }

    private $bookDirectory;
    private $coverDirectory;
    private $booksPerFolder;
    
    public function getSubscribedEvents()
    {
        return array(
            'preRemove',
            'prePersist',
            'preUpdate'
        );
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function index(LifecycleEventArgs $args)
    {
        $this->deleteCache();
        $entity = $args->getEntity();

        if ($entity instanceof Book) {
            $entityManager = $args->getEntityManager();
            if(!empty($entity->getFile()) && file_exists($this->bookDirectory.'/'.floor($entity->getId()/$this->booksPerFolder).'/'.$entity->getFile())){
                unlink($this->bookDirectory.'/'.floor($entity->getId()/$this->booksPerFolder).'/'.$entity->getFile());
            }
            if(!empty($entity->getCover()) && file_exists($this->coverDirectory.'/'.floor($entity->getId()/$this->booksPerFolder).'/'.$entity->getCover())){
                unlink($this->coverDirectory.'/'.floor($entity->getId()/$this->booksPerFolder).'/'.$entity->getCover());
            }
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->deleteCache();
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->deleteCache();
    }

    public function deleteCache()
    {
        $cache = new FilesystemCache();
        $cache->delete("book.list.api");
        $cache->delete("book.list");
    }
}
