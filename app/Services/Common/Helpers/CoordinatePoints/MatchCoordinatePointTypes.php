<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 05.08.2021
 * Time: 14:54
 */

namespace App\Services\Common\Helpers\CoordinatePoints;


class MatchCoordinatePointTypes
{
    const SERVICE_POINT_V1 = 1;// '1' => 'Офисы обслуживания',
    const TERMINAL_V1 = 2; // '2' => 'Терминалы',
    const BANKOMAT_V1 = 3;  //'3' => 'Банкоматы',
    const OTHERS_V1 = 4;  //'4' => 'Другие',

    const BANK = '81c43e8e-9d8f-44f7-9409-91f2c7f71027';
    const BRANCH = '765afda3-4e5c-40df-9334-b02c671c79a1';
    const CBO = '7f23bd28-5158-432c-9a71-22bd260648ad';
    const ATM = 'ece3dae7-294a-4f3d-9b04-6635bae07c2b';
    const TERMINAL = '04609c1b-9a11-489d-9ec8-96be2949776f';
    const QR = '04609c1b-9a11-489d-9ec8-96be2949776f';

    /**
     * @return array
     */
    public static function pointTypesApiVersionMathing()
    {
        return [
            self::BANK => self::SERVICE_POINT_V1,
            self::BRANCH => self::SERVICE_POINT_V1,
            self::CBO => self::SERVICE_POINT_V1,
            self::TERMINAL => self::TERMINAL_V1,
            self::ATM => self::BANKOMAT_V1,
        ];
    }

    /**
     * @param string $coordinatePointTypeId
     * @return int
     */
    public static function getOldType($coordinatePointTypeId)
    {
        return self::pointTypesApiVersionMathing()[$coordinatePointTypeId] ?? self::OTHERS_V1;
    }
}
