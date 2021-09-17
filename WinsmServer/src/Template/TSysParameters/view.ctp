<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TSysParameter $tSysParameter
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Sys Parameter'), ['action' => 'edit', $tSysParameter->ID_PARAMETER]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Sys Parameter'), ['action' => 'delete', $tSysParameter->ID_PARAMETER], ['confirm' => __('Are you sure you want to delete # {0}?', $tSysParameter->ID_PARAMETER)]) ?> </li>
        <li><?= $this->Html->link(__('List T Sys Parameters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Sys Parameter'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tSysParameters view large-9 medium-8 columns content">
    <h3><?= h($tSysParameter->ID_PARAMETER) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('NAME PARAMETER') ?></th>
            <td><?= h($tSysParameter->NAME_PARAMETER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('VALUE PARAMETER') ?></th>
            <td><?= h($tSysParameter->VALUE_PARAMETER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PARAMETER') ?></th>
            <td><?= $this->Number->format($tSysParameter->ID_PARAMETER) ?></td>
        </tr>
    </table>
</div>
