<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\models\common;

use yii\base\Action;
use yii\db\ActiveQuery;

/**
 * @method ActiveQuery find()
 */
trait ActiveRecordTrait
{
    /**
     * Returns all name attribute values.
     *
     * @return ActiveQuery
     */
    public static function getNames(): ActiveQuery
    {
        return static::find()
            ->select('name')
            ->orderBy(['name' => SORT_ASC]);
    }

    /**
     * Returns all countries.
     *
     * @return array
     */
    public static function getCountries(): array
    {
        return static::find()
            ->select('country')
            ->distinct()
            ->orderBy(['country' => SORT_ASC])
            ->column();
    }

    /**
     * Returns all ids.
     *
     * @return array
     */
    public static function getIds(): array
    {
        return static::find()
            ->select('id')
            ->column();
    }
}
