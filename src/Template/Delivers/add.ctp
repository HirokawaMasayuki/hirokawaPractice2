<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deliver $deliver
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Delivers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="delivers form large-9 medium-8 columns content">
    <?= $this->Form->create($deliver) ?>
    <fieldset>
        <legend><?= __('Add Deliver') ?></legend>
        <?php

//            $arrabc=[1,2,3];

            echo $this->Form->control('customer_id', ['options' => $arrCustomer]);
//            echo $this->Form->control('place_deliver_id', ['options' => $arrabc]);
            echo $this->Form->control('place_deliver_id');
            echo $this->Form->control('name');
            echo $this->Form->control('zip');
            echo $this->Form->control('address');
            echo $this->Form->control('tel');
            echo $this->Form->control('fax');
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
