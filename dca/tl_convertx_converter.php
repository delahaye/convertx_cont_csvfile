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
 * Table tl_convertx_converter
 */


// Set type as source and/or target
$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['sourceType']['options'][] = 'CsvFile';
//$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['targetType']['options'][] = 'CsvFile';

// Subpalettes for source and/or target
$GLOBALS['TL_DCA']['tl_convertx_converter']['targetpalettes']['CsvFile'] = 'targetFile,targetDir,fileName,targetFieldDelimiter,targetHasFieldnames';
$GLOBALS['TL_DCA']['tl_convertx_converter']['sourcepalettes']['CsvFile'] = 'sourceFile,sourceCharSet,sourceLineFeed,sourceEnclosure,sourceUseDataInfile,sourceFieldDelimiter,sourceHasFieldnames';

// Fields

$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['sourceFile'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceFile'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'fileTree',
    'eval'                    => array('submitOnChange'=>true, 'fieldType'=>'radio', 'files'=>true, 'extensions'=>'', 'tl_class'=>'clr', 'mandatory'=>true),
    'sql'                     => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['sourceFieldDelimiter'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldDelimiter'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback'        => array('Delahaye\ConvertX\Dca\ConverterCsvFile','getDelimiters'),
    'default'                 => 'semicolon',
    'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converter']['references'],
    'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['sourceHasFieldnames'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['hasFieldnames'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 m12'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['sourceUseDataInfile'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['useDataInfile'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'m12'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['sourceLineFeed'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['lineFeed'],
    'exclude'                 => true,
    'search'                  => true,
    'sorting'                 => true,
    'inputType'               => 'select',
    'options'                 => array('n', 'r', 'nr'),
    'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converter']['references'],
    'default'                 => 'n',
    'eval'                    => array('includeBlankOption'=>true, 'maxlength'=>255),
    'sql'                     => "varchar(8) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['sourceEnclosure'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['enclosure'],
    'exclude'                 => true,
    'search'                  => true,
    'sorting'                 => true,
    'inputType'               => 'select',
    'options'                 => array('double', 'single'),
    'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converter']['references'],
    'default'                 => 'double',
    'eval'                    => array('includeBlankOption'=>true, 'maxlength'=>255),
    'sql'                     => "varchar(8) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['sourceCharSet'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['charSet'],
    'exclude'                 => true,
    'search'                  => true,
    'sorting'                 => true,
    'inputType'               => 'select',
    'options'                 => $GLOBALS['convertx']['char_sets'],
    'default'                 => 'utf8',
    'eval'                    => array('includeBlankOption'=>true, 'maxlength'=>255),
    'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['targetFile'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['targetFile'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'fileTree',
    'eval'                    => array('submitOnChange'=>true, 'fieldType'=>'radio', 'files'=>true, 'tl_class'=>'clr', 'mandatory'=>true),
    'sql'                     => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['targetDir'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['targetDir'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'fileTree',
    'eval'                    => array('fieldType'=>'radio', 'files'=>false, 'tl_class'=>'clr', 'mandatory'=>true),
    'sql'                     => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['fileName'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fileName'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('tl_class'=>'long'),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['targetFieldDelimiter'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldDelimiter'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback'        => array('Delahaye\ConvertX\Dca\ConverterCsvFile','getDelimiters'),
    'default'                 => 'semicolon',
    'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converter']['references'],
    'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['targetHasFieldnames'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['hasFieldnames'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 m12'),
    'sql'                     => "char(1) NOT NULL default ''"
);


// Set extensions for BE-select

if(Input::get('id') && Input::get('table') == 'tl_convertx_converter')
{
    $objConverter = Delahaye\ConvertX\Model\Converter::findByPk(\Input::get('id'));

    if($objConverter->sourceType == 'CsvFile')
    {
        $GLOBALS['TL_DCA']['tl_convertx_converter']['fields']['sourceFile']['eval']['extensions'] = $GLOBALS['convertx']['extensions']['CsvFile'];
    }
}
