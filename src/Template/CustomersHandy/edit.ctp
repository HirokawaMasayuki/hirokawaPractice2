<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomersHandy $customersHandy
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $customersHandy->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $customersHandy->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Customers Handy'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customersHandy form large-9 medium-8 columns content">
    <?= $this->Form->create($customersHandy) ?>
    <fieldset>
        <legend><?= __('Edit Customers Handy') ?></legend>
        <?php
            echo $this->Form->control('customer_id', ['options' => $arrCustomer]);
            echo $this->Form->control('place_deliver_id', ['options' => $arrDeliver]);
            echo $this->Form->control('name');
            echo $this->Form->control('flag');
//            echo $this->Form->control('created_at');
//            echo $this->Form->control('created_staff');
//            echo $this->Form->control('updated_at', ['empty' => true]);
            echo $this->Form->hidden('updated_staff');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
