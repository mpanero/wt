<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TProductsPrice $tProductsPrice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tProductsPrice->ID_PRODUCT_PRICE],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tProductsPrice->ID_PRODUCT_PRICE)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Products Price'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tProductsPrice form large-9 medium-8 columns content">
    <?= $this->Form->create($tProductsPrice) ?>
    <fieldset>
        <legend><?= __('Edit T Products Price') ?></legend>
        <?php
            echo $this->Form->control('PRODUCT_NAME');
            echo $this->Form->control('ACTIVE');
            echo $this->Form->control('ID_COUNTRY');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
