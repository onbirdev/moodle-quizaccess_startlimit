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

$string['pluginname'] = 'Sınav başlatma süresi sınırı';
$string['privacy:metadata'] = 'Bu eklenti, kullanıcıların kişisel verilerini saklamaz.';

$string['startlimit'] = 'Başlatma süresi sınırı';
$string['startlimit_help'] = 'Bu seçenek etkinleştirildiğinde, katılımcılar sınav açıldıktan sonra belirli bir süre içinde sınavı başlatabilirler.

Notlar:
- Bu kısıtlama yalnızca sınav açılış zamanı ayarlandığında geçerlidir.
- Bu ayar devam eden denemeleri etkilemez.';

$string['starttimeexpired'] = 'Bu sınavı başlatma süresi sona erdi.';
$string['starttimewithin'] = 'Sınavı başlatmak için maksimum süre: açıldıktan sonra {$a}.';
