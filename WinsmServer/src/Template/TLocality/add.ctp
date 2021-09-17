<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TLocality $tLocality
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List T Locality'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tLocality form large-9 medium-8 columns content">
    <?= $this->Form->create($tLocality) ?>
    <fieldset>
        <legend><?= __('Add T Locality') ?></legend>
        <?php
            echo $this->Form->control('ID_PROVINCE');
            echo $this->Form->control('PLACE_NAME');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
