<?php

namespace Concrete\Package\Worldskills\Theme\Worldskills;

use Concrete\Core\Page\Theme\Theme;

class PageTheme extends Theme
{
    public function registerAssets()
    {
        $this->requireAsset('javascript', 'jquery');

        $this->providesAsset('css', 'bootstrap/*');
        $this->providesAsset('css', 'core/frontend/pagination');

        $this->requireAsset('css', 'font-awesome');
    }

    protected $pThemeGridFrameworkHandle = 'bootstrap4';

    public function getThemeName()
    {
        return 'WorldSkills';
    }

    public function getThemeDescription()
    {
        return 'A theme in the WorldSkills brand suited for WorldSkills websites.';
    }

    public function getThemeBlockClasses()
    {
        return array(
        );
    }

    public function getThemeAreaClasses()
    {
    }

    public function getThemeDefaultBlockTemplates()
    {
       return array(
           'content' => 'worldskills_content.php',
           'image' => 'worldskills_fluid.php',
           'testimonial' => 'worldskills_pullquote.php',
       );
    }

    public function getThemeEditorClasses()
    {
        return array(
            array('title' => t('Lead'), 'menuClass' => 'lead', 'spanClass' => 'lead', 'forceBlock' => 1),
            array('title' => t('Cube icon'), 'menuClass' => '', 'spanClass' => 'ws-h-icon', 'forceBlock' => 1),
            array('title' => t('Serif font'), 'menuClass' => 'text-serif', 'spanClass' => 'text-serif', 'forceBlock' => 1),
        );
    }
}
