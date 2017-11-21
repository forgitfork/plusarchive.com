<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\controllers;

use app\models\search\TrackGenreSearch;
use app\models\TrackGenre;
use yii\filters\AccessControl;
use yii\filters\AjaxFilter;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class TrackGenreController extends Controller
{
    /**
     * {@inheritdoc}
     * @throws NotFoundHttpException
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['admin', 'list', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
                'denyCallback' => function () {
                    throw new NotFoundHttpException('Page not found.');
                }
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            [
                'class' => AjaxFilter::class,
                'only' => ['list'],
            ],
        ];
    }

    /**
     * Manages all TrackGenre models.
     * @return string
     */
    public function actionAdmin()
    {
        return $this->render('admin', [
            'search' => $searchModel = new TrackGenreSearch,
            'data' => $searchModel->search(request()->queryParams),
        ]);
    }

    /**
     * Returns all genres name.
     * @return Response
     */
    public function actionList()
    {
        return $this->asJson(TrackGenre::getNames()->all());
    }

    /**
     * Updates an existing TrackGenre model.
     * @param int $id
     * @return string|Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(request()->post()) && $model->save()) {
            session()->setFlash('success', 'Track genre has been updated.');
            return $this->redirect(['admin']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TrackGenre model.
     * @param int $id
     * @return Response
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        session()->setFlash('success', 'Track genre has been deleted.');
        return $this->redirect(['admin']);
    }

    /**
     * Finds the TrackGenre model based on its primary key value.
     * @param int $id
     * @return TrackGenre
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $model = TrackGenre::findOne($id);
        if (null === $model) {
            throw new NotFoundHttpException('Page not found.');
        }
        return $model;
    }
}
