<?php

declare(strict_types=1);

use HDNET\Autoloader\Utility\ArrayUtility;
use HDNET\Autoloader\Utility\ModelUtility;
use HDNET\Autoloader\Utility\TranslateUtility;
use Checkitsedo\Calendarize\Domain\Model\Event;
use Checkitsedo\Calendarize\Service\TcaService;
use Checkitsedo\Calendarize\Utility\ConfigurationUtility;
use TYPO3\CMS\Core\Resource\File;

$base = ModelUtility::getTcaInformation(Event::class);

$custom = [
    'ctrl' => [
        'hideTable' => (bool)ConfigurationUtility::get('disableDefaultEvent'),
        'searchFields' => 'uid,title,description',
        'thumbnail' => 'images',
        'label_userFunc' => TcaService::class . '->eventTitle',
    ],
    'columns' => [
        'title' => [
            'config' => [
                'eval' => 'required',
            ],
        ],
        'abstract' => [
            'config' => [
                'type' => 'text',
            ],
        ],
        'import_id' => [
            'config' => [
                'readOnly' => true,
            ],
        ],
        'location_link' => [
            'config' => [
                'renderType' => 'inputLink',
            ],
        ],
        'organizer_link' => [
            'config' => [
                'renderType' => 'inputLink',
            ],
        ],
        'artist_description' => [
            'config' => [
                'type' => 'text',
            ],
        ],
        'artist_link' => [
            'config' => [
                'renderType' => 'inputLink',
            ],
        ],
        'instructor_description' => [
            'config' => [
                'type' => 'text',
            ],
        ],
        'instructor_link' => [
            'config' => [
                'renderType' => 'inputLink',
            ],
        ],
        'free_entry' => [
            'onChange' => 'reload',
            'config' => [
                'default' => '0',
            ],
        ],
        'collection' => [
            'onChange' => 'reload',
            'config' => [
                'default' => '0',
            ],
            'displayCond' => [
                'AND' => [
                    'FIELD:free_entry:!=:0',
                ],
            ],
        ],
        'collection_reference' => [
            'onChange' => 'reload',
            'displayCond' => [
                'AND' => [
					'FIELD:free_entry:!=:0',
                    'FIELD:collection:!=:0',
                ],
            ],
        ],
        'registration_required' => [
            'config' => [
                'default' => '0',
            ],
            'displayCond' => [
                'AND' => [
                    'FIELD:free_entry:!=:0',
                ],
            ],
        ],
        'price_standard' => [
            'onChange' => 'reload',
            'displayCond' => [
                'AND' => [
                    'FIELD:free_entry:!=:1',
                ],
            ],
        ],
        'price_reduced' => [
            'onChange' => 'reload',
            'displayCond' => [
                'AND' => [
                    'FIELD:free_entry:!=:1',
                ],
            ],
        ],
        'booking_required' => [
            'config' => [
                'default' => '0',
            ],
            'displayCond' => [
                'AND' => [
                    'FIELD:free_entry:!=:1',
                ],
            ],
        ],
        'external_booking' => [
            'config' => [
                'default' => '0',
            ],
            'displayCond' => [
                'AND' => [
                    'FIELD:free_entry:!=:1',
                    'FIELD:booking_required:!=:0',
                ],
            ],
        ],
        'booking_link' => [
            'config' => [
                'renderType' => 'inputLink',
            ],
            'displayCond' => [
                'AND' => [
                    'FIELD:free_entry:!=:1',
                    'FIELD:external_booking:!=:0',
                ],
            ],
        ],
        'images' => [
            'config' => [
                // Use the imageoverlayPalette instead of the basicoverlayPalette
                'overrideChildTca' => [
                    'types' => [
                        '0' => [
                            'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette',
                        ],
                        File::FILETYPE_TEXT => [
                            'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette',
                        ],
                        File::FILETYPE_IMAGE => [
                            'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette',
                        ],
                        File::FILETYPE_AUDIO => [
                            'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.audioOverlayPalette;audioOverlayPalette,
                                --palette--;;filePalette',
                        ],
                        File::FILETYPE_VIDEO => [
                            'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.videoOverlayPalette;videoOverlayPalette,
                                --palette--;;filePalette',
                        ],
                        File::FILETYPE_APPLICATION => [
                            'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'palettes' => [
		'location_fields' => [
			'label' => 'location_fields',
			'showitem' => 'location,location_link',
		],
		'organizer_fields' => [
			'label' => 'organizer_fields',
			'showitem' => 'organizer,organizer_link',
		],
		'artist_fields' => [
			'label' => 'artist_fields',
			'showitem' => 'artist,artist_link,--linebreak--,artist_description',
		],
		'instructor_fields' => [
			'label' => 'instructor_fields',
			'showitem' => 'instructor,instructor_link,--linebreak--,instructor_description,event_language',
		],
		'free_entry_fields' => [
			'label' => 'free_entry_fields',
			'showitem' => 'free_entry,--linebreak--,collection,--linebreak--,collection_reference,--linebreak--,registration_required',
		],
		'price_fields' => [
			'label' => 'price_fields',
			'showitem' => 'price_standard,--linebreak--,price_reduced',
		],
		'booking_fields' => [
			'label' => 'booking_fields',
			'showitem' => 'booking_required,--linebreak--,external_booking,--linebreak--,booking_link',
		],
	],
];

$tca = ArrayUtility::mergeRecursiveDistinct($base, $custom);

$search = [
	'location,location_link',
	'organizer,organizer_link',
	'artist,artist_link,artist_description',
	'instructor,instructor_link,instructor_description,event_language',
    'free_entry,collection,collection_reference,registration_required',
    'price_standard,price_reduced',
    'booking_required,external_booking,booking_link',
    'images,downloads,',
    'language,--div--',
    'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended',
];
$replace = [
	',--palette--;LLL:EXT:calendarize/Resources/Private/Language/locallang.xlf:tx_calendarize_domain_model_event.location_fields;location_fields',
	',--palette--;LLL:EXT:calendarize/Resources/Private/Language/locallang.xlf:tx_calendarize_domain_model_event.organizer_fields;organizer_fields',    
	',--div--;' . TranslateUtility::getLllOrHelpMessage('details', 'calendarize') . ',--palette--;LLL:EXT:calendarize/Resources/Private/Language/locallang.xlf:tx_calendarize_domain_model_event.artist_fields;artist_fields',
	',--palette--;LLL:EXT:calendarize/Resources/Private/Language/locallang.xlf:tx_calendarize_domain_model_event.instructor_fields;instructor_fields',
    ',--palette--;LLL:EXT:calendarize/Resources/Private/Language/locallang.xlf:tx_calendarize_domain_model_event.free_entry_fields;free_entry_fields',
    ',--palette--;LLL:EXT:calendarize/Resources/Private/Language/locallang.xlf:tx_calendarize_domain_model_event.price_fields;price_fields',
    ',--palette--;LLL:EXT:calendarize/Resources/Private/Language/locallang.xlf:tx_calendarize_domain_model_event.booking_fields;booking_fields',
    ',',
    'language,--div--;' . TranslateUtility::getLllOrHelpMessage('files', 'calendarize') . ',images,downloads,--div--',
    TranslateUtility::getLllOrHelpMessage('dateOptions', 'calendarize'),
];

$tca['types']['1']['showitem'] = \str_replace($search, $replace, $tca['types']['1']['showitem']);

return $tca;
