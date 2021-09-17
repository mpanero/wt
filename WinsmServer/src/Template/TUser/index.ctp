<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TUser[]|\Cake\Collection\CollectionInterface $tUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New T User'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tUser index large-9 medium-8 columns content">
    <h3><?= __('T User') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID_USER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('MAIL') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PASSWORD') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SURNAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('COMPANY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_GENDER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('BIRTHDATE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PHONE_MOBILE_COUNTRY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PHONE_MOBILE_NUM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PHONE_OTHER_COUNTRY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PHONE_OTHER_NUM') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_ROL') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_PLACE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_LEGAL') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVITY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ID_TYPE_STATUS_USER') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Q1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Q2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Q3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('USER_ADMIN') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tUser as $tUser): ?>
            <tr>
                <td><?= $this->Number->format($tUser->ID_USER) ?></td>
                <td><?= h($tUser->MAIL) ?></td>
                <td><?= $this->Number->format($tUser->ACTIVE) ?></td>
                <td><?= h($tUser->PASSWORD) ?></td>
                <td><?= h($tUser->NAME) ?></td>
                <td><?= h($tUser->SURNAME) ?></td>
                <td><?= h($tUser->COMPANY) ?></td>
                <td><?= $this->Number->format($tUser->ID_GENDER) ?></td>
                <td><?= h($tUser->BIRTHDATE) ?></td>
                <td><?= $this->Number->format($tUser->PHONE_MOBILE_COUNTRY) ?></td>
                <td><?= $this->Number->format($tUser->PHONE_MOBILE_NUM) ?></td>
                <td><?= $this->Number->format($tUser->PHONE_OTHER_COUNTRY) ?></td>
                <td><?= $this->Number->format($tUser->PHONE_OTHER_NUM) ?></td>
                <td><?= $this->Number->format($tUser->ID_ROL) ?></td>
                <td><?= $this->Number->format($tUser->ID_PLACE) ?></td>
                <td><?= $this->Number->format($tUser->ID_LEGAL) ?></td>
                <td><?= h($tUser->ACTIVITY) ?></td>
                <td><?= $this->Number->format($tUser->ID_TYPE_STATUS_USER) ?></td>
                <td><?= $this->Number->format($tUser->Q1) ?></td>
                <td><?= $this->Number->format($tUser->Q2) ?></td>
                <td><?= $this->Number->format($tUser->Q3) ?></td>
                <td><?= $this->Number->format($tUser->USER_ADMIN) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tUser->ID_USER]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tUser->ID_USER]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tUser->ID_USER], ['confirm' => __('Are you sure you want to delete # {0}?', $tUser->ID_USER)]) ?>
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
