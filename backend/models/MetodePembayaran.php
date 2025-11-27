<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "metode_pembayaran".
 *
 * @property int $id
 * @property string $nama_metode
 * @property string $nomor_rekening
 */
class MetodePembayaran extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metode_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_metode', 'nomor_rekening'], 'required'],
            [['nama_metode'], 'string', 'max' => 255],
            [['nomor_rekening'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_metode' => 'Nama Metode',
            'nomor_rekening' => 'Nomor Rekening',
        ];
    }

}
