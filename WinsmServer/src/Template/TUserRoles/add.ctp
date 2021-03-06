<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TUserRole $tUserRole
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List T User Roles'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tUserRoles form large-9 medium-8 columns content">
    <?= $this->Form->create($tUserRole) ?>
    <fieldset>
        <legend><?= __('Add T User Role') ?></legend>
        <?php
            echo $this->Form->control('DESCRIPTION');
            echo $this->Form->control('ACTIVE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
