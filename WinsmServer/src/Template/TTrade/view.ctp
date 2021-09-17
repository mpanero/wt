<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TTrade $tTrade
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Trade'), ['action' => 'edit', $tTrade->ID_TRADE]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Trade'), ['action' => 'delete', $tTrade->ID_TRADE], ['confirm' => __('Are you sure you want to delete # {0}?', $tTrade->ID_TRADE)]) ?> </li>
        <li><?= $this->Html->link(__('List T Trade'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Trade'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tTrade view large-9 medium-8 columns content">
    <h3><?= h($tTrade->ID_TRADE) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('COD REF') ?></th>
            <td><?= h($tTrade->COD_REF) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('QUALITY INFO') ?></th>
            <td><?= h($tTrade->QUALITY_INFO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TRADE') ?></th>
            <td><?= $this->Number->format($tTrade->ID_TRADE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID REQUEST') ?></th>
            <td><?= $this->Number->format($tTrade->ID_REQUEST) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID USER OWNER') ?></th>
            <td><?= $this->Number->format($tTrade->ID_USER_OWNER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID USER CPART') ?></th>
            <td><?= $this->Number->format($tTrade->ID_USER_CPART) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PRICE') ?></th>
            <td><?= $this->Number->format($tTrade->PRICE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TP CURRENCY') ?></th>
            <td><?= $this->Number->format($tTrade->ID_TP_CURRENCY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('QT') ?></th>
            <td><?= $this->Number->format($tTrade->QT) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID UM') ?></th>
            <td><?= $this->Number->format($tTrade->ID_UM) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CONFIRMED OWNER') ?></th>
            <td><?= $this->Number->format($tTrade->CONFIRMED_OWNER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CONFIRMED CPART') ?></th>
            <td><?= $this->Number->format($tTrade->CONFIRMED_CPART) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TP STATUS TRADE') ?></th>
            <td><?= $this->Number->format($tTrade->ID_TP_STATUS_TRADE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TYPE PRICE') ?></th>
            <td><?= $this->Number->format($tTrade->ID_TYPE_PRICE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PRICE REF') ?></th>
            <td><?= $this->Number->format($tTrade->ID_PRICE_REF) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID CROP') ?></th>
            <td><?= $this->Number->format($tTrade->ID_CROP) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TYPE DELIVERY') ?></th>
            <td><?= $this->Number->format($tTrade->ID_TYPE_DELIVERY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TYPE QUALITY') ?></th>
            <td><?= $this->Number->format($tTrade->TYPE_QUALITY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DH CREATION') ?></th>
            <td><?= h($tTrade->DH_CREATION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DT PRICE FIX FROM') ?></th>
            <td><?= h($tTrade->DT_PRICE_FIX_FROM) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DT PRICE FIX TO') ?></th>
            <td><?= h($tTrade->DT_PRICE_FIX_TO) ?></td>
        </tr>
    </table>
</div>
