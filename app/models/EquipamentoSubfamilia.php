<?php

namespace app\models;

class EquipamentoSubfamilia extends EquipamentoSubfamiliaBase
{
    public function getSubFamiliaList($familia_id) {
        $subFamilias = EquipamentoSubfamilia::find()->where("familia_id = $familia_id")->all();

        $result = [];
        /** @var EquipamentoSubfamilia $sf */
        foreach ($subFamilias as $sf){
            $result = ['id'=> $sf->id, 'name'=> $sf->subfamilia];
        }
        return $result;
    }

    public static function getSubfamilia($familia_id) {
        $data = EquipamentoSubfamilia::find()
            ->where(['familia_id'=>$familia_id])
//            ->select(['id','subFamilia'])->asArray()->all();
        ->select(['id','subfamilia AS name'])->asArray()->all();
        return $data;
    }
}
