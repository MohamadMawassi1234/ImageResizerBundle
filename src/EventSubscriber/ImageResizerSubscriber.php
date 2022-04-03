<?php

namespace MyBundle\ImageResizerBundle\EventSubscriber;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use MyBundle\ImageResizerBundle\Provider\ResizeImage;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ImageResizerSubscriber implements EventSubscriber
{
    private $parameterBag;
    public function __construct(ParameterBagInterface $parameterBag, EntityManagerInterface $entityManager)
    {
        $this->parameterBag = $parameterBag;
        $this->entityManager = $entityManager;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist, Events::preUpdate
        ];
    }

    private function getShortName(string $className): string
    {
        if (strpos($className, '\\') === false) {
            return strtolower($className);
        }

        $parts = explode('\\', $className);

        return strtolower(end($parts));
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!method_exists($entity, "getImage") || !method_exists($entity, "getThumbnail")) {
            return;
        }
        $context = $this->parameterBag->get('image_resizer.context');
        $entityName = $this->getShortName($this->entityManager->getMetadataFactory()->getMetadataFor(get_class($entity))->getName());
        if (array_key_exists($entityName, $context)) {
            $originalImage = $entity->getImage();
            $resize = new ResizeImage($context[$entityName]['resized_image']['location'] . "/" . $originalImage);
            $resize->resizeTo($context[$entityName]['resized_image']['width'], $context[$entityName]['resized_image']['height'], $context[$entityName]['resized_image']['resize_by']);
            $resize->saveImage($context[$entityName]['resized_image']['location'] . "/resized_" . $originalImage, $context[$entityName]['resized_image']['quality']);
            $thumbnail = new ResizeImage($context[$entityName]['thumbnail']['location'] . "/" . $originalImage);
            $thumbnail->resizeTo($context[$entityName]['thumbnail']['width'], $context[$entityName]['thumbnail']['height'], $context[$entityName]['thumbnail']['resize_by']);
            $thumbnail->saveImage($context[$entityName]['thumbnail']['location'] . "/thumbnail_" . $originalImage, $context[$entityName]['thumbnail']['quality']);
            $entity->setImage('resized_' . $originalImage);
            $entity->setThumbnail('thumbnail_' . $originalImage);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!method_exists($entity, "getImage") || !method_exists($entity, "getThumbnail")) {
            return;
        }
        $context = $this->parameterBag->get('image_resizer.context');
        $entityName = $this->getShortName($this->entityManager->getMetadataFactory()->getMetadataFor(get_class($entity))->getName());
        if (array_key_exists($entityName, $context)) {
            $originalImage = $entity->getImage();
            $resize = new ResizeImage($context[$entityName]['resized_image']['location'] . "/" . $originalImage);
            $resize->resizeTo($context[$entityName]['resized_image']['width'], $context[$entityName]['resized_image']['height'], $context[$entityName]['resized_image']['resize_by']);
            $resize->saveImage($context[$entityName]['resized_image']['location'] . "/resized_" . $originalImage, $context[$entityName]['resized_image']['quality']);
            $thumbnail = new ResizeImage($context[$entityName]['thumbnail']['location'] . "/" . $originalImage);
            $thumbnail->resizeTo($context[$entityName]['thumbnail']['width'], $context[$entityName]['thumbnail']['height'], $context[$entityName]['thumbnail']['resize_by']);
            $thumbnail->saveImage($context[$entityName]['thumbnail']['location'] . "/thumbnail_" . $originalImage, $context[$entityName]['thumbnail']['quality']);
            $entity->setImage('resized_' . $originalImage);
            $entity->setThumbnail('thumbnail_' . $originalImage);
        }
    }
}
