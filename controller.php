<?php

namespace Concrete\Package\HwSimpleTestimonials;

use Concrete\Core\Backup\ContentImporter;
use Concrete\Core\Database\EntityManager\Provider\ProviderAggregateInterface;
use Concrete\Core\Database\EntityManager\Provider\StandardPackageProvider;
use Concrete\Core\Package\Package;
use Concrete\Core\Asset\Asset;
use Concrete\Core\Asset\AssetList;
use Concrete\Core\Routing\Router;
use Concrete\Core\Support\Facade\Route;
use Concrete\Core\Page\Page;

defined('C5_EXECUTE') or die(("Access Denied."));

class Controller extends Package implements ProviderAggregateInterface
{
    /**
     * Package Handle.
     *
     * @var string
     */
    protected $pkgHandle = 'hw_simple_testimonials';

    /**
     * Application Version Required.
     *
     * @var string
     */
    protected $appVersionRequired = '8.4';

    /**
     * Package Version.
     *
     * @var string
     */
    protected $pkgVersion = '1.1.2';

    /**
     * Package Name.
     *
     * @return string
     */
    public function getPackageName()
    {
        return t('HonestWebsites Simple testimonials');
    }

    /**
     * Package Description.
     *
     * @return string
     */
    public function getPackageDescription()
    {
        return t('Show multiple testimonials on your site.');
    }

    protected $pkgAutoloaderRegistries = array(
        'src/Entity/' => '\HwSimpleTestimonials\Entity'
    );

    public function getEntityManagerProvider()
    {
        $provider = new StandardPackageProvider($this->app, $this, [
            'src/Entity/' => '\HwSimpleTestimonials\Entity'
        ]);
        return $provider;
    }

    public function on_start()
    {
        Route::register('/hwsimpletestimonials/sortorder', '\Concrete\Package\HwSimpleTestimonials\Controller\SinglePage\Dashboard\SortTestimonialOrder::SortOrder');

        $al = AssetList::getInstance();
        $al->register('css', 'hw_testimonials', 'css/hw_testimonials.css', array('version' => '1', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => false, 'combine' => false), $this);
    }


    public function install()
    {
        $pkg = parent::install();
        $ci = new ContentImporter();
        $ci->importContentFile($pkg->getPackagePath() . '/config/install.xml');


    }

    public function upgrade()
    {
        $pkg = Package::getByHandle('hw_simple_testimonials');
        parent::upgrade();

        $p1 = Page::getByPath('/dashboard/hw_simple_testimonials/addtestimonials');
        if (is_object($p1)) {
            $deletePage1 = \Page::getByPath('/dashboard/hw_simple_testimonials/addtestimonials', 'APPROVED');
            $deletePage1->delete();
        }
        $p2 = Page::getByPath('/dashboard/hw_simple_testimonials');
        if (is_object($p2)) {
            $deletePage2 = \Page::getByPath('/dashboard/hw_simple_testimonials', 'APPROVED');
            $deletePage2->delete();
        }

        $ci = new ContentImporter();
        $ci->importContentFile($pkg->getPackagePath() . '/config/install.xml');

    }


}