<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TUser $tUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tUser->ID_USER],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tUser->ID_USER)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T User'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tUser form large-9 medium-8 columns content">
    <?= $this->Form->create($tUser) ?>
    <fieldset>
        <legend><?= __('Edit T User') ?></legend>
        <?php
            echo $this->Form->control('MAIL');
            echo $this->Form->control('ACTIVE');
            echo $this->Form->control('PASSWORD');
            echo $this->Form->control('NAME');
            echo $this->Form->control('SURNAME');
            echo $this->Form->control('COMPANY');
            echo $this->Form->control('ID_GENDER');
            echo $this->Form->control('BIRTHDATE', ['empty' => true]);
            echo $this->Form->control('PHONE_MOBILE_COUNTRY');
            echo $this->Form->control('PHONE_MOBILE_NUM');
            echo $this->Form->control('PHONE_OTHER_COUNTRY');
            echo $this->Form->control('PHONE_OTHER_NUM');
            echo $this->Form->control('ID_ROL');
            echo $this->Form->control('ID_PLACE');
            echo $this->Form->control('ID_LEGAL');
            echo $this->Form->control('ACTIVITY');
            echo $this->Form->control('ID_TYPE_STATUS_USER');
            echo $this->Form->control('Q1');
            echo $this->Form->control('Q2');
            echo $this->Form->control('Q3');
            echo $this->Form->control('USER_ADMIN');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
