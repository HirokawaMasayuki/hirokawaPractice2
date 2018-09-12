<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staff $staff
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $staff->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $staff->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Staffs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="staffs form large-9 medium-8 columns content">
    <?= $this->Form->create($staff) ?>
    <fieldset>
        <legend><?= __('Edit Staff') ?></legend>
        <?php
            echo $this->Form->control('emp_code');
            echo $this->Form->control('f_name');
            echo $this->Form->control('l_name');
            echo $this->Form->control('sex');
            echo $this->Form->control('birth', array('minYear' => date('Y') - 70));
            echo $this->Form->control('mail');
            echo $this->Form->control('tel');
            echo $this->Form->hidden('status');
            echo $this->Form->control('level');
            echo $this->Form->hidden('delete_flag');
            echo $this->Form->hidden('created_at');
            echo $this->Form->hidden('created_staff');
            echo $this->Form->hidden('updated_at', ['empty' => true]);
            echo $this->Form->hidden('updated_staff');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
