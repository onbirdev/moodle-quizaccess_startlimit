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

$string['pluginname'] = 'Zeitlimit für Quizstart';
$string['privacy:metadata'] = 'Dieses Plugin speichert keine personenbezogenen Daten der Nutzer.';

$string['startlimit'] = 'Startzeitlimit';
$string['startlimit_help'] = 'Wenn aktiviert, können Teilnehmer das Quiz nur innerhalb eines bestimmten Zeitraums nach der Freigabe starten.

Hinweise:
- Diese Einschränkung gilt nur, wenn eine Startzeit für das Quiz festgelegt ist.
- Diese Einstellung betrifft laufende Versuche nicht.';

$string['starttimeexpired'] = 'Die Frist zum Starten dieses Quiz ist abgelaufen.';
$string['starttimewithin'] = 'Maximale Zeit zum Starten des Quiz: {$a} nach Freigabe.';
