<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TRequest[]|\Cake\Collection\CollectionInterface $tRequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T Request'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T Market'), ['controller' => 'TMarket', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T Market'), ['controller' => 'TMarket', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T Product'), ['controller' => 'TProduct', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T Product'), ['controller' => 'TProduct', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T Place'), ['controller' => 'TPlace', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T Place'), ['controller' => 'TPlace', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T User'), ['controller' => 'TUser', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T User'), ['controller' => 'TUser', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T Um'), ['controller' => 'TUm', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T Um'), ['controller' => 'TUm', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T Currency'), ['controller' => 'TCurrency', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T Currency'), ['controller' => 'TCurrency', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List T Types'), ['controller' => 'TTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New T Type'), ['controller' => 'TTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tRequest index large-9 medium-8 columns content">
    <h3><?= __('T Request') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_REQUEST') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_USER_OWNER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DH_REQUEST') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TP_OPERATION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_MARKET') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TP_BUSINESS') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_PRODUCT') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRICE_FROM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRICE_TO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TP_CURRENCY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('QT_FROM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('QT_TO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_UM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DT_FROM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DT_TO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_PLACE_DELIVERY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('LOC_DISTANCE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('LOG') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TP_STATUS_REQ') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DH_LAST_UPDATE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TYPE_PRICE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_PRICE_REF') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DT_PRICE_FIX_FROM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DT_PRICE_FIX_TO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_CROP') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TYPE_DELIVERY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TYPE_QUALITY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('QUALITY_INFO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tRequest as $tRequest): ?>
            <tr>
                <td><?= $this->Number->format($tRequest->ID_REQUEST) ?></td>
                <td><?= $tRequest->has('t_user') ? $this->Html->link($tRequest->t_user->ID_USER, ['controller' => 'TUser', 'action' => 'view', $tRequest->t_user->ID_USER]) : '' ?></td>
                <td><?= h($tRequest->DH_REQUEST) ?></td>
                <td><?= $tRequest->has('t_type') ? $this->Html->link($tRequest->t_type->INFO, ['controller' => 'TTypes', 'action' => 'view', $tRequest->t_type->ID_TYPE]) : '' ?></td>
                <td><?= $tRequest->has('t_market') ? $this->Html->link($tRequest->t_market->ID_MARKET, ['controller' => 'TMarket', 'action' => 'view', $tRequest->t_market->ID_MARKET]) : '' ?></td>
                <td><?= $this->Number->format($tRequest->ID_TP_BUSINESS) ?></td>
                <td><?= $tRequest->has('t_product') ? $this->Html->link($tRequest->t_product->ID_PRODUCT, ['controller' => 'TProduct', 'action' => 'view', $tRequest->t_product->ID_PRODUCT]) : '' ?></td>
                <td><?= $this->Number->format($tRequest->PRICE_FROM) ?></td>
                <td><?= $this->Number->format($tRequest->PRICE_TO) ?></td>
                <td><?= $tRequest->has('t_currency') ? $this->Html->link($tRequest->t_currency->ID_CURRENCY, ['controller' => 'TCurrency', 'action' => 'view', $tRequest->t_currency->ID_CURRENCY]) : '' ?></td>
                <td><?= $this->Number->format($tRequest->QT_FROM) ?></td>
                <td><?= $this->Number->format($tRequest->QT_TO) ?></td>
                <td><?= $tRequest->has('t_um') ? $this->Html->link($tRequest->t_um->ID_UM, ['controller' => 'TUm', 'action' => 'view', $tRequest->t_um->ID_UM]) : '' ?></td>
                <td><?= h($tRequest->DT_FROM) ?></td>
                <td><?= h($tRequest->DT_TO) ?></td>
                <td><?= $tRequest->has('t_place') ? $this->Html->link($tRequest->t_place->ID_PLACE, ['controller' => 'TPlace', 'action' => 'view', $tRequest->t_place->ID_PLACE]) : '' ?></td>
                <td><?= $this->Number->format($tRequest->LOC_DISTANCE) ?></td>
                <td><?= h($tRequest->LOG) ?></td>
                <td><?= $this->Number->format($tRequest->ID_TP_STATUS_REQ) ?></td>
                <td><?= h($tRequest->DH_LAST_UPDATE) ?></td>
                <td><?= $this->Number->format($tRequest->ID_TYPE_PRICE) ?></td>
                <td><?= $this->Number->format($tRequest->ID_PRICE_REF) ?></td>
                <td><?= h($tRequest->DT_PRICE_FIX_FROM) ?></td>
                <td><?= h($tRequest->DT_PRICE_FIX_TO) ?></td>
                <td><?= $this->Number->format($tRequest->ID_CROP) ?></td>
                <td><?= $this->Number->format($tRequest->ID_TYPE_DELIVERY) ?></td>
                <td><?= $this->Number->format($tRequest->TYPE_QUALITY) ?></td>
                <td><?= h($tRequest->QUALITY_INFO) ?></td>
                <td><?= $this->Number->format($tRequest->ACTIVE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tRequest->ID_REQUEST]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tRequest->ID_REQUEST]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tRequest->ID_REQUEST], ['confirm' => __('Are you sure you want to delete # {0}?', $tRequest->ID_REQUEST)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
