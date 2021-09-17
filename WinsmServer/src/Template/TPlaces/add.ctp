<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TPlace $tPlace
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List T Places'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tPlaces form large-9 medium-8 columns content">
    <?= $this->Form->create($tPlace) ?>
    <fieldset>
        <legend><?= __('Add T Place') ?></legend>
        <?php
            echo $this->Form->control('ID_PROVINCE');
            echo $this->Form->control('PLACE_NAME');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
