<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TTrade $tTrade
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List T Trade'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tTrade form large-9 medium-8 columns content">
    <?= $this->Form->create($tTrade) ?>
    <fieldset>
        <legend><?= __('Add T Trade') ?></legend>
        <?php
            echo $this->Form->control('ID_REQUEST');
            echo $this->Form->control('ID_REQUEST_1');
            echo $this->Form->control('ID_USER');
            echo $this->Form->control('ID_USER_1');
            echo $this->Form->control('PRICE');
            echo $this->Form->control('ID_TP_CURRENCY');
            echo $this->Form->control('QT');
            echo $this->Form->control('ID_UM');
            echo $this->Form->control('CONFIRMED');
            echo $this->Form->control('CONFIRMED_1');
            echo $this->Form->control('DH_CREATION', ['empty' => true]);
            echo $this->Form->control('ID_TP_STATUS_TRADE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
