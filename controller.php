<?php
namespace Concrete\Package\ConcreteCssAnimations;

use Core;
use Page;
use Asset;
use Events;
use Package;
use AssetList;
use Concrete\Core\Http\ResponseAssetGroup;

defined('C5_EXECUTE') or die('Access Denied.');

class Controller extends Package
{
    /**
     * Package handle.
     *
     * @var string
     */
    protected $pkgHandle = 'concrete-css-animations';

    /**
     * Package Version.
     *
     * @var string
     */
    protected $pkgVersion = '0.9.1';

    /**
     * Minimum compatible concrete5 version.
     *
     * @var string
     */
    protected $appVersionRequired = '5.7.1';

    /**
     * Package name.
     *
     * @return string
     */
    public function getPackageName()
    {
        return t("CSS Block Animations");
    }

    /**
     * Package description.
     *
     * @return string
     */
    public function getPackageDescription()
    {
        return t("A package that installs CSS animation class prefixes for use in custom classes.");
    }

    /**
     * On CMS boot.
     *
     * @return void
     */
    public function on_start()
    {
        define('CSS3_ANIMATION_PACKAGE', true);

        $this->registerAssets();
    }

    /**
     * On package install.
     *
     * @return void
     */
    public function install()
    {
        $pkg = parent::install();
    }

    /**
     * Register the packages assets.
     *
     * @return void
     */
    protected function registerAssets()
    {
        $al = AssetList::getInstance();

        /*
         | CSS3 Animations
         */
        $al->register(
                'css', 'animate-it/css', 'assets/css3-animate-it-master/css/animations.css',
                array('version' => '0.9.0', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => true, 'combine' => true), $this
        );

        $al->register(
                'css', 'animate-it/ie-fix-css', 'assets/css3-animate-it-master/css/animations-ie-fix.css',
                array('version' => '0.9.0', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => true, 'combine' => true), $this
        );

        $al->register(
                'javascript', 'animate-it/js', 'assets/css3-animate-it-master/js/css3-animate-it.js',
                array('version' => '0.9.0', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this
        );

        $al->register(
                'javascript', 'animate-it/injector', 'assets/injector.js',
                array('version' => '0.9.0', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => true, 'combine' => true), $this
        );

        $al->registerGroup(
            'animate-it',
            array(
                array('css', 'animate-it/css'),
                array('css', 'animate-it/ie-fix-css'),
                array('javascript', 'animate-it/js'),
                array('javascript', 'jquery'),
                array('javascript', 'animate-it/injector'),
            )
        );

        Events::addListener('on_before_render', function ($e) {
            $c = Page::getCurrentPage();

            $r = ResponseAssetGroup::get();
            
            $r->requireAsset('javascript', 'jquery');
            $r->requireAsset('javascript', 'animate-it/injector');

            if (!$c->isEditMode()) {
                $r->requireAsset('css', 'animate-it/css');
                $r->requireAsset('css', 'animate-it/ie-fix-css');
                $r->requireAsset('javascript', 'animate-it/js');
            }
        });
    }
}
