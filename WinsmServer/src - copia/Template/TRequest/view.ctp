<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TRequest $tRequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Request'), ['action' => 'edit', $tRequest->ID_REQUEST]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Request'), ['action' => 'delete', $tRequest->ID_REQUEST], ['confirm' => __('Are you sure you want to delete # {0}?', $tRequest->ID_REQUEST)]) ?> </li>
        <li><?= $this->Html->link(__('List T Request'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Request'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tRequest view large-9 medium-8 columns content">
    <h3><?= h($tRequest->ID_REQUEST) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('LOG') ?></th>
            <td><?= h($tRequest->LOG) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID REQUEST') ?></th>
            <td><?= $this->Number->format($tRequest->ID_REQUEST) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID USER OWNER') ?></th>
            <td><?= $this->Number->format($tRequest->ID_USER_OWNER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TP OPERATION') ?></th>
            <td><?= $this->Number->format($tRequest->ID_TP_OPERATION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID MARKET') ?></th>
            <td><?= $this->Number->format($tRequest->ID_MARKET) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TP BUSINESS') ?></th>
            <td><?= $this->Number->format($tRequest->ID_TP_BUSINESS) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PRODUCT') ?></th>
            <td><?= $this->Number->format($tRequest->ID_PRODUCT) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PRICE FROM') ?></th>
            <td><?= $this->Number->format($tRequest->PRICE_FROM) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PRICE TO') ?></th>
            <td><?= $this->Number->format($tRequest->PRICE_TO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TP CURRENCY') ?></th>
            <td><?= $this->Number->format($tRequest->ID_TP_CURRENCY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('QT FROM') ?></th>
            <td><?= $this->Number->format($tRequest->QT_FROM) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('QT TO') ?></th>
            <td><?= $this->Number->format($tRequest->QT_TO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID UM') ?></th>
            <td><?= $this->Number->format($tRequest->ID_UM) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PLACE DELIVERY') ?></th>
            <td><?= $this->Number->format($tRequest->ID_PLACE_DELIVERY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TP STATUS REQ') ?></th>
            <td><?= $this->Number->format($tRequest->ID_TP_STATUS_REQ) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tRequest->ACTIVE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DH REQUEST') ?></th>
            <td><?= h($tRequest->DH_REQUEST) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DT FROM') ?></th>
            <td><?= h($tRequest->DT_FROM) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DT TO') ?></th>
            <td><?= h($tRequest->DT_TO) ?></td>
        </tr>
    </table>
</div>
