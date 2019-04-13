<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TGender $tGender
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tGender->ID_GENDER],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tGender->ID_GENDER)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Gender'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tGender form large-9 medium-8 columns content">
    <?= $this->Form->create($tGender) ?>
    <fieldset>
        <legend><?= __('Edit T Gender') ?></legend>
        <?php
            echo $this->Form->control('GENDER_NAME');
            echo $this->Form->control('GENDER_INI');
            echo $this->Form->control('ACTIVE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
