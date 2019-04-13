<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TTransac $tTransac
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List T Transac'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tTransac form large-9 medium-8 columns content">
    <?= $this->Form->create($tTransac) ?>
    <fieldset>
        <legend><?= __('Add T Transac') ?></legend>
        <?php
            echo $this->Form->control('ID_USER');
            echo $this->Form->control('ID_REQUEST');
            echo $this->Form->control('ID_TRADE');
            echo $this->Form->control('SEC');
            echo $this->Form->control('ID_TRANSAC_TYPE');
            echo $this->Form->control('DH_TRANSAC');
            echo $this->Form->control('VALUE');
            echo $this->Form->control('INFO');
            echo $this->Form->control('COMMENTS');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
