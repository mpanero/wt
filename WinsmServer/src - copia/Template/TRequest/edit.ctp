<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TRequest $tRequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tRequest->ID_REQUEST],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tRequest->ID_REQUEST)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Request'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tRequest form large-9 medium-8 columns content">
    <?= $this->Form->create($tRequest) ?>
    <fieldset>
        <legend><?= __('Edit T Request') ?></legend>
        <?php
            echo $this->Form->control('ID_USER_OWNER');
            echo $this->Form->control('DH_REQUEST', ['empty' => true]);
            echo $this->Form->control('ID_TP_OPERATION');
            echo $this->Form->control('ID_MARKET');
            echo $this->Form->control('ID_TP_BUSINESS');
            echo $this->Form->control('ID_PRODUCT');
            echo $this->Form->control('PRICE_FROM');
            echo $this->Form->control('PRICE_TO');
            echo $this->Form->control('ID_TP_CURRENCY');
            echo $this->Form->control('QT_FROM');
            echo $this->Form->control('QT_TO');
            echo $this->Form->control('ID_UM');
            echo $this->Form->control('DT_FROM', ['empty' => true]);
            echo $this->Form->control('DT_TO', ['empty' => true]);
            echo $this->Form->control('ID_PLACE_DELIVERY');
            echo $this->Form->control('LOG');
            echo $this->Form->control('ID_TP_STATUS_REQ');
            echo $this->Form->control('ACTIVE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
