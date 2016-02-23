<?php 
defined('C5_EXECUTE') or die("Access Denied.");
if (!ini_get('safe_mode')) {
    @set_time_limit(0);
}

/* @var $text Concrete5_Helper_Text */
$text = \Loader::helper('text');

$bID = isset($_POST['bID']) ? $_POST['bID'] : '';

$block = \Block::getByID($bID);

$controller = $block->getInstance();

$parentPage = $block->getBlockCollectionObject();

$pageType = \PageType::getByHandle('worldskills_skill');
$template = \PageTemplate::getByHandle('full');

$skills = $controller->getSkills();

foreach ($skills['skills'] as $skill) {

    $skillId = $skill['id'];
    $name = $skill['name']['text'];

    $slug = $text->urlify($name);

    $page = null;

    // try to load existing page
    $pageList = new PageList();
    $pageList->filterByParentID($parentPage->getCollectionId());
    $pageList->filterByAttribute('worldskills_skill_id', $skillId);
    $pages = $pageList->get(1);
    if (is_array($pages) && isset($pages[0])) {
        $page = $pages[0];
    }

    if (!$page) {

        // create page
        $data = array(
            'cName' => $name,
            'cDescription' => '',
            'cHandle' => $slug,
        );
        $page = $parentPage->add($pageType, $data, $template);
    }

    $page->setAttribute('exclude_nav', true);
    $page->setAttribute('worldskills_skill_id', $skillId);

    $bt = \BlockType::getByHandle('worldskills_skill');
    $blocks = $page->getBlocks('Main');

    // only add block if there's none yet
    if (count($blocks) < 1){
        $data = array(
            'eventId' => $controller->eventId,
            'skillId' => $skillId,
        );
        $page->addBlock($bt, 'Main', $data);
    }
}

header('Content-Type: application/json; charset=' . APP_CHARSET, true);
echo \Loader::helper('json')->encode($skills);
