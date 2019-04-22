<?php
namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use AppBundle\Entity\Employer;
use AppBundle\Service\FileUploader;

class AvatarUploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        if (!$entity instanceof Employer) {
            return;
        }

        $file = $entity->photo;

        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            $entity->photo = $fileName;
        } elseif ($file instanceof File) {
            $entity->photo = $file->getFilename();
        }
    }


    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Employer) {
            return;
        }

        if ($fileName = $entity->photo) {
            $entity->photo = new File($this->uploader->getTargetDirectory().'/'.$fileName);
        }
    }
}