<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TTrade $tTrade
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tTrade->ID_TRADE],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tTrade->ID_TRADE)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Trade'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tTrade form large-9 medium-8 columns content">
    <?= $this->Form->create($tTrade) ?>
    <fieldset>
        <legend><?= __('Edit T Trade') ?></legend>
        <?php
            echo $this->Form->control('ID_REQUEST');
            echo $this->Form->control('COD_REF');
            echo $this->Form->control('ID_USER_OWNER');
            echo $this->Form->control('ID_USER_CPART');
            echo $this->Form->control('PRICE');
            echo $this->Form->control('ID_TP_CURRENCY');
            echo $this->Form->control('QT');
            echo $this->Form->control('ID_UM');
            echo $this->Form->control('CONFIRMED_OWNER');
            echo $this->Form->control('CONFIRMED_CPART');
            echo $this->Form->control('DH_CREATION', ['empty' => true]);
            echo $this->Form->control('ID_TP_STATUS_TRADE');
            echo $this->Form->control('ID_TYPE_PRICE');
            echo $this->Form->control('ID_PRICE_REF');
            echo $this->Form->control('DT_PRICE_FIX_FROM', ['empty' => true]);
            echo $this->Form->control('DT_PRICE_FIX_TO', ['empty' => true]);
            echo $this->Form->control('ID_CROP');
            echo $this->Form->control('ID_TYPE_DELIVERY');
            echo $this->Form->control('TYPE_QUALITY');
            echo $this->Form->control('QUALITY_INFO');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
