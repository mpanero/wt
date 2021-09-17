<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TChat $tChat
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Chat'), ['action' => 'edit', $tChat->ID_CHAT]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Chat'), ['action' => 'delete', $tChat->ID_CHAT], ['confirm' => __('Are you sure you want to delete # {0}?', $tChat->ID_CHAT)]) ?> </li>
        <li><?= $this->Html->link(__('List T Chat'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Chat'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tChat view large-9 medium-8 columns content">
    <h3><?= h($tChat->ID_CHAT) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('COD REF') ?></th>
            <td><?= h($tChat->COD_REF) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SMS') ?></th>
            <td><?= h($tChat->SMS) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID CHAT') ?></th>
            <td><?= $this->Number->format($tChat->ID_CHAT) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TRADE') ?></th>
            <td><?= $this->Number->format($tChat->ID_TRADE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID USER ORIGEN') ?></th>
            <td><?= $this->Number->format($tChat->ID_USER_ORIGEN) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID USER DESTINY') ?></th>
            <td><?= $this->Number->format($tChat->ID_USER_DESTINY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('READ CHAT') ?></th>
            <td><?= $this->Number->format($tChat->READ_CHAT) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('VERIFIED') ?></th>
            <td><?= $this->Number->format($tChat->VERIFIED) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DT CREATED') ?></th>
            <td><?= h($tChat->DT_CREATED) ?></td>
        </tr>
    </table>
</div>
