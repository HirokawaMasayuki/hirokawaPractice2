<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceMaterial[]|\Cake\Collection\CollectionInterface $priceMaterials
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Price Material'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Supplier'), ['controller' => 'Suppliers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="priceMaterials index large-9 medium-8 columns content">
    <h3><?= __('Price Materials') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('material_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('supplier_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start') ?></th>
                <th scope="col"><?= $this->Paginator->sort('finish') ?></th>
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
            <?php foreach ($priceMaterials as $priceMaterial): ?>
            <tr>
                <td><?= h($priceMaterial->id) ?></td>
                <td><?= $priceMaterial->has('material') ? $this->Html->link($priceMaterial->material->id, ['controller' => 'Materials', 'action' => 'view', $priceMaterial->material->id]) : '' ?></td>
                <td><?= $priceMaterial->has('supplier') ? $this->Html->link($priceMaterial->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $priceMaterial->supplier->id]) : '' ?></td>
                <td><?= $this->Number->format($priceMaterial->price) ?></td>
                <td><?= h($priceMaterial->start) ?></td>
                <td><?= h($priceMaterial->finish) ?></td>
                <td><?= $this->Number->format($priceMaterial->status) ?></td>
                <td><?= $this->Number->format($priceMaterial->delete_flag) ?></td>
                <td><?= h($priceMaterial->created_at) ?></td>
                <td><?= h($priceMaterial->created_staff) ?></td>
                <td><?= h($priceMaterial->updated_at) ?></td>
                <td><?= h($priceMaterial->updated_staff) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $priceMaterial->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $priceMaterial->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $priceMaterial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $priceMaterial->id)]) ?>
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
