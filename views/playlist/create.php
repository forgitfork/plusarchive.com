<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @var yii\web\View $this
 * @var app\models\Playlist $model
 */

$this->title = 'Create Playlist - '.app()->name;
?>
<?= $this->render('/common/nav/create', ['model' => $model]) ?>
<?= $this->render('_form', ['model' => $model]); ?>
