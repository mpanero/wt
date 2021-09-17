<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TPosition $tPosition
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tPosition->ID_POSITION],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tPosition->ID_POSITION)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Position'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tPosition form large-9 medium-8 columns content">
    <?= $this->Form->create($tPosition) ?>
    <fieldset>
        <legend><?= __('Edit T Position') ?></legend>
        <?php
            echo $this->Form->control('POSITION');
            echo $this->Form->control('DATE_POSITION');
            echo $this->Form->control('ID_TYPE_PRICE_INFO');
            echo $this->Form->control('ACTIVE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
