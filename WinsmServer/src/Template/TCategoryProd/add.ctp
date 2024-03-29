<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TCategoryProd $tCategoryProd
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List T Category Prod'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tCategoryProd form large-9 medium-8 columns content">
    <?= $this->Form->create($tCategoryProd) ?>
    <fieldset>
        <legend><?= __('Add T Category Prod') ?></legend>
        <?php
            echo $this->Form->control('CATEGORY_PROD_NAME');
            echo $this->Form->control('ID_MARKET');
            echo $this->Form->control('ACTIVE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
