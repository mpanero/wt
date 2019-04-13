<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TUm $tUm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tUm->ID_UM],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tUm->ID_UM)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Um'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tUm form large-9 medium-8 columns content">
    <?= $this->Form->create($tUm) ?>
    <fieldset>
        <legend><?= __('Edit T Um') ?></legend>
        <?php
            echo $this->Form->control('UM_NAME');
            echo $this->Form->control('ID_COUNTRY');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
