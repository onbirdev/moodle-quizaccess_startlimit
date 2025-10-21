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

$string['pluginname'] = '测验开始时间限制';
$string['privacy:metadata'] = '此插件不会存储任何用户的个人数据。';

$string['startlimit'] = '开始时间限制';
$string['startlimit_help'] = '启用后，参与者只能在测验开放后的指定时间内开始测验。

注意：
- 仅当设置了测验开放时间时，此限制才生效。
- 此设置不会影响正在进行的测验尝试。';

$string['starttimeexpired'] = '开始此测验的时间已过期。';
$string['starttimewithin'] = '开始测验的最长时间：开放后 {$a}。';
