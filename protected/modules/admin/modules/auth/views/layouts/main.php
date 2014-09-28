<?php
/* @var $this AuthController */
?>

<div class="auth-module">

    <?php $this->widget(
        'bootstrap.widgets.TbNav',
        array(
            'type' => TbHtml::NAV_TYPE_TABS,
            'items' => array(
                array(
                    'label' => Yii::t('AuthModule.main', 'Assignments'),
                    'url' => array('/admin/auth/assignment/index'),
                    'active' => $this instanceof AssignmentController,
                ),
                array(
                    'label' => $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_ROLE, true)),
                    'url' => array('/admin/auth/role/index'),
                    'active' => $this instanceof RoleController,
                ),
                array(
                    'label' => $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_TASK, true)),
                    'url' => array('/admin/auth/task/index'),
                    'active' => $this instanceof TaskController,
                ),
                array(
                    'label' => $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_OPERATION, true)),
                    'url' => array('/admin/auth/operation/index'),
                    'active' => $this instanceof OperationController,
                ),
            ),
        )
    );?>

    <?php echo $content; ?>

</div>