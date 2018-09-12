<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceProduct $priceProduct
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Price Products'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="priceProducts form large-9 medium-8 columns content">
    <?= $this->Form->create($priceProduct) ?>
    <fieldset>
        <legend><?= __('Add Price Product') ?></legend>
        <?php
            echo $this->Form->control('product_id', ['options' => $arrProduct]);
            echo $this->Form->control('customer_id', ['options' => $arrCustomer]);
            echo $this->Form->control('price');
            echo $this->Form->control('start');
            echo $this->Form->control('status');
            echo $this->Form->control('delete_flag');
            echo $this->Form->hidden('created_at');
            echo $this->Form->hidden('created_staff');
//            echo $this->Form->control('updated_at', ['empty' => true]);
//            echo $this->Form->control('updated_staff');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
