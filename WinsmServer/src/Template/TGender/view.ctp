<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TGender $tGender
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Gender'), ['action' => 'edit', $tGender->ID_GENDER]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Gender'), ['action' => 'delete', $tGender->ID_GENDER], ['confirm' => __('Are you sure you want to delete # {0}?', $tGender->ID_GENDER)]) ?> </li>
        <li><?= $this->Html->link(__('List T Gender'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Gender'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tGender view large-9 medium-8 columns content">
    <h3><?= h($tGender->ID_GENDER) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('GENDER NAME') ?></th>
            <td><?= h($tGender->GENDER_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('GENDER INI') ?></th>
            <td><?= h($tGender->GENDER_INI) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID GENDER') ?></th>
            <td><?= $this->Number->format($tGender->ID_GENDER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tGender->ACTIVE) ?></td>
        </tr>
    </table>
</div>
