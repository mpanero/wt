<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TProvince $tProvince
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List T Province'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tProvince form large-9 medium-8 columns content">
    <?= $this->Form->create($tProvince) ?>
    <fieldset>
        <legend><?= __('Add T Province') ?></legend>
        <?php
            echo $this->Form->control('PROVINCE_NAME');
            echo $this->Form->control('ID_COUNTRY');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
