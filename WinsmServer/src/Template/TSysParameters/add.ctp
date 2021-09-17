<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TSysParameter $tSysParameter
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List T Sys Parameters'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tSysParameters form large-9 medium-8 columns content">
    <?= $this->Form->create($tSysParameter) ?>
    <fieldset>
        <legend><?= __('Add T Sys Parameter') ?></legend>
        <?php
            echo $this->Form->control('NAME_PARAMETER');
            echo $this->Form->control('VALUE_PARAMETER');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
