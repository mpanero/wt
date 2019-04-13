<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TCurrency $tCurrency
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tCurrency->ID_CURRENCY],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tCurrency->ID_CURRENCY)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Currency'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tCurrency form large-9 medium-8 columns content">
    <?= $this->Form->create($tCurrency) ?>
    <fieldset>
        <legend><?= __('Edit T Currency') ?></legend>
        <?php
            echo $this->Form->control('CURRENCY_NAME');
            echo $this->Form->control('ID_COUNTRY');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
