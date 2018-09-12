<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceProduct[]|\Cake\Collection\CollectionInterface $priceProducts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Price Product'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="priceProducts index large-9 medium-8 columns content">
    <h3><?= __('Price Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_staff') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_staff') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($priceProducts as $priceProduct): ?>
            <tr>
                <td><?= h($priceProduct->id) ?></td>
                <td><?= $priceProduct->has('product') ? $this->Html->link($priceProduct->product->id, ['controller' => 'Products', 'action' => 'view', $priceProduct->product->id]) : '' ?></td>
                <td><?= $priceProduct->has('customer') ? $this->Html->link($priceProduct->customer->name, ['controller' => 'Customers', 'action' => 'view', $priceProduct->customer->id]) : '' ?></td>
                <td><?= $this->Number->format($priceProduct->price) ?></td>
                <td><?= h($priceProduct->start) ?></td>
                <td><?= $this->Number->format($priceProduct->status) ?></td>
                <td><?= $this->Number->format($priceProduct->delete_flag) ?></td>
                <td><?= h($priceProduct->created_at) ?></td>
                <td><?= h($priceProduct->created_staff) ?></td>
                <td><?= h($priceProduct->updated_at) ?></td>
                <td><?= h($priceProduct->updated_staff) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $priceProduct->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $priceProduct->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $priceProduct->id], ['confirm' => __('Are you sure you want to delete # {0}?', $priceProduct->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
