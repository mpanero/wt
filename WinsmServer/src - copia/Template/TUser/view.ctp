<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TUser $tUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T User'), ['action' => 'edit', $tUser->ID_USER]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T User'), ['action' => 'delete', $tUser->ID_USER], ['confirm' => __('Are you sure you want to delete # {0}?', $tUser->ID_USER)]) ?> </li>
        <li><?= $this->Html->link(__('List T User'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T User'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tUser view large-9 medium-8 columns content">
    <h3><?= h($tUser->ID_USER) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('MAIL') ?></th>
            <td><?= h($tUser->MAIL) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PASSWORD') ?></th>
            <td><?= h($tUser->PASSWORD) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('NAME') ?></th>
            <td><?= h($tUser->NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SURNAME') ?></th>
            <td><?= h($tUser->SURNAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('GENDER') ?></th>
            <td><?= h($tUser->GENDER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PHONE MOBILE') ?></th>
            <td><?= h($tUser->PHONE_MOBILE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PHONE OTHER') ?></th>
            <td><?= h($tUser->PHONE_OTHER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID USER') ?></th>
            <td><?= $this->Number->format($tUser->ID_USER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tUser->ACTIVE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PLACE') ?></th>
            <td><?= $this->Number->format($tUser->ID_PLACE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('BIRTHDATE') ?></th>
            <td><?= h($tUser->BIRTHDATE) ?></td>
        </tr>
    </table>
</div>
