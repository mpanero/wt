<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TProduct $tProduct
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tProduct->ID_PRODUCT],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tProduct->ID_PRODUCT)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Product'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tProduct form large-9 medium-8 columns content">
    <?= $this->Form->create($tProduct) ?>
    <fieldset>
        <legend><?= __('Edit T Product') ?></legend>
        <?php
            echo $this->Form->control('PRODUCT_NAME');
            echo $this->Form->control('ACRONYM');
            echo $this->Form->control('ID_MARKET');
            echo $this->Form->control('ID_CATEGORY_PROD');
            echo $this->Form->control('ICON_PATH');
            echo $this->Form->control('ACTIVE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
