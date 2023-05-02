<?php

declare(strict_types=1);

namespace Dedi\SyliusSEOPlugin\Factory\SubjectUrl;

use Dedi\SyliusSEOPlugin\Domain\SEO\Adapter\RichSnippetSubjectInterface;
use Dedi\SyliusSEOPlugin\Domain\SEO\Factory\SubjectUrl\SubjectUrlGeneratorInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Webmozart\Assert\Assert;
use Symfony\Component\HttpFoundation\RequestStack;
class ProductUrlGenerator implements SubjectUrlGeneratorInterface
{
    protected RouterInterface $router;
    protected RequestStack $request;
    public function __construct(RouterInterface $router,RequestStack $requestStack)
    {
        $this->router = $router;
         $this->request= $requestStack->getCurrentRequest();
    }

    public function can(RichSnippetSubjectInterface $subject): bool
    {
        return $subject instanceof ProductInterface;
    }

    public function generateUrl(RichSnippetSubjectInterface $subject): string
    {
        return $this->router->generate('sylius_shop_product_show', ['countryCode'=>$this->request->attributes->get('countryCode'),'slug' => $subject->getSlug()], UrlGeneratorInterface::ABSOLUTE_URL);
    }
}
