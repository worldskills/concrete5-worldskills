<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<?php if (isset($error)): ?>
    <p><?=$error?></p>
<?php endif; ?>

<form action="<?php echo $this->url($resultTargetURL); ?>" method="get" class="form-inline" role="form">

    <?php if (strlen($query) == 0): ?>
        <input name="search_paths[]" type="hidden" value="<?php echo h($baseSearchPath); ?>" />
    <?php elseif (is_array($_REQUEST['search_paths'])): ?> 
        <?php foreach ($_REQUEST['search_paths'] as $search_path): ?>
            <input name="search_paths[]" type="hidden" value="<?php echo h($search_path); ?>" />
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="form-group">
        <label class="sr-only" for="searchQuery">Search query</label>
        <input name="query" type="text" id="searchQuery" autofocus value="<?php echo h($query); ?>" class="form-control">
    </div>

    <input name="submit" type="submit" value="<?=$buttonText?>" class="btn btn-primary" />
</form>

<?php
$tt = Loader::helper('text');
?>

<?php if ($do_search): ?>
    <?php if (count($results)==0): ?>
        <p class="my-4 text-danger"><?php echo t('There were no results found. Please try another keyword or phrase.'); ?></p>
    <?php else: ?>
        <div id="searchResults">
            <?php foreach($results as $r): ?> 
                <?php $currentName = $this->controller->highlightedMarkup($r->getCollectionName(), $query); ?>
                <?php $currentPageBody = $this->controller->highlightedExtendedMarkup($r->getPageIndexContent(), $query); ?>
                <hr/>
                <div class="searchResult">
                    <h2><a href="<?php echo $r->getCollectionLink(); ?>"><?php echo $currentName; ?></a></h2>
                    <p>
                        <?php if ($r->getCollectionDescription()): ?>
                            <?php echo $this->controller->highlightedMarkup($tt->shortText($r->getCollectionDescription()),$query)?><br/>
                        <?php endif; ?>
                        <?php echo $currentPageBody; ?>
                    </p>
                    <div class="search-breadcrumb">
                        <?php
                        $breadcrumbs = BlockType::getByHandle('autonav');
                        $breadcrumbs->controller->orderBy = 'display_asc';
                        $breadcrumbs->controller->displayPages = 'first_level';
                        $breadcrumbs->controller->cID = $r->cID;
                        $breadcrumbs->controller->displaySubPages = 'relevant_breadcrumb';
                        $breadcrumbs->controller->displaySubPageLevels = 'all';
                        $breadcrumbs->render('templates/worldskills_breadcrumb'); 
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php
        $pages = $pagination->getCurrentPageResults();
        if ($pagination->haveToPaginate()) {
            $showPagination = true;
            echo $pagination->renderDefaultView();
        }
        ?>

    <?php endif; ?>
<?php endif; ?>
