<?php

/**
 * ConvertX
 * Extension for Contao Open Source CMS (contao.org)
 *
 * Copyright (c) 2015 de la Haye
 *
 * @author  Christian de la Haye
 * @link    http://delahaye.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Delahaye\ConvertX\Dca;

/**
 * Class ConverterCsvfile
 *
 * DCA callbacks for tl_convertx_converter
 *
 * @package Delahaye\ConvertX\Dca
 */
class ConverterCsvfile extends \Backend
{

    /**
     * Options for delimiters fields
     */
    public function getDelimiters()
    {
        foreach ($GLOBALS['convertx']['csv_delimiters'] as $k => $v) {
            $arrReturn[] = $k;
        }

        return $arrReturn;
    }

}
