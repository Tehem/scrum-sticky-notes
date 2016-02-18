<?php
/*
 * This file is part of scrum-sticky-notes.
 *
 * (c) Thomas Marcon <tehem@tehem.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require 'vendor/autoload.php';

// script configuration
require 'config.php';

// task mappings
require 'mapping.php';

/**
 * Parse TSV file and build task list
 *
 * @param array $tsv
 * @param int   $mandatory
 * @param array $mapping
 *
 * @return array list of tasks
 */
function parseTsv(array $tsv, $mandatory, array $mapping)
{
    $taskList = array();

    foreach ($tsv as $row) {
        $line = explode("\t", $row);

        if (!empty($line[$mandatory]) && intval($line[$mandatory]) > 0) {
            $task = array();
            foreach ($mapping as $data => $index) {
                $task[$data] = $line[$index];
            }
            $taskList[] = $task;
        }
    }

    return $taskList;
}

/**
 * @param string  $outputPdfFile     output name for PDF file
 * @param array   $tasks             list of tasks
 * @param boolean $useColoredHeaders if true, enable header coloring according to mapping
 * @param array   $colors            optional color mapping for projects
 *
 */
function exportTasks($outputPdfFile, array $tasks, $useColoredHeaders, array $colors = array())
{

    // 'standard' stick notes dimensions, 4 per page
    $positions   = array();
    $positions[] = array('x' => 10, 'y' => 10);
    $positions[] = array('x' => 150, 'y' => 10);
    $positions[] = array('x' => 10, 'y' => 110);
    $positions[] = array('x' => 150, 'y' => 110);

    $pdf = new FPDF('L');

    $feuilles = array_chunk($tasks, 4);

    foreach ($feuilles as $feuille) {
        $pdf->AddPage();
        for ($i = 0; $i < 4; $i++) {
            if (!isset($feuille[$i])) {
                break;
            }
            $story = $feuille[$i];

            $position = $positions[$i];

            // default sticky note color (yellow!)
            $color   = array(255, 255, 0);
            $project = strtolower($story['project']);

            if ($useColoredHeaders) {

                if (array_key_exists($project, $colors)) {
                    $color = $colors[$project];
                }

                $pdf->setFillColor($color[0], $color[1], $color[2]);
            }

            $pdf->SetFont('Arial', 'B', 24);
            $pdf->SetXY($position['x'], $position['y']);
            $pdf->Cell(127, 76, "", 1);
            $pdf->SetXY($position['x'], $position['y']);

            // title
            if ($useColoredHeaders) {
                $pdf->Cell(127, 15, utf8_decode($story['title']), 'B', 0, 'C', true);
            } else {
                $pdf->Cell(127, 15, utf8_decode($story['title']), 'B', 0, 'C', false);
            }

            $pdf->SetFont('Arial', '', 20);

            // story
            $pdf->SetXY($position['x'], $position['y'] + 15);
            $pdf->MultiCell(127, 10, utf8_decode($story['story']));

            // Project
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY($position['x'], $position['y'] + 56);
            $pdf->Cell(55, 10, "Project", 1, 0, 'C');
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetXY($position['x'], $position['y'] + 66);
            $pdf->Cell(55, 10, $story['project'], 1, 0, 'C');

            // BVP
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY($position['x'] + 55, $position['y'] + 56);
            $pdf->Cell(52, 10, "BVP", 1, 0, 'C');
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY($position['x'] + 55, $position['y'] + 66);
            $pdf->Cell(52, 10, $story['BVP'], 1, 0, 'C');

            // USP
            $pdf->SetFont('Arial', 'B', 30);
            $pdf->SetXY($position['x'] + 107, $position['y'] + 56);
            $pdf->Cell(20, 20, $story['USP'], 'LT', 0, 'C');

            $pdf->setFillColor(255, 255, 255);
        }
    }

    $pdf->output('F', $outputPdfFile.".pdf");
}

$tsvRows = file($tsvFile);
$tasks   = parseTsv($tsvRows, $mandatoryIndex, $dataMap);
exportTasks($outputPdfFile, $tasks, $useColoredHeaders, isset($colorMap) ? $colorMap : array());
