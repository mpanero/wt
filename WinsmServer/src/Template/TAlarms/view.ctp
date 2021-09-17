<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TAlarm $tAlarm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Alarm'), ['action' => 'edit', $tAlarm->ID_ALARM]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Alarm'), ['action' => 'delete', $tAlarm->ID_ALARM], ['confirm' => __('Are you sure you want to delete # {0}?', $tAlarm->ID_ALARM)]) ?> </li>
        <li><?= $this->Html->link(__('List T Alarms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Alarm'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tAlarms view large-9 medium-8 columns content">
    <h3><?= h($tAlarm->ID_ALARM) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ID ALARM') ?></th>
            <td><?= $this->Number->format($tAlarm->ID_ALARM) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID USER') ?></th>
            <td><?= $this->Number->format($tAlarm->ID_USER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PLACE PRICE') ?></th>
            <td><?= $this->Number->format($tAlarm->ID_PLACE_PRICE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID MARKET') ?></th>
            <td><?= $this->Number->format($tAlarm->ID_MARKET) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PRODUCT') ?></th>
            <td><?= $this->Number->format($tAlarm->ID_PRODUCT) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TYPE PRICE') ?></th>
            <td><?= $this->Number->format($tAlarm->ID_TYPE_PRICE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PRICE FROM') ?></th>
            <td><?= $this->Number->format($tAlarm->PRICE_FROM) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PRICE TO') ?></th>
            <td><?= $this->Number->format($tAlarm->PRICE_TO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID CURRENCY') ?></th>
            <td><?= $this->Number->format($tAlarm->ID_CURRENCY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AUT GENERATION') ?></th>
            <td><?= $this->Number->format($tAlarm->AUT_GENERATION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TP OPERATION') ?></th>
            <td><?= $this->Number->format($tAlarm->ID_TP_OPERATION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID POSITION') ?></th>
            <td><?= $this->Number->format($tAlarm->ID_POSITION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tAlarm->ACTIVE) ?></td>
        </tr>
    </table>
</div>
