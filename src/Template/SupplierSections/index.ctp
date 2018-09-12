<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SupplierSection[]|\Cake\Collection\CollectionInterface $supplierSections
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Supplier Section'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="supplierSections index large-9 medium-8 columns content">
    <h3><?= __('Supplier Sections') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('account_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_staff') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_staff') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($supplierSections as $supplierSection): ?>
            <tr>
                <td><?= h($supplierSection->id) ?></td>
                <td><?= h($supplierSection->name) ?></td>
                <td><?= h($supplierSection->account_code) ?></td>
                <td><?= $this->Number->format($supplierSection->delete_flag) ?></td>
                <td><?= h($supplierSection->created_at) ?></td>
                <td><?= h($supplierSection->created_staff) ?></td>
                <td><?= h($supplierSection->updated_at) ?></td>
                <td><?= h($supplierSection->updated_staff) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $supplierSection->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $supplierSection->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $supplierSection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplierSection->id)]) ?>
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
