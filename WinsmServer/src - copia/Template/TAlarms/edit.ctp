<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TAlarm $tAlarm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tAlarm->ID_ALARM],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tAlarm->ID_ALARM)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Alarms'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tAlarms form large-9 medium-8 columns content">
    <?= $this->Form->create($tAlarm) ?>
    <fieldset>
        <legend><?= __('Edit T Alarm') ?></legend>
        <?php
            echo $this->Form->control('ID_USER');
            echo $this->Form->control('ID_PRODUCT');
            echo $this->Form->control('ID_TYPE_PRICE');
            echo $this->Form->control('ID_MARKET');
            echo $this->Form->control('PRICE_FROM');
            echo $this->Form->control('PRICE_TO');
            echo $this->Form->control('ACTIVE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
