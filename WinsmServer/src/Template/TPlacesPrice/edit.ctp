<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TPlacesPrice $tPlacesPrice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tPlacesPrice->ID_PLACE_PRICE],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tPlacesPrice->ID_PLACE_PRICE)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Places Price'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tPlacesPrice form large-9 medium-8 columns content">
    <?= $this->Form->create($tPlacesPrice) ?>
    <fieldset>
        <legend><?= __('Edit T Places Price') ?></legend>
        <?php
            echo $this->Form->control('PLACE_NAME');
            echo $this->Form->control('ID_COUNTRY');
            echo $this->Form->control('ACTIVE');
            echo $this->Form->control('ORDER_INFO');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
