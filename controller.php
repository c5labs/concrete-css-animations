<?php
namespace Concrete\Package\CssAnimations;

use Asset;
use AssetList;
use Concrete\Core\Http\ResponseAssetGroup;
use Package;
 
defined('C5_EXECUTE') or die('Access Denied.');
 
class Controller extends Package 
{
    protected $pkgHandle = 'css-animations';
    protected $appVersionRequired = '5.7.1';
    protected $pkgVersion = '0.9.0';

    public function getPackageName() 
    {
        return t("CSS Animations Package");
    }

    public function getPackageDescription() 
    {
        return t("A package that installs CSS animation class prefixes for use in custom classes.");
    }    

    public function on_start()
    {
        $this->registerAssets();
    }

    public function install()
    {
        $pkg = parent::install();
    }

    protected function registerAssets()
    {
        $al = AssetList::getInstance();
        
        $r = ResponseAssetGroup::get();

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
                array('version' => '0.9.0', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this
        );

        $al->registerGroup(
            'animate-it',
            array(
                array('css', 'animate-it/css'),
                array('css', 'animate-it/ie-fix-css'),
                array('javascript', 'animate-it/js'),
                array('javascript', 'animate-it/injector'),
            )
        );

        /*
        | Require the animation core in all requests.
         */
        $r->requireAsset('animate-it');
    }
}
