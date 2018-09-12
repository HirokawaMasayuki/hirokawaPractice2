<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staff[]|\Cake\Collection\CollectionInterface $staffs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Staff'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="staffs index large-9 medium-8 columns content">
    <h3><?= __('Staffs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('emp_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('f_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('l_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sex') ?></th>
                <th scope="col"><?= $this->Paginator->sort('birth') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mail') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('level') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_staff') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_staff') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staffs as $staff): ?>
            <tr>
                <td><?= h($staff->id) ?></td>
                <td><?= h($staff->emp_code) ?></td>
                <td><?= h($staff->f_name) ?></td>
                <td><?= h($staff->l_name) ?></td>
                <td><?= h($staff->sex) ?></td>
                <td><?= h($staff->birth) ?></td>
                <td><?= h($staff->mail) ?></td>
                <td><?= h($staff->tel) ?></td>
                <td><?= $this->Number->format($staff->status) ?></td>
                <td><?= h($staff->level) ?></td>
                <td><?= $this->Number->format($staff->delete_flag) ?></td>
                <td><?= h($staff->created_at) ?></td>
                <td><?= h($staff->created_staff) ?></td>
                <td><?= h($staff->updated_at) ?></td>
                <td><?= h($staff->updated_staff) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $staff->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $staff->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $staff->id], ['confirm' => __('Are you sure you want to delete # {0}?', $staff->id)]) ?>
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
