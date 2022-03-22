<?php
namespace MyBundle\ImageResizerBundle\EventSubscriber;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use MyBundle\ImageResizerBundle\Provider\ResizeImage;
use MyBundle\ImageResizerBundle\Provider\MessageGenerator;

class ResponseSubscriber implements EventSubscriberInterface
{
    private $parameterBag;
	private $resizeImageProvider;
    public function __construct(ParameterBagInterface $parameterBag) 
    {
        $this->parameterBag = $parameterBag;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => [
                ['imageResizer', 0],
            ],
        ];
    }

    public function imageResizer(ResponseEvent $event)
    {
		$context = $this->parameterBag->get('image_resizer.context');
		if (isset($_COOKIE['entity_name'])) {
			$entityName = strtolower($_COOKIE['entity_name']);
			if (array_key_exists($entityName, $context)) {
				setcookie("entity_name", "", time() - 1, "/");
				$resize = new ResizeImage($context[$entityName]['resized_image']['location']."/".$_COOKIE["image"]);
				$resize->resizeTo($context[$entityName]['resized_image']['width'], $context[$entityName]['resized_image']['height'], $context[$entityName]['resized_image']['resize_by']);
				$resize->saveImage($context[$entityName]['resized_image']['location']."/resized_".$_COOKIE["image"], $context[$entityName]['resized_image']['quality']);
				$thumbnail = new ResizeImage($context[$entityName]['thumbnail']['location']."/".$_COOKIE["image"]);
				$thumbnail->resizeTo($context[$entityName]['thumbnail']['width'], $context[$entityName]['thumbnail']['height'], $context[$entityName]['thumbnail']['resize_by']);
				$thumbnail->saveImage($context[$entityName]['thumbnail']['location']."/thumbnail_".$_COOKIE["image"], $context[$entityName]['thumbnail']['quality']);
				setcookie("image", "", time() - 1, "/");
			}
			
		}
    }
}







