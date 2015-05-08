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

namespace Delahaye\ConvertX\Container;

use \FilesModel;
use \File;
use \String;
use \Database;
use Delahaye\ConvertX\Helper;
use Delahaye\ConvertX\Model\Converter as ConverterModel;
use Delahaye\ConvertX\Interfaces\Container;


/**
 * Class CsvFile
 *
 * Methods for a CSV file container
 *
 * @package Delahaye\ConvertX\Container
 */
class CsvFile implements Container
{

    /**
     * Get field info
     *
     * @param $objDef
     * @param $strType
     * @return array|mixed
     */
    public static function getFieldList($objDef, $strType)
    {
        // source or target
        $strFile = $strType . 'File';
        $strFieldDelimiter = $strType . 'FieldDelimiter';
        $strHasFieldnames = $strType . 'HasFieldnames';

        // pre-build return array
        $arrReturn = array();

        // already a file defined
        if ($objDef->$strFile) {
            $objFiles = FilesModel::findByUuid($objDef->$strFile);

            $objFile = new File($objFiles->path);

            // read first line as CSV
            $arrFirstLine = String::splitCsv(trim(fgets($objFile->handle, 40960)), $GLOBALS['convertx']['csv_delimiters'][$objDef->$strFieldDelimiter]);

            switch ($objDef->$strHasFieldnames) {
                case '1':
                    // show real fieldnames
                    foreach ($arrFirstLine as $k => $v) {
                        $arrReturn[] = array
                        (
                            'name' => (!trim($v) ? 'FLD_' . $k : str_replace('-', '_', standardize($v))),
                            'type' => 'longtext',
                            'unique' => ''
                        );
                    }
                    break;
                default:
                    // build dummy field names
                    foreach ($arrFirstLine as $k => $v) {
                        $arrReturn[] = array
                        (
                            'name' => 'FLD_' . $k,
                            'type' => 'longtext',
                            'unique' => ''
                        );
                    }
                    break;
            }
        }

        return $arrReturn;
    }


    /**
     * Get demo data
     *
     * @param $objDef
     * @param $strType
     * @param int $intCount
     * @return array
     */
    public static function getDemoData($objDef, $strType, $intCount = 3)
    {
        // source or target
        $strFile = $strType . 'File';
        $strFieldDelimiter = $strType . 'FieldDelimiter';
        $strHasFieldnames = $strType . 'HasFieldnames';
        $strCharSet = $strType . 'CharSet';
        $strLineFeed = $strType . 'LineFeed';

        // pre-build return array
        $arrRows = array();

        // already a file defined
        if ($objDef->$strFile) {
            $objFiles = FilesModel::findByUuid($objDef->$strFile);

            $objFile = new File($objFiles->path);
            $strCompleteFile = $objFile->getContent();
            $strFirstLine = trim(fgets($objFile->handle, 40960));

            // determine if file is utf-8
            $blnIsUtf8 = Helper::getEncoding($strCompleteFile, 'utf-8');

            if (!$blnIsUtf8) {
                $strFirstLine = utf8_encode($strFirstLine);
            }

            $arrKeys = String::splitCsv($strFirstLine, $GLOBALS['convertx']['csv_delimiters'][$objDef->$strFieldDelimiter]);

            switch ($objDef->$strHasFieldnames) {
                case '1':
                    for ($i = 0; $i < count($arrKeys); $i++) {
                        $arrRows[$i]['data'][] = (!trim($arrKeys[$i]) ? 'FLD_' . $i : str_replace('-', '_', standardize($arrKeys[$i])));
                    }
                    break;
                default:
                    // build dummy field names
                    for ($i = 0; $i < count($arrKeys); $i++) {
                        $arrRows[$i]['data'][] = 'FLD_' . $i;
                    }
                    break;
            }

            for ($ii = 0; $ii < $intCount; $ii++) {
                $strText = trim(fgets($objFile->handle, 40960));

                if (!$blnIsUtf8) {
                    $strText = utf8_encode($strText);
                }

                $arrRow = String::splitCsv($strText, $GLOBALS['convertx']['csv_delimiters'][$objDef->$strFieldDelimiter]);
                for ($i = 0; $i < count($arrKeys); $i++) {
                    $arrRows[$i]['data'][] = $arrRow[$i];
                    $arrRows[$i]['class'] = 'row_' . $i . (($i == 0) ? ' row_first' : '') . ((($i + 1) == count($arrKeys)) ? ' row_last' : '') . ((($i % 2) == 0) ? ' even' : ' odd');
                }
            }

        }

        return $arrRows;
    }


