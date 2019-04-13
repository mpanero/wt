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
        <li><?= $this->Html->link(__('List T Market'), ['controller' => 'TMarket', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Market'), ['controller' => 'TMarket', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List T Product'), ['controller' => 'TProduct', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Product'), ['controller' => 'TProduct', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List T Place'), ['controller' => 'TPlace', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Place'), ['controller' => 'TPlace', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List T User'), ['controller' => 'TUser', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T User'), ['controller' => 'TUser', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List T Um'), ['controller' => 'TUm', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Um'), ['controller' => 'TUm', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List T Currency'), ['controller' => 'TCurrency', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Currency'), ['controller' => 'TCurrency', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List T Types'), ['controller' => 'TTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Type'), ['controller' => 'TTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tRequest view large-9 medium-8 columns content">
    <h3><?= h($tRequest->ID_REQUEST) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('T User') ?></th>
            <td><?= $tRequest->has('t_user') ? $this->Html->link($tRequest->t_user->ID_USER, ['controller' => 'TUser', 'action' => 'view', $tRequest->t_user->ID_USER]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('T Type') ?></th>
            <td><?= $tRequest->has('t_type') ? $this->Html->link($tRequest->t_type->INFO, ['controller' => 'TTypes', 'action' => 'view', $tRequest->t_type->ID_TYPE]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('T Market') ?></th>
            <td><?= $tRequest->has('t_market') ? $this->Html->link($tRequest->t_market->ID_MARKET, ['controller' => 'TMarket', 'action' => 'view', $tRequest->t_market->ID_MARKET]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('T Product') ?></th>
            <td><?= $tRequest->has('t_product') ? $this->Html->link($tRequest->t_product->ID_PRODUCT, ['controller' => 'TProduct', 'action' => 'view', $tRequest->t_product->ID_PRODUCT]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('T Currency') ?></th>
            <td><?= $tRequest->has('t_currency') ? $this->Html->link($tRequest->t_currency->ID_CURRENCY, ['controller' => 'TCurrency', 'action' => 'view', $tRequest->t_currency->ID_CURRENCY]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('T Um') ?></th>
            <td><?= $tRequest->has('t_um') ? $this->Html->link($tRequest->t_um->ID_UM, ['controller' => 'TUm', 'action' => 'view', $tRequest->t_um->ID_UM]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('T Place') ?></th>
            <td><?= $tRequest->has('t_place') ? $this->Html->link($tRequest->t_place->ID_PLACE, ['controller' => 'TPlace', 'action' => 'view', $tRequest->t_place->ID_PLACE]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LOG') ?></th>
            <td><?= h($tRequest->LOG) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('QUALITY INFO') ?></th>
            <td><?= h($tRequest->QUALITY_INFO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID REQUEST') ?></th>
            <td><?= $this->Number->format($tRequest->ID_REQUEST) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TP BUSINESS') ?></th>
            <td><?= $this->Number->format($tRequest->ID_TP_BUSINESS) ?></td>
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
            <th scope="row"><?= __('QT FROM') ?></th>
            <td><?= $this->Number->format($tRequest->QT_FROM) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('QT TO') ?></th>
            <td><?= $this->Number->format($tRequest->QT_TO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LOC DISTANCE') ?></th>
            <td><?= $this->Number->format($tRequest->LOC_DISTANCE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TP STATUS REQ') ?></th>
            <td><?= $this->Number->format($tRequest->ID_TP_STATUS_REQ) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TYPE PRICE') ?></th>
            <td><?= $this->Number->format($tRequest->ID_TYPE_PRICE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PRICE REF') ?></th>
            <td><?= $this->Number->format($tRequest->ID_PRICE_REF) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID CROP') ?></th>
            <td><?= $this->Number->format($tRequest->ID_CROP) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TYPE DELIVERY') ?></th>
            <td><?= $this->Number->format($tRequest->ID_TYPE_DELIVERY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TYPE QUALITY') ?></th>
            <td><?= $this->Number->format($tRequest->TYPE_QUALITY) ?></td>
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
        <tr>
            <th scope="row"><?= __('DH LAST UPDATE') ?></th>
            <td><?= h($tRequest->DH_LAST_UPDATE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DT PRICE FIX FROM') ?></th>
            <td><?= h($tRequest->DT_PRICE_FIX_FROM) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DT PRICE FIX TO') ?></th>
            <td><?= h($tRequest->DT_PRICE_FIX_TO) ?></td>
        </tr>
    </table>
</div>
