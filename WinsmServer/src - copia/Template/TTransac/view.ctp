<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TTransac $tTransac
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit T Transac'), ['action' => 'edit', $tTransac->ID_TRANSAC]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete T Transac'), ['action' => 'delete', $tTransac->ID_TRANSAC], ['confirm' => __('Are you sure you want to delete # {0}?', $tTransac->ID_TRANSAC)]) ?> </li>
        <li><?= $this->Html->link(__('List T Transac'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New T Transac'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tTransac view large-9 medium-8 columns content">
    <h3><?= h($tTransac->ID_TRANSAC) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('INFO') ?></th>
            <td><?= h($tTransac->INFO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TRANSAC') ?></th>
            <td><?= $this->Number->format($tTransac->ID_TRANSAC) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID USER') ?></th>
            <td><?= $this->Number->format($tTransac->ID_USER) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID REQUEST') ?></th>
            <td><?= $this->Number->format($tTransac->ID_REQUEST) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TRADE') ?></th>
            <td><?= $this->Number->format($tTransac->ID_TRADE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SEC') ?></th>
            <td><?= $this->Number->format($tTransac->SEC) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID TRANSAC TYPE') ?></th>
            <td><?= $this->Number->format($tTransac->ID_TRANSAC_TYPE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('VALUE') ?></th>
            <td><?= $this->Number->format($tTransac->VALUE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DH TRANSAC') ?></th>
            <td><?= h($tTransac->DH_TRANSAC) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('COMMENTS') ?></h4>
        <?= $this->Text->autoParagraph(h($tTransac->COMMENTS)); ?>
    </div>
</div>
