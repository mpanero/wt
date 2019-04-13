<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TRequest $tRequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List T Request'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List T Market'), ['controller' => 'TMarket', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T Market'), ['controller' => 'TMarket', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T Product'), ['controller' => 'TProduct', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T Product'), ['controller' => 'TProduct', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T Place'), ['controller' => 'TPlace', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T Place'), ['controller' => 'TPlace', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T User'), ['controller' => 'TUser', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T User'), ['controller' => 'TUser', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T Um'), ['controller' => 'TUm', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T Um'), ['controller' => 'TUm', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T Currency'), ['controller' => 'TCurrency', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T Currency'), ['controller' => 'TCurrency', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T Types'), ['controller' => 'TTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T Type'), ['controller' => 'TTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tRequest form large-9 medium-8 columns content">
    <?= $this->Form->create($tRequest) ?>
    <fieldset>
        <legend><?= __('Add T Request') ?></legend>
        <?php
            echo $this->Form->control('ID_USER_OWNER', ['options' => $tUser]);
            echo $this->Form->control('DH_REQUEST', ['empty' => true]);
            echo $this->Form->control('ID_TP_OPERATION', ['options' => $tTypes, 'empty' => true]);
            echo $this->Form->control('ID_MARKET', ['options' => $tMarket]);
            echo $this->Form->control('ID_TP_BUSINESS');
            echo $this->Form->control('ID_PRODUCT', ['options' => $tProduct]);
            echo $this->Form->control('PRICE_FROM');
            echo $this->Form->control('PRICE_TO');
            echo $this->Form->control('ID_TP_CURRENCY', ['options' => $tCurrency, 'empty' => true]);
            echo $this->Form->control('QT_FROM');
            echo $this->Form->control('QT_TO');
            echo $this->Form->control('ID_UM', ['options' => $tUm, 'empty' => true]);
            echo $this->Form->control('DT_FROM', ['empty' => true]);
            echo $this->Form->control('DT_TO', ['empty' => true]);
            echo $this->Form->control('ID_PLACE_DELIVERY', ['options' => $tPlace]);
            echo $this->Form->control('LOC_DISTANCE');
            echo $this->Form->control('LOG');
            echo $this->Form->control('ID_TP_STATUS_REQ');
            echo $this->Form->control('DH_LAST_UPDATE');
            echo $this->Form->control('ID_TYPE_PRICE');
            echo $this->Form->control('ID_PRICE_REF');
            echo $this->Form->control('DT_PRICE_FIX_FROM');
            echo $this->Form->control('DT_PRICE_FIX_TO');
            echo $this->Form->control('ID_CROP');
            echo $this->Form->control('ID_TYPE_DELIVERY');
            echo $this->Form->control('TYPE_QUALITY');
            echo $this->Form->control('QUALITY_INFO');
            echo $this->Form->control('ACTIVE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
