<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TChat $tChat
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tChat->ID_CHAT],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tChat->ID_CHAT)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Chat'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tChat form large-9 medium-8 columns content">
    <?= $this->Form->create($tChat) ?>
    <fieldset>
        <legend><?= __('Edit T Chat') ?></legend>
        <?php
            echo $this->Form->control('ID_TRADE');
            echo $this->Form->control('ID_USER_OWNER');
            echo $this->Form->control('ID_USER_CPART');
            echo $this->Form->control('SMS');
            echo $this->Form->control('READ_CHAT');
            echo $this->Form->control('DT_CREATED');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
