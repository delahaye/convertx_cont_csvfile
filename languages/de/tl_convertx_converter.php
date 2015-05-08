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
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['CsvFile'] = 'CSV-Datei';

// fields
$GLOBALS['TL_LANG']['tl_convertx_converter']['hasFieldnames'][0]  = 'Erste Zeile enthält Feldnamen';
$GLOBALS['TL_LANG']['tl_convertx_converter']['hasFieldnames'][1]  = 'Die erste Zeile spezifiziert oft die Spaltennamen.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['lineFeed'][0]       = 'Zeilentrennung';
$GLOBALS['TL_LANG']['tl_convertx_converter']['lineFeed'][1]       = 'Zeilentrennzeichen der Datei. Standard: \n';

$GLOBALS['TL_LANG']['tl_convertx_converter']['enclosure'][0]      = 'Texteinfassung';
$GLOBALS['TL_LANG']['tl_convertx_converter']['enclosure'][1]      = 'Zeichen, mit dem Texte eingefasst sind. Standard: "';

$GLOBALS['TL_LANG']['tl_convertx_converter']['charSet'][0]        = 'Zeichensatz';
$GLOBALS['TL_LANG']['tl_convertx_converter']['charSet'][1]        = 'Zeichensatz der Datei. Standard: UTF-8';

$GLOBALS['TL_LANG']['tl_convertx_converter']['useDataInfile'][0]  = 'DATA INFILE nutzen';
$GLOBALS['TL_LANG']['tl_convertx_converter']['useDataInfile'][1]  = 'Die direkte mySQL-Methode zum Import nutzen.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldDelimiter'][0] = 'Trennzeichen';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldDelimiter'][1] = 'Trennzeichen in der Datei.';

// references
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['semicolon'] = 'Semikolon ;';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['comma']     = 'Komma ,';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['tab']       = 'Tabulator';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['space']     = 'Leerzeichen';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['pipe']      = 'Pipe |';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['syno']      = 'Tilde ~';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['n']         = '\\n';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['r']         = '\\r';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['nr']        = '\\n\\r';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['double']    = 'Anführungszeichen "';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['single']    = 'einfaches Anführungszeichen \'';
