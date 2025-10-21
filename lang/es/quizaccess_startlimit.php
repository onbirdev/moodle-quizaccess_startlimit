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

$string['pluginname'] = 'Límite de tiempo para iniciar el cuestionario';
$string['privacy:metadata'] = 'Este complemento no almacena ningún dato personal de los usuarios.';

$string['startlimit'] = 'Límite de tiempo de inicio';
$string['startlimit_help'] = 'Cuando está activado, los participantes solo pueden iniciar el cuestionario dentro de un período determinado después de que esté disponible.

Notas:
- Esta restricción solo se aplica si se ha establecido la hora de apertura del cuestionario.
- Esta configuración no afecta los intentos en curso.';

$string['starttimeexpired'] = 'El tiempo para iniciar este cuestionario ha expirado.';
$string['starttimewithin'] = 'Tiempo máximo para iniciar el cuestionario: {$a} después de que se abra.';
