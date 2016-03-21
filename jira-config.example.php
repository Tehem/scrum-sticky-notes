<?php
/*
 * This file is part of scrum-sticky-notes.
 *
 * (c) Thomas Marcon <tehem@tehem.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// Minimal example

/**
 * JIRA configuration
 */
$jiraConfig = array (
    'endPoint' => 'https://mycompany.atlassian.net',
    'user' => 'my_user',
    'password' => 'my_password',

    // project to look for (project ids in JIRA)
    'projects' => array(
        'PROJ1',
        'PROJ2',
        'PROJ3',
    ),
);

/**
 * Mapping between JSON data and sticky notes data
 */
$jsonMap = array(
    'date'     => 'created',
    'story'    => 'summary',
    'USP'      => 'customfield_10008',
    // ...
);

// if you want colored sticky notes, you need to add following mappings

// available colors you want
$colors = array(
    'yellow' => array(255, 255, 0),
    'green'  => array(0, 255, 0),
    'blue'   => array(0, 0, 255),
);

// mapping between project id in JIRA and color
$colorMap = array(
    'PROJ1'  => $colors['yellow'],
    'PROJ2'  => $colors['green'],
    'PROJ3'  => $colors['blue'],
);
