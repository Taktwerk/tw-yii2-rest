<?php
/**
 * Taktwerk.ch 2016
 * tw-yii2-rest package
 */

namespace taktwerk\rest;

use yii;
use yii\data\ActiveDataProvider;

class IndexAction extends \yii\rest\IndexAction
{
    /**
     * @return ActiveDataProvider
     */
    protected function prepareDataProvider()
    {
        $modelClass = $this->modelClass;

        $sort = yii::$app->request->get('sort','');
        $group = yii::$app->request->get('group','');

        $query = CreateQueryHelper::createQuery($this->modelClass);
        CreateQueryHelper::addOrderSort($sort, $modelClass::tableName(), $query);
        CreateQueryHelper::addGroup($group, $modelClass::tableName(), $query);

        return new ActiveDataProvider([
            'query' => $query->distinct(),
            'pagination' => isset($_GET['page'])? [] : false
        ]);
    }
}
