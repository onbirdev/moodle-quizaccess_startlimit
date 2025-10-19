<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Start Limit Quiz Access Rule Plugin for Moodle
 *
 * @package     quizaccess_startlimit
 * @author      MohammadReza PourMohammad <onbirdev@gmail.com>
 * @copyright   2025 MohammadReza PourMohammad. All rights reserved.
 * @link        https://onbir.dev
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Quiz Attempt Start Time Limit';
$string['privacy:metadata'] = 'This plugin does not store any personal student data.';

$string['startlimit'] = 'Start time limit';
$string['startlimit_help'] = 'When enabled, students can only start the quiz within a specified period after it opens.

Important notes:
- This limit only applies if the quiz open time is set.
- Ongoing attempts are not affected by this limit.';

$string['starttimeexpired'] = 'The time to start this quiz has expired.';
$string['starttimewithin'] = 'Maximum time to start the quiz: {$a} after it opens';
