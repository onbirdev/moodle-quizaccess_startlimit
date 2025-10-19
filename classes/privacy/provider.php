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

namespace quizaccess_startlimit\privacy;

use core_privacy\local\metadata\null_provider;

/**
 * Privacy provider class for handling null provider implementation.
 *
 * This class implements the null_provider interface and specifies
 * a reason for no user data being stored or processed.
 */
class provider implements null_provider {
    /**
     * Provides the reason for not storing user data.
     *
     * This method returns a language string identifier that explains
     * why this plugin does not store any user data.
     *
     * @return string The language string identifier for the reason.
     */
    public static function get_reason(): string {
        return 'privacy:metadata';
    }
}
