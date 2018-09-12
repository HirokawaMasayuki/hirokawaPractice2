<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomersHandy $customersHandy
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Customers Handy'), ['action' => 'edit', $customersHandy->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customers Handy'), ['action' => 'delete', $customersHandy->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customersHandy->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customers Handy'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customers Handy'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customersHandy view large-9 medium-8 columns content">
    <h3><?= h($customersHandy->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($customersHandy->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $customersHandy->has('customer') ? $this->Html->link($customersHandy->customer->name, ['controller' => 'Customers', 'action' => 'view', $customersHandy->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Place Deliver Id') ?></th>
            <td><?= h($customersHandy->place_deliver_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($customersHandy->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Staff') ?></th>
            <td><?= h($customersHandy->created_staff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated Staff') ?></th>
            <td><?= h($customersHandy->updated_staff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Flag') ?></th>
            <td><?= $this->Number->format($customersHandy->flag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($customersHandy->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($customersHandy->updated_at) ?></td>
        </tr>
    </table>
</div>
