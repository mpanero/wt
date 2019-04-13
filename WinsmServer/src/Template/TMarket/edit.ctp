<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TMarket $tMarket
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tMarket->ID_MARKET],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tMarket->ID_MARKET)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Market'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tMarket form large-9 medium-8 columns content">
    <?= $this->Form->create($tMarket) ?>
    <fieldset>
        <legend><?= __('Edit T Market') ?></legend>
        <?php
            echo $this->Form->control('MARKET_NAME');
            echo $this->Form->control('ID_COUNTRY');
            echo $this->Form->control('ACTIVE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
