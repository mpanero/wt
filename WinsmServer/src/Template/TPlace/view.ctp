<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TPlace $tPlace
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Place'), ['action' => 'edit', $tPlace->ID_PLACE]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Place'), ['action' => 'delete', $tPlace->ID_PLACE], ['confirm' => __('Are you sure you want to delete # {0}?', $tPlace->ID_PLACE)]) ?> </li>
        <li><?= $this->Html->link(__('List T Place'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Place'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tPlace view large-9 medium-8 columns content">
    <h3><?= h($tPlace->ID_PLACE) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('PLACE NAME') ?></th>
            <td><?= h($tPlace->PLACE_NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID PLACE') ?></th>
            <td><?= $this->Number->format($tPlace->ID_PLACE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID COUNTRY') ?></th>
            <td><?= $this->Number->format($tPlace->ID_COUNTRY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVE') ?></th>
            <td><?= $this->Number->format($tPlace->ACTIVE) ?></td>
        </tr>
    </table>
</div>
