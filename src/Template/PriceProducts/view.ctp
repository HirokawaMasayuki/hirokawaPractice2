<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceProduct $priceProduct
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Price Product'), ['action' => 'edit', $priceProduct->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Price Product'), ['action' => 'delete', $priceProduct->id], ['confirm' => __('Are you sure you want to delete # {0}?', $priceProduct->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Price Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="priceProducts view large-9 medium-8 columns content">
    <h3><?= h($priceProduct->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($priceProduct->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $priceProduct->has('product') ? $this->Html->link($priceProduct->product->id, ['controller' => 'Products', 'action' => 'view', $priceProduct->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $priceProduct->has('customer') ? $this->Html->link($priceProduct->customer->name, ['controller' => 'Customers', 'action' => 'view', $priceProduct->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Staff') ?></th>
            <td><?= h($priceProduct->created_staff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated Staff') ?></th>
            <td><?= h($priceProduct->updated_staff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($priceProduct->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($priceProduct->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Flag') ?></th>
            <td><?= $this->Number->format($priceProduct->delete_flag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start') ?></th>
            <td><?= h($priceProduct->start) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($priceProduct->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($priceProduct->updated_at) ?></td>
        </tr>
    </table>
</div>
