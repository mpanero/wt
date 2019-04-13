<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TType $tType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tType->ID_TYPE],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tType->ID_TYPE)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($tType) ?>
    <fieldset>
        <legend><?= __('Edit T Type') ?></legend>
        <?php
            echo $this->Form->control('TYPE');
            echo $this->Form->control('INFO');
            echo $this->Form->control('ACTIVE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
