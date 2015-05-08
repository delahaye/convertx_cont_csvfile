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


// converter type
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['CsvFile'] = 'CSV file';

// fields
$GLOBALS['TL_LANG']['tl_convertx_converter']['hasFieldnames'][0]  = 'First line contains field names';
$GLOBALS['TL_LANG']['tl_convertx_converter']['hasFieldnames'][1]  = 'The first line often specifies the column names.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['lineFeed'][0]       = 'Line feed';
$GLOBALS['TL_LANG']['tl_convertx_converter']['lineFeed'][1]       = 'Char for line feed. Standard: \n';

$GLOBALS['TL_LANG']['tl_convertx_converter']['enclosure'][0]      = 'Text included in';
$GLOBALS['TL_LANG']['tl_convertx_converter']['enclosure'][1]      = 'Chars, in which text is included. Standard: "';

$GLOBALS['TL_LANG']['tl_convertx_converter']['useDataInfile'][0]  = 'use DATA INFILE';
$GLOBALS['TL_LANG']['tl_convertx_converter']['useDataInfile'][1]  = 'Use the direct mySQL method for the import.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['charSet'][0]        = 'Charset';
$GLOBALS['TL_LANG']['tl_convertx_converter']['charSet'][1]        = 'Charset of the text file. Standard: UTF-8';

$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldDelimiter'][0] = 'Separator';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldDelimiter'][1] = 'Separator for columns.';

// references
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['semicolon'] = 'Semicolon ;';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['comma']     = 'comma ,';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['tab']       = 'tabulator';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['space']     = 'space';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['pipe']      = 'pipe |';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['syno']      = 'tilde ~';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['n']         = '\\n';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['r']         = '\\r';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['nr']        = '\\n\\r';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['double']    = 'marks "';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['single']    = 'single mark n \'';
