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

$string['pluginname'] = 'Limite de tempo para iniciar o questionário';
$string['privacy:metadata'] = 'Este plugin não armazena nenhum dado pessoal dos usuários.';

$string['startlimit'] = 'Limite de tempo de início';
$string['startlimit_help'] = 'Quando ativado, os participantes só podem iniciar o questionário dentro de um período específico após ele estar disponível.

Notas:
- Esta restrição só se aplica se o horário de abertura do questionário estiver definido.
- Esta configuração não afeta tentativas em andamento.';

$string['starttimeexpired'] = 'O tempo para iniciar este questionário expirou.';
$string['starttimewithin'] = 'Tempo máximo para iniciar o questionário: {$a} após a abertura.';
