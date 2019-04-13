<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TType $tType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Type'), ['action' => 'edit', $tType->ID_TYPE]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Type'), ['action' => 'delete', $tType->ID_TYPE], ['confirm' => __('Are you sure you want to delete # {0}?', $tType->ID_TYPE)]) ?> </li>
        <li><?= $this->Html->link(__('List T Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tTypes view large-9 medium-8 columns content">
    <h3><?= h($tType->ID_TYPE) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('TYPE') ?></th>
            <td><?= h($tType->TYPE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('INFO') ?></th>
            <td><?= h($tType->INFO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TYPE') ?></th>
            <td><?= $this->Number->format($tType->ID_TYPE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tType->ACTIVE) ?></td>
        </tr>
    </table>
</div>
