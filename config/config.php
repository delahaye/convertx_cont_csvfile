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


/**
 * Set possible CSV delimiters
 */
$GLOBALS['convertx']['csv_delimiters'] = array
(
    'semicolon' => ';',
    'comma'     => ',',
    'tab'       => '\t',
    'space'     => ' ',
    'pipe'      => '|',
    'syno'      => '~'
);


/**
 * Set possible CSV enclosures
 */
$GLOBALS['convertx']['csv_enclosures'] = array
(
    'double' => '"',
    'single' => '\'',
);


/**
 * Set possible CSV linefeeds
 */
$GLOBALS['convertx']['csv_linefeeds'] = array
(
    'n' => '\n',
    'r' => '\r',
    'nr' => '\n\r',
);


/**
 * Set possible CSV extensions
 */
$GLOBALS['convertx']['extensions']['CsvFile'] = 'csv,txt';
