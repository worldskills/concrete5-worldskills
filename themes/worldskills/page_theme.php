<?php 

namespace Concrete\Package\Worldskills\Theme\Worldskills;

use Concrete\Core\Page\Theme\Theme;

class PageTheme extends Theme
{
	public function registerAssets()
	{
        $this->requireAsset('css', 'font-awesome');
        $this->providesAsset('css', 'bootstrap/*');
       	$this->requireAsset('javascript', 'jquery');
        $this->providesAsset('javascript', 'bootstrap/*');
	}

   	protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function getThemeBlockClasses()
    {
		return array(
		    'image' => array(
                'promo-one',
                'promo-two',
                'promo-three',
                'promo-four',
		    ),
        );
    }

    public function getThemeAreaClasses()
    {
    }

    public function getThemeDefaultBlockTemplates()
    {	       
    }

    public function getThemeEditorClasses()
    {
        return array(
            array('title' => t('Page Title'), 'menuClass' => 'page-title', 'spanClass' => 'page-title'),
			array('title' => t('Lead'), 'menuClass' => 'lead', 'spanClass' => 'lead'),
        );
    }
}
