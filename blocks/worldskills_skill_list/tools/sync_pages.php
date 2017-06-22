<?php 
defined('C5_EXECUTE') or die("Access Denied.");
if (!ini_get('safe_mode')) {
    @set_time_limit(0);
}

/* @var $text Concrete5_Helper_Text */
$text = \Loader::helper('text');

$bID = isset($_POST['bID']) ? $_POST['bID'] : '';
$cID = isset($_POST['cID']) ? $_POST['cID'] : '';
$arHandle = isset($_POST['arHandle']) ? $_POST['arHandle'] : '';

$c = \Page::getByID($cID);
$a = \Area::get($c, $arHandle);
$block = \Block::getByID($bID, $c, $a);

$controller = $block->getInstance();

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
    $pageList->filterByParentID($c->getCollectionId());
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
        $page = $c->add($pageType, $data, $template);

    } else {

        // update page title
        $data = array(
            'cName' => $name,
        );
        $page->update($data);

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
