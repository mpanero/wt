<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TTypeActivity $tTypeActivity
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tTypeActivity->ID_ACTIVITY],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tTypeActivity->ID_ACTIVITY)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Type Activity'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tTypeActivity form large-9 medium-8 columns content">
    <?= $this->Form->create($tTypeActivity) ?>
    <fieldset>
        <legend><?= __('Edit T Type Activity') ?></legend>
        <?php
            echo $this->Form->control('ACTIVITY_NAME');
            echo $this->Form->control('ACTIVITY_NAME_EN');
            echo $this->Form->control('ACTIVITY_NAME_PO');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
