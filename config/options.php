<?php
return array(
    'rules' => [
        '1' => '-',
        '2' => 'Internation Kendo Federation (IKF)',
        '3' => 'European Kendo Federation (EKF)',
        '4' => 'LatinoAmerican Kendo Federation (LAKC)',
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

    'roundRobinGroupSize' => [3, 4, 5],
    'roundRobinWinner' => [1, 2, 3],
    'enchoQty' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    'teamSize' => [2, 3, 4, 5, 6, 7, 8, 9, 10],
    'teamReserve' => [1, 2, 3, 4],
    'limitByEntity' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],

// 1 = Junior, 2 = Junior Team, 3= Men Individual, 4 = Men Team, 5 = Ladies Individual, 6 = Ladies Team, 7 = Master
    'ikf_settings' => [
        '1' => [ // Junior
            'fightDuration' => '04:00',
            'hasRoundRobin' => '1',
            'roundRobinGroupSize' => '3',
            'roundRobinDuration' => '4',
            'roundRobinWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
            'limitByEntity' => '4',
        ],
        '2' => [ /// Junior Team
            'teamSize' => '3',
            'teamReserve' => '2',
            'fightDuration' => '04:00',
            'hasRoundRobin' => '1',
            'roundRobinGroupSize' => '3',
            'roundRobinDuration' => '4',
            'roundRobinWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
            'limitByEntity' => '4',
        ],
        '3' => [ // Men Individual
            'fightDuration' => '04:00',
            'hasRoundRobin' => '1',
            'roundRobinGroupSize' => '3',
            'roundRobinDuration' => '4',
            'roundRobinWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
            'limitByEntity' => '4',
            '4' => [ // Men Teams
                'teamSize' => '5',
                'fightDuration' => '04:00',
                'hasRoundRobin' => '1',
                'roundRobinGroupSize' => '3',
                'roundRobinDuration' => '4',
                'roundRobinWinner' => '1',
                'hasEncho' => '1',
                'enchoQty' => '10',
                'enchoDuration' => '03:00',
                'hasHantei' => '1',
                'hanteiLimit' => '3', // 1/2 Finals
                'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
                'limitByEntity' => '4',
            ],
            '6' => [ // Ladies Team
                'teamSize' => '',
                'teamReserve' => '2',
                'fightDuration' => '04:00',
                'hasRoundRobin' => '1',
                'roundRobinGroupSize' => '3',
                'roundRobinDuration' => '4',
                'roundRobinWinner' => '1',
                'hasEncho' => '1',
                'enchoQty' => '10',
                'enchoDuration' => '03:00',
                'hasHantei' => '1',
                'hanteiLimit' => '3', // 1/2 Finals
                'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
                'limitByEntity' => '4',
            ],
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
            'hasRoundRobin' => '1',
            'roundRobinGroupSize' => '3',
            'roundRobinDuration' => '4',
            'roundRobinWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '06:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
            'limitByEntity' => '4',
        ],
        '2' => [ /// Junior Team
            'teamSize' => '3',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '04:00',
            'hasRoundRobin' => '1',
            'roundRobinGroupSize' => '3',
            'roundRobinDuration' => '4',
            'roundRobinWinner' => '2',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '06:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
        ],
        '3' => [ // Men Individual
            'teamSize' => '',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '05:00',
            'hasRoundRobin' => '1',
            'roundRobinGroupSize' => '3',
            'roundRobinDuration' => '4',
            'roundRobinWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
            'limitByEntity' => '4',
        ],
        '4' => [ // Men Team
            'teamSize' => '5',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '05:00',
            'hasRoundRobin' => '1',
            'roundRobinGroupSize' => '3',
            'roundRobinDuration' => '4',
            'roundRobinWinner' => '2',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
        ],
        '5' => [ // Ladies Individual
            'teamSize' => '',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '05:00',
            'hasRoundRobin' => '1',
            'roundRobinGroupSize' => '3',
            'roundRobinDuration' => '4',
            'roundRobinWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
            'limitByEntity' => '4',
        ],
        '6' => [ // Ladies Team
            'teamSize' => '5',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '05:00',
            'hasRoundRobin' => '1',
            'roundRobinGroupSize' => '3',
            'roundRobinDuration' => '4',
            'roundRobinWinner' => '2',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
        ],


    ],
    // 1 = Junior, 2 = Junior Team, 3= Men Individual, 4 = Men Team, 5 = Ladies Individual, 6 = Ladies Team, 7 = Master
    'lakc_settings' => [
        '1' => [ // Junior
            'teamSize' => '',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '04:00',
            'hasRoundRobin' => '1',
            'roundRobinGroupSize' => '3',
            'roundRobinDuration' => '4',
            'roundRobinWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
            'limitByEntity' => '4',
        ],
        '2' => [ /// Junior Team
            'teamSize' => '',
            'teamReserve' => '2',
            'fightingAreas' => '1',
            'fightDuration' => '04:00',
            'hasRoundRobin' => '1',
            'roundRobinGroupSize' => '3',
            'roundRobinDuration' => '4',
            'roundRobinWinner' => '1',
            'hasEncho' => '1',
            'enchoQty' => '10',
            'enchoDuration' => '03:00',
            'hasHantei' => '1',
            'cost' => '',
            'seedQuantity' => '',
            'hanteiLimit' => '3', // 1/2 Finals
            'enchoTimeLimitless' => '3', // Step where Encho has no more time limit
            'limitByEntity' => '4',
        ]
    ]

);
?>