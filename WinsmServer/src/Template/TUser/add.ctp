<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TUser $tUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List T User'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tUser form large-9 medium-8 columns content">
    <?= $this->Form->create($tUser) ?>
    <fieldset>
        <legend><?= __('Add T User') ?></legend>
        <?php
            echo $this->Form->control('MAIL');
            echo $this->Form->control('ACTIVE');
            echo $this->Form->control('PASSWORD');
            echo $this->Form->control('NAME');
            echo $this->Form->control('SURNAME');
            echo $this->Form->control('GENDER');
            echo $this->Form->control('BIRTHDATE', ['empty' => true]);
            echo $this->Form->control('PHONE_MOBILE');
            echo $this->Form->control('PHONE_OTHER');
            echo $this->Form->control('ID_PLACE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
