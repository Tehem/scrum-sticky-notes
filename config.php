<?php
/*
 * This file is part of scrum-sticky-notes.
 *
 * (c) Thomas Marcon <tehem@tehem.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Use color for stick notes header. If true, you need to add two mapping values:
 *  - $colors : an array of colors in RGB format
 *  - $colorMap : an array of mapping between projects name and associated colors
 *
 * See mapping.php.example for more information
 */
$useColoredHeaders = true;

/**
 * Sprint number as specified in JIRA
 */
$sprintNumber = 37;

/**
 * Output pdf file nmae
 */
$outputPdfFile = "sprint_tasks_" . $sprintNumber;
