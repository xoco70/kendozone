<?php
return array(
    'rules' => [
        '0' => '-',
        '1' => 'Internation Kendo Federation (IKF)',
        '2' => 'European Kendo Federation (EKF)',
        '3' => 'LatinoAmerican Kendo Federation (LAKC)',
    ],
    'hanteiLimit' => [
        '1' => '-',
        '2' => '1/8 Final',
        '3' => '1/4 Final',
        '4' => '1/2 Final',
        '5' => 'Final',
    ],
    'gender' => [
        '1' => '-',
        '2' => 'M',
        '3' => 'F',
    ],

    'preliminaryGroupSize' => [3 => 3, 4 => 4, 5 => 5],
    'preliminaryWinner' => [1 => 1], // , 2 => 2, 3 => 3
    'enchoQty' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    'teamSize' => [2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10],
    'teamReserve' => [1 => 1, 2 => 2, 3 => 3, 4 => 4],
    'limitByEntity' => [0 => '-', 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10],


    'default_settings' => [
        'fightingAreas' => '1',
        'fightDuration' => '05:00',
        'hasPreliminary' => '1',
        'preliminaryGroupSize' => '3',
        'preliminaryDuration' => '05:00',
        'preliminaryWinner' => '1',
        'hasEncho' => '1',
        'enchoQty' => '1',
        'enchoDuration' => '0',
        'hasHantei' => '0',
        'hanteiLimit' => '0', // 1/2 Finals
        'enchoGoldPoint' => '0', // Step where Encho has no more time limit
        'limitByEntity' => '4',
        'cost' => '',
        'treeType' => '1',
        'seedQuantity' => '4',

    ],

// 3= Men Individual, 4 = Men Team, 5 = Ladies Individual, 6 = Ladies Team
    'ikf_settings' => [
        '3' => [
            'fightingAreas' => '1',
            'fightDuration' => '05:00',
            'hasPreliminary' => '1',
            'preliminaryGroupSize' => '3',
            'preliminaryDuration' => '05:00',
            'preliminaryWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '1',
            'enchoDuration' => '0',
            'hasHantei' => '0',
            'hanteiLimit' => '0', // 1/2 Finals
            'enchoGoldPoint' => '0', // Step where Encho has no more time limit
            'limitByEntity' => '4',
            'cost' => '',
            'seedQuantity' => '4',
            'treeType' => '1',


        ],
        '4' => [
            'fightingAreas' => '4',
            'teamSize' => '3',
            'teamReserve' => '2',
            'fightDuration' => '04:00',
            'hasPreliminary' => '1',
            'preliminaryGroupSize' => '3',
            'preliminaryDuration' => '4',
            'preliminaryWinner' => '1',
            'hasEncho' => '0',
            'enchoQty' => '0',
            'enchoDuration' => '0',
            'hasHantei' => '0',
            'hanteiLimit' => '0', // 1/2 Finals
            'enchoGoldPoint' => '0', // Step where Encho has no more time limit
            'limitByEntity' => '1',
            'cost' => '',
            'seedQuantity' => '4',
            'treeType' => '1',

        ],
        '5' => [
            'fightingAreas' => '4',
            'fightDuration' => '04:00',
            'hasPreliminary' => '1',
            'preliminaryGroupSize' => '3',
            'preliminaryDuration' => '4',
            'preliminaryWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '0',
            'enchoDuration' => '0',
            'hasHantei' => '0',
            'hanteiLimit' => '0', // 1/2 Finals
            'enchoGoldPoint' => '0', // Step where Encho has no more time limit
            'limitByEntity' => '4',
            'cost' => '',
            'seedQuantity' => '4',
            'treeType' => '1',

        ],
        '6' => [
            'fightingAreas' => '4',
            'teamSize' => '5',
            'teamReserve' => '2',
            'fightDuration' => '04:00',
            'hasPreliminary' => '1',
            'preliminaryGroupSize' => '3',
            'preliminaryDuration' => '4',
            'preliminaryWinner' => '1',
            'hasEncho' => '0',
            'enchoQty' => '0',
            'enchoDuration' => '0',
            'hasHantei' => '0',
            'hanteiLimit' => '0', // 1/2 Finals
            'enchoGoldPoint' => '0', // Step where Encho has no more time limit
            'limitByEntity' => '1',
            'cost' => '',
            'seedQuantity' => '4',
            'treeType' => '1',

        ],
    ],


    // Junior Team :  3 - 5 , Junior Individual, ( 1 )
    // Senior Male Team : Team 5 - 7 ( 2 )
    // Senior Female Team : Team 5 - 7 ( 6 )
    // Senior Female Individual, (5)
    // Senior Male Individual (3)
    // Limit x association: 4

    // 1 = Junior, 2 = Junior Team, 3= Men Individual, 4 = Men Team, 5 = Ladies Individual, 6 = Ladies Team, 7 = Master
    // Encho preliminary???
    // Encho knockout = 1
    // Encho Junior = 6 Min, then Hantei
    // Encho Master = no time limit
    'ekf_settings' => [ // categories.man_first_force
        '1' => [ // Junior
            'fightingAreas' => '1',
            'fightDuration' => '04:00',
            'hasPreliminary' => '1',
            'preliminaryGroupSize' => '3',
            'preliminaryDuration' => '4',
            'preliminaryWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '06:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoGoldPoint' => '3', // Step where Encho has no more time limit
            'treeType' => 1,
            'limitByEntity' => '4',
        ],
        '2' => [ /// Junior Team
            'teamSize' => '3',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '04:00',
            'hasPreliminary' => '1',
            'preliminaryGroupSize' => '3',
            'preliminaryDuration' => '4',
            'preliminaryWinner' => '2',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '06:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoGoldPoint' => '3', // Step where Encho has no more time limit
            'treeType' => 1,
        ],
        '3' => [ // Men Individual
            'teamSize' => '',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '05:00',
            'hasPreliminary' => '1',
            'preliminaryGroupSize' => '3',
            'preliminaryDuration' => '4',
            'preliminaryWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoGoldPoint' => '3', // Step where Encho has no more time limit
            'treeType' => 1,
            'limitByEntity' => '4',
        ],
        '4' => [ // Men Team
            'teamSize' => '5',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '05:00',
            'hasPreliminary' => '1',
            'preliminaryGroupSize' => '3',
            'preliminaryDuration' => '4',
            'preliminaryWinner' => '2',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoGoldPoint' => '3', // Step where Encho has no more time limit
            'treeType' => 1,
        ],
        '5' => [ // Ladies Individual
            'teamSize' => '',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '05:00',
            'hasPreliminary' => '1',
            'preliminaryGroupSize' => '3',
            'preliminaryDuration' => '4',
            'preliminaryWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoGoldPoint' => '3', // Step where Encho has no more time limit
            'treeType' => 1,
            'limitByEntity' => '4',
        ],
        '6' => [ // Ladies Team
            'teamSize' => '5',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '05:00',
            'hasPreliminary' => '1',
            'preliminaryGroupSize' => '3',
            'preliminaryDuration' => '4',
            'preliminaryWinner' => '2',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoGoldPoint' => '3', // Step where Encho has no more time limit
            'treeType' => 1,
        ],


    ],
    // 1 = Junior, 2 = Junior Team, 3= Men Individual, 4 = Men Team, 5 = Ladies Individual, 6 = Ladies Team, 7 = Master
    'lakc_settings' => [
        '1' => [ // Junior
            'teamSize' => '',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '04:00',
            'hasPreliminary' => '1',
            'preliminaryGroupSize' => '3',
            'preliminaryDuration' => '4',
            'preliminaryWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoGoldPoint' => '3', // Step where Encho has no more time limit
            'treeType' => 1,
            'limitByEntity' => '4',
        ],
        '2' => [ /// Junior Team
            'teamSize' => '',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '04:00',
            'hasPreliminary' => '1',
            'preliminaryGroupSize' => '3',
            'preliminaryDuration' => '4',
            'preliminaryWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoGoldPoint' => '3', // Step where Encho has no more time limit
            'treeType' => 1,
            'limitByEntity' => '4',
        ]
    ]

);
?>