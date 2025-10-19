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

$string['pluginname'] = 'محدودیت زمان شرکت در آزمون';
$string['privacy:metadata'] = 'این افزونه هیچ اطلاعات شخصی دانش‌آموزان را ذخیره نمی‌کند.';

$string['startlimit'] = 'محدودیت زمان شرکت';
$string['startlimit_help'] = 'با فعال‌سازی این گزینه، دانش‌آموزان تنها می‌توانند در مدت زمان مشخصی پس از باز شدن آزمون، در آن شرکت کنند.

نکات مهم:
- این محدودیت تنها در صورتی اعمال می‌شود که زمان باز شدن آزمون تعیین شده باشد.
- این محدودیت بر تلاش‌های در حال انجام تأثیری ندارد.';

$string['starttimeexpired'] = 'مهلت شرکت در این آزمون به پایان رسیده است.';
$string['starttimewithin'] = 'حداکثر زمان شرکت در آزمون: {$a} پس از باز شدن';
