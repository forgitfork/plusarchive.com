<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\commands;

use app\models\query\TrackQuery;
use app\models\Track;
use jamband\ripple\Ripple;
use SplFileObject;
use Yii;
use yii\console\Controller;
use yii\helpers\FileHelper;

/**
 * TrackController class file.
 */
class TrackController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Yii::setAlias('@dump', Yii::getAlias('@runtime/dump'));
    }

    /**
     * Creates some csv files for each provider.
     */
    public function actionDump()
    {
        static::createDumpDirectory();

        foreach (Ripple::providers() as $provider) {
            static::dump($provider, Track::find()->select(['id', 'url']));
        }

        $this->stdout('All data has been dumped in '.Yii::getAlias('@dump').".\n");
    }

    /**
     * Creates a dump directory.
     */
    private static function createDumpDirectory()
    {
        FileHelper::createDirectory(Yii::getAlias('@dump'));
    }

    /**
     * @param string $provider
     * @param TrackQuery $query
     */
    private static function dump($provider, TrackQuery $query)
    {
        $file = new SplFileObject(Yii::getAlias("@dump/$provider.csv"), 'w');

        /** @var string[] $fields */
        foreach ($query->provider($provider)->asArray()->all() as $fields) {
            $file->fputcsv($fields);
        }
    }
}
