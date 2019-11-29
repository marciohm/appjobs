<?php

/**
 * Return a list of companies
 *
 * @return Companies List
 */
function getCompanies()
{
    return [
        [
            'name' => 'Company A',
            'requirements' => 'an apartment or house, and property insurance'
        ],
        [
            'name' => 'Company B',
            'requirements' => '5 door car or 4 door car, and a driver\'s license and car insurance'
        ],
        [
            'name' => 'Company C',
            'requirements' => 'social security number and a work permit'
        ],
        [
            'name' => 'Company D',
            'requirements' => 'an apartment or a flat or a house'
        ],
        [
            'name' => 'Company E',
            'requirements' => 'a driver\'s license and a 2 door car or a 3 door car or a 4 door car or a 5 door car'
        ],
        [
            'name' => 'Company F',
            'requirements' => 'a scooter or a bike, or a motorcycle and a driver\'s license and motorcycle insurance'
        ],
        [
            'name' => 'Company G',
            'requirements' => 'a massage qualification certificate and a liability insurance'
        ],
        [
            'name' => 'Company H',
            'requirements' => 'a storage place or a garage'
        ],
        [
            'name' => 'Company J',
            'requirements' => ''
        ],
        [
            'name' => 'Company K',
            'requirements' => 'a PayPal account'
        ]
    ];
}

/**
 * Return a list of companies that match a user attributes
 *
 * @param Array $userAttributes
 * @return Array $Companies
 */
function getJobs($userAttributes)
{
    //Iniciate Returns
    $goodMatches = [];
    $badMatches = [];

    //Get Companies List
    $companies = getCompanies();

    //Run each company
    for ($i = 0; $i < count($companies); $i++) {

        //Run user attributes
        foreach ($userAttributes as $attribute) {

            //Set Company Ranking by counting the number of occurrences of an attribute
            if (isset($companies[$i]['ranking'])) {
                $companies[$i]['ranking'] += substr_count($companies[$i]['requirements'], $attribute);
            } else {
                $companies[$i]['ranking'] = substr_count($companies[$i]['requirements'], $attribute);
            }
        }

        //Splits good matches and bad matches
        if ($companies[$i]['ranking'] > 0) {
            $goodMatches[] = $companies[$i];
        } else {
            $badMatches[] = $companies[$i];
        }
    }

    //Order good matches list by ranking
    usort($goodMatches, "method1");

    //Return list
    return ['good_matches' => $goodMatches, 'bad_matches' => $badMatches];
}

/**
 * Return a list of companies that match a user attributes
 *
 * @param Array $a, $b
 * @return Array ordered Array
 */
function method1($a, $b)
{
    return ($a['ranking'] >= $b['ranking']) ? -1 : 1;
}

echo "<pre>";
$myAttributes = ['bike', 'driver\'s license'];
print_r(getJobs($myAttributes));
echo "</pre>";
