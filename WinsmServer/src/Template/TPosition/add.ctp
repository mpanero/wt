<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TPosition $tPosition
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List T Position'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tPosition form large-9 medium-8 columns content">
    <?= $this->Form->create($tPosition) ?>
    <fieldset>
        <legend><?= __('Add T Position') ?></legend>
        <?php
            echo $this->Form->control('POSITION');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
