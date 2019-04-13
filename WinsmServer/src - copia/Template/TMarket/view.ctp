<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TMarket $tMarket
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Market'), ['action' => 'edit', $tMarket->ID_MARKET]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Market'), ['action' => 'delete', $tMarket->ID_MARKET], ['confirm' => __('Are you sure you want to delete # {0}?', $tMarket->ID_MARKET)]) ?> </li>
        <li><?= $this->Html->link(__('List T Market'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Market'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tMarket view large-9 medium-8 columns content">
    <h3><?= h($tMarket->ID_MARKET) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('MARKET NAME') ?></th>
            <td><?= h($tMarket->MARKET_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID MARKET') ?></th>
            <td><?= $this->Number->format($tMarket->ID_MARKET) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID COUNTRY') ?></th>
            <td><?= $this->Number->format($tMarket->ID_COUNTRY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tMarket->ACTIVE) ?></td>
        </tr>
    </table>
</div>
