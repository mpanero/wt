<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TPrice $tPrice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List T Prices'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tPrices form large-9 medium-8 columns content">
    <?= $this->Form->create($tPrice) ?>
    <fieldset>
        <legend><?= __('Add T Price') ?></legend>
        <?php
            echo $this->Form->control('ID_TYPE_PRICE_INFO');
            echo $this->Form->control('ID_PRODUCT');
            echo $this->Form->control('DATE_PRICE');
            echo $this->Form->control('ID_PLACE_PRICE');
            echo $this->Form->control('PRICE_VALUE');
            echo $this->Form->control('ID_TYPE_CURRENCY');
            echo $this->Form->control('VAR');
            echo $this->Form->control('ID_POSITION');
            echo $this->Form->control('UPDATED');
            echo $this->Form->control('LAST');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
