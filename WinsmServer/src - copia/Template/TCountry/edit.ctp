<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TCountry $tCountry
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tCountry->ID_COUNTRY],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tCountry->ID_COUNTRY)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List T Country'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tCountry form large-9 medium-8 columns content">
    <?= $this->Form->create($tCountry) ?>
    <fieldset>
        <legend><?= __('Edit T Country') ?></legend>
        <?php
            echo $this->Form->control('COUNTRY_NAME');
            echo $this->Form->control('ACTIVE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
