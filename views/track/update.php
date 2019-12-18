<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @var yii\web\View $this
 * @var app\models\Track $model
 */

$this->title = "Update Track: $model->title - ".app()->name;
?>
<?= $this->render('/common/nav/update', ['model' => $model]) ?>
<?= $this->render('_form', ['model' => $model, 'action' => 'Update']) ?>
<?= $this->render('/common/js/select-multiple', ['id' => '#trackupdateform-tagvalues']) ?>