    /**
     * Check if target field list has to be truncated
     *
     * @param $dc
     * @param $objData
     * @return bool|mixed
     */
    public static function checkTargetClear($dc, $objData)
    {
        if ($dc->activeRecord->sourceType != $objData->sourceType
            || $dc->activeRecord->sourceFile != $objData->sourceFile
            || $dc->activeRecord->sourceFieldDelimiter != $objData->sourceFieldDelimiter
            || $dc->activeRecord->sourceHasFieldnames != $objData->sourceHasFieldnames
        ) {
            return true;
        }

        return false;
    }


    /**
     * Do the raw data import
     *
     * @param $intConverter
     * @param $objRun
     * @return bool|mixed
     */
    public static function rawImport($intConverter, $objRun)
    {
        // tmp table mit csv befüllen

        $objConverter = ConverterModel::findByPk($intConverter);

        $arrFields = unserialize($objConverter->fieldsSource);
        foreach ($arrFields as $k => $v) {
            $arrFieldNames[] = $v['name'];
        }

        // the csv file
        $objCsv = FilesModel::findByUuid($objConverter->sourceFile);
        //print_r($objCsv);die();

        // set or determine char set
        $strCharset = $objConverter->sourceCharSet ? $objConverter->sourceCharSet : false;

        // set or determine line feed
        $strLinefeed = $objConverter->sourceLineFeed ? $GLOBALS['convertx']['csv_linefeeds'][$objConverter->sourceLineFeed] : false;

        // determine charset and/or line feed
        if(!$strCharset || !$strLinefeed) {
            $objFile = new File($objCsv->path);
            $strCompleteFile = $objFile->getContent();
            $strFirstLine = fgets($objFile->handle, 40960);

            $strCharset = $strCharset ? $strCharset : Helper::getEncoding($strCompleteFile);

            $strLinefeed = $strLinefeed ? $strLinefeed : Helper::getLineFeed($strFirstLine);
        }

        // set or determine enclosure
        $strEnclosure = $objConverter->sourceEnclosure ? '\\' . $GLOBALS['convertx']['csv_enclosures'][$objConverter->sourceEnclosure] : '\"';

        // delete all data in the source table (maybe there after an error before)
        Database::getInstance()->prepare("TRUNCATE cvx_" . $intConverter . "_source")->execute();

        if(!$objConverter->sourceUseDataInfile) {

            // handle csv file line by line

            $objFile = new File($objCsv->path);
            $arrCompleteFile = $objFile->getContentAsArray();

            foreach($arrCompleteFile as $k=>$v){
                if($k>0 || !$objConverter->sourceHasFieldnames) {
                    $arrLine = String::splitCsv($v, $GLOBALS['convertx']['csv_delimiters'][$objConverter->sourceFieldDelimiter]);

                    $arrSet = array();
                    foreach($arrFieldNames as $k2=>$v2){
                        $arrSet[$v2] = $arrLine[$k2];
                    }

                    Database::getInstance()->prepare("insert into cvx_" . $intConverter . "_source %s")->set($arrSet)->execute();
                }
            }
        } else {

            // load it directly into the database

            $strSql = sprintf("LOAD DATA LOCAL INFILE '%s' INTO TABLE `%s` CHARACTER SET %s FIELDS TERMINATED BY '%s' OPTIONALLY ENCLOSED BY '%s' LINES TERMINATED BY '%s' IGNORE %s LINES (`%s`)",
                addslashes(TL_ROOT . '/' . $objCsv->path),
                'cvx_' . $intConverter . '_source',
                $strCharset,
                $GLOBALS['convertx']['csv_delimiters'][$objConverter->sourceFieldDelimiter],
                $strEnclosure,
                $strLinefeed,
                ($objConverter->sourceHasFieldnames ? '1' : '0'),
                implode('`, `', $arrFieldNames)
            );

            Database::getInstance()->prepare($strSql)->execute();
        }

        // try to eliminate lines that are completely empty
        Database::getInstance()->prepare("DELETE FROM cvx_" . $intConverter . "_source WHERE `" . implode("`='' AND `", $arrFieldNames) . "`=''")->execute();

        return true;
    }


    /**
     * Export a file
     *
     * @param $intConverter
     * @param $objRun
     * @return bool|mixed
     */
    public static function finalize($intConverter, $objRun)
    {

        // todo: write a csv file

        return true;
    }

}
