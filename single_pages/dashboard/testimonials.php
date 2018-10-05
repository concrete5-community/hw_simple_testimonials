<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

    <style>
        i.item-select-list-sort:hover {
            cursor: move
        }

        .ui-sortable-helper {
            display: table;
        }
    </style>


<?php if ($controller->getTask() == 'add' ||
    $controller->getTask() == 'edit' ||
    $controller->getTask() == 'submit') {
    ?>

    <form method="post" action="<?= $view->action('submit') ?>">
        <?php echo $token->output('submit') ?>
        <?php echo $form->hidden('sID', $sID) ?>


        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <?= $form->label("author", t("Author")); ?>
                    <?= $form->text("author", $author); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <?= $form->label("company", t("Company")); ?>
                    <?= $form->text("company", $company); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <?= $form->label("testimonial", t("Testimonial")); ?>
                    <?= $form->textarea("testimonial", $testimonial, array('rows' => 10)); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?= $form->label("extra", t("Extra")); ?><br>
            <?php
            $editor = Core::make('editor');
            echo $editor->outputStandardEditor('extra', $extra);
            ?>
        </div>


        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions">
                <a href="<?php echo URL::to('/dashboard/testimonials') ?>"
                   class="btn btn-default pull-left"><?= t('Cancel') ?></a>
                <?php if (isset($sID)) { ?>
                    <?php echo $form->submit('save', t('Save'), array('class' => 'btn btn-primary pull-right')) ?>
                <?php } else { ?>
                    <?php echo $form->submit('add', t('Add'), array('class' => 'btn btn-primary pull-right')) ?>
                <?php } ?>
            </div>
        </div>
    </form>

    <?php if (isset($sID)) { ?>
        <div class="ccm-dashboard-header-buttons">
            <button data-dialog="delete-entity" class="btn btn-danger"><?php echo t("Delete") ?></button>
        </div>

        <div style="display: none">
            <div id="ccm-dialog-delete-entity" class="ccm-ui">
                <form method="post" class="form-stacked" action="<?= $view->action('delete') ?>">
                    <?php echo $token->output('delete') ?>
                    <?php echo $form->hidden('sID', $sID) ?>
                    <p><?= t('Are you sure? This action cannot be undone.') ?></p>
                </form>
                <div class="dialog-buttons">
                    <button class="btn btn-default pull-left"
                            onclick="jQuery.fn.dialog.closeTop()"><?= t('Cancel') ?></button>
                    <button class="btn btn-danger pull-right"
                            onclick="$('#ccm-dialog-delete-entity form').submit()"><?= t('Delete') ?></button>
                </div>
            </div>
        </div>

        <script>
            $('button[data-dialog=delete-entity]').on('click', function () {
                jQuery.fn.dialog.open({
                    element: '#ccm-dialog-delete-entity',
                    modal: true,
                    width: 320,
                    title: '<?=t("Delete Entity")?>',
                    height: 'auto'
                });
            });
        </script>

    <?php } ?>

<?php } else { ?>

    <?php if (count($entries)) { ?>
        <div data-search-element="results">
            <div class="table-responsive">
                <table class="ccm-search-results-table">
                    <thead>
                    <tr>
                        <th><span><?php echo t('Author') ?></span></th>
                        <th><span><?php echo t('Company') ?></span></th>
                        <th><span><?php echo t('Testimonial') ?></span></th>
                        <th><span><?php echo t('Sort') ?></span></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($entries as $e) {

                        $testimonial = $e->getTestimonial();
                        if (strlen($testimonial) > 100) {
                            $testimonial = substr($testimonial, 0, 100) . "...";
                        }

                        ?>

                        <tr id="tID_<?php echo($e->getSID()) ?>">
                            <td>
                                <a href="<?php echo URL::to('/dashboard/testimonials/edit', $e->getSID()) ?>">
                                    <?php echo h($e->getAuthor()) ?>
                            </td>
                            </a>
                            <td>
                                <?php echo h($e->getCompany()) ?>
                            </td>
                            <td>
                                <?php echo h($testimonial) ?>
                            </td>

                            <td><i class="fa fa-arrows-v item-select-list-sort"></i></td>
                            <td style="visibility: hidden"><?php echo $e->getSortOrder; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="ccm-search-results-pagination">
            <?php print $pagination; ?>
        </div>


    <?php } else { ?>

        <p><?php echo t("No results found.") ?></p>

    <?php } ?>
    <script type="text/javascript">

        $(document).ready(function () {
            $('tbody').sortable({
                handle: 'i.item-select-list-sort',
                cursor: 'move',
                opacity: 0.5,
                stop: function (event, ui) {
                    var ualist = $(this).sortable('serialize');
                    $.post('<?php echo URL::to('/dashboard/testimonials/sortorder')?>', ualist, function (r) {
                    });
                }
            })
        });

    </script>


    <div class="ccm-dashboard-header-buttons">
        <a href="<?= \URL::to('/dashboard/testimonials/', 'add') ?>"
           class="btn btn-primary"><?= t("Add Testimional") ?></a>
    </div>
<?php }
?>