<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Deliver $deliver
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Deliver'), ['action' => 'edit', $deliver->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Deliver'), ['action' => 'delete', $deliver->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deliver->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Delivers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Deliver'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="delivers view large-9 medium-8 columns content">
    <h3><?= h($deliver->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($deliver->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $deliver->has('customer') ? $this->Html->link($deliver->customer->name, ['controller' => 'Customers', 'action' => 'view', $deliver->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Place Deliver Id') ?></th>
            <td><?= h($deliver->place_deliver_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($deliver->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zip') ?></th>
            <td><?= h($deliver->zip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($deliver->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tel') ?></th>
            <td><?= h($deliver->tel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fax') ?></th>
            <td><?= h($deliver->fax) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Staff') ?></th>
            <td><?= h($deliver->created_staff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated Staff') ?></th>
            <td><?= h($deliver->updated_staff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($deliver->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Flag') ?></th>
            <td><?= $this->Number->format($deliver->delete_flag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($deliver->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($deliver->updated_at) ?></td>
        </tr>
    </table>
</div>
