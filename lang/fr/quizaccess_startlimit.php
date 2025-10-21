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

$string['pluginname'] = 'Limite de temps pour commencer le quiz';
$string['privacy:metadata'] = 'Ce plugin ne stocke aucune donnée personnelle des utilisateurs.';

$string['startlimit'] = 'Limite de temps de démarrage';
$string['startlimit_help'] = 'Lorsque cette option est activée, les participants ne peuvent commencer le quiz que dans une période spécifiée après son ouverture.

Remarques :
- Cette restriction s’applique uniquement si l’heure d’ouverture du quiz est définie.
- Ce paramètre n’affecte pas les tentatives en cours.';

$string['starttimeexpired'] = 'Le délai pour commencer ce quiz est expiré.';
$string['starttimewithin'] = 'Temps maximum pour commencer le quiz : {$a} après son ouverture.';
