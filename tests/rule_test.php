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

global $CFG;
require_once($CFG->dirroot . '/mod/quiz/accessrule/startlimit/rule.php');

/**
 * Unit test class for testing the quizaccess_startlimit rule functionality.
 */
class quizaccess_startlimit_testcase extends advanced_testcase {
    /**
     * Test the make method returns null when quiz has no timeopen.
     */
    public function test_make_returns_null_when_no_timeopen() {
        $this->resetAfterTest();

        $quiz = new stdClass();
        $quiz->id = 0;
        $quiz->timeopen = 0;
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = quizaccess_startlimit::make($quizobj, time(), false);

        $this->assertNull($rule);
    }

    /**
     * Test the make method returns null when user can ignore time limits.
     */
    public function test_make_returns_null_when_can_ignore_timelimits() {
        $this->resetAfterTest();

        $quiz = new stdClass();
        $quiz->id = 0;
        $quiz->timeopen = time();
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = quizaccess_startlimit::make($quizobj, time(), true);

        $this->assertNull($rule);
    }

    /**
     * Test the make method returns null when no startlimit record exists.
     */
    public function test_make_returns_null_when_no_record() {
        global $DB;
        $this->resetAfterTest();

        $quiz = new stdClass();
        $quiz->id = 0;
        $quiz->timeopen = time();
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        // Ensure no record exists.
        $DB->delete_records('quizaccess_startlimit', ['quizid' => 0]);

        $rule = quizaccess_startlimit::make($quizobj, time(), false);

        $this->assertNull($rule);
    }

    /**
     * Test the make method returns null when startlimit is empty.
     */
    public function test_make_returns_null_when_startlimit_empty() {
        global $DB;
        $this->resetAfterTest();

        $quiz = new stdClass();
        $quiz->id = 1;
        $quiz->timeopen = time();
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        // Insert record with empty startlimit.
        $DB->insert_record('quizaccess_startlimit', (object) [
            'quizid' => 1,
            'startlimit' => 0,
        ]);

        $rule = quizaccess_startlimit::make($quizobj, time(), false);

        $this->assertNull($rule);
    }

    /**
     * Test the make method creates rule when conditions are met.
     */
    public function test_make_creates_rule_when_conditions_met() {
        global $DB;
        $this->resetAfterTest();

        $quiz = new stdClass();
        $quiz->id = 1;
        $quiz->timeopen = time();
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        // Insert valid startlimit record.
        $DB->insert_record('quizaccess_startlimit', (object) [
            'quizid' => 1,
            'startlimit' => 3600,
        ]);

        $rule = quizaccess_startlimit::make($quizobj, time(), false);

        $this->assertInstanceOf('quizaccess_startlimit', $rule);
    }

    /**
     * Test prevent_new_attempt returns false when no timeopen.
     */
    public function test_prevent_new_attempt_false_when_no_timeopen() {
        $this->resetAfterTest();

        $quiz = new stdClass();
        $quiz->timeopen = 0;
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = new quizaccess_startlimit($quizobj, time(), 3600);

        $this->assertFalse($rule->prevent_new_attempt(0, new stdClass()));
    }

    /**
     * Test prevent_new_attempt returns false when no startlimit.
     */
    public function test_prevent_new_attempt_false_when_no_startlimit() {
        $this->resetAfterTest();

        $quiz = new stdClass();
        $quiz->timeopen = time();
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = new quizaccess_startlimit($quizobj, time(), 0);

        $this->assertFalse($rule->prevent_new_attempt(0, new stdClass()));
    }

    /**
     * Test prevent_new_attempt returns false when within time limit.
     */
    public function test_prevent_new_attempt_false_when_within_limit() {
        $this->resetAfterTest();

        $timeopen = time();
        $timenow = $timeopen + 1800; // 30 minutes after opening
        $startlimit = 3600; // 1 hour limit

        $quiz = new stdClass();
        $quiz->timeopen = $timeopen;
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = new quizaccess_startlimit($quizobj, $timenow, $startlimit);

        $this->assertFalse($rule->prevent_new_attempt(0, new stdClass()));
    }

    /**
     * Test prevent_new_attempt returns message when time limit exceeded.
     */
    public function test_prevent_new_attempt_message_when_exceeded() {
        $this->resetAfterTest();

        $timeopen = time() - 7200; // 2 hours ago
        $timenow = time();
        $startlimit = 3600; // 1 hour limit

        $quiz = new stdClass();
        $quiz->timeopen = $timeopen;
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = new quizaccess_startlimit($quizobj, $timenow, $startlimit);

        $result = $rule->prevent_new_attempt(0, new stdClass());
        $this->assertStringContainsString(get_string('starttimeexpired', 'quizaccess_startlimit'), $result);
    }

    /**
     * Test is_finished returns false when no timeopen.
     */
    public function test_is_finished_false_when_no_timeopen() {
        $this->resetAfterTest();

        $quiz = new stdClass();
        $quiz->timeopen = 0;
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = new quizaccess_startlimit($quizobj, time(), 3600);

        $this->assertFalse($rule->is_finished(0, new stdClass()));
    }

    /**
     * Test is_finished returns false when no startlimit.
     */
    public function test_is_finished_false_when_no_startlimit() {
        $this->resetAfterTest();

        $quiz = new stdClass();
        $quiz->timeopen = time();
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = new quizaccess_startlimit($quizobj, time(), 0);

        $this->assertFalse($rule->is_finished(0, new stdClass()));
    }

    /**
     * Test is_finished returns false when within time limit.
     */
    public function test_is_finished_false_when_within_limit() {
        $this->resetAfterTest();

        $timeopen = time();
        $timenow = $timeopen + 1800; // 30 minutes after opening
        $startlimit = 3600; // 1 hour limit

        $quiz = new stdClass();
        $quiz->timeopen = $timeopen;
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = new quizaccess_startlimit($quizobj, $timenow, $startlimit);

        $this->assertFalse($rule->is_finished(0, new stdClass()));
    }

    /**
     * Test is_finished returns true when time limit exceeded.
     */
    public function test_is_finished_true_when_exceeded() {
        $this->resetAfterTest();

        $timeopen = time() - 7200; // 2 hours ago
        $timenow = time();
        $startlimit = 3600; // 1 hour limit

        $quiz = new stdClass();
        $quiz->timeopen = $timeopen;
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = new quizaccess_startlimit($quizobj, $timenow, $startlimit);

        $this->assertTrue($rule->is_finished(0, new stdClass()));
    }

    /**
     * Test description returns formatted string when startlimit is set.
     */
    public function test_description_returns_formatted_string() {
        $this->resetAfterTest();

        $quiz = new stdClass();
        $quiz->startlimit = 3600; // 1 hour.
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = new quizaccess_startlimit($quizobj, time(), 3600);

        $description = $rule->description();
        $this->assertNotNull($description);
        $this->assertStringContainsString(
            get_string('starttimewithin', 'quizaccess_startlimit', format_time($quiz->startlimit)),
            $description
        );
    }

    /**
     * Test description returns null when no startlimit.
     */
    public function test_description_returns_null_when_no_limit() {
        $this->resetAfterTest();

        $quiz = new stdClass();
        $quiz->startlimit = 0;
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = new quizaccess_startlimit($quizobj, time(), 0);

        $description = $rule->description();
        $this->assertNull($description);
    }

    /**
     * Test get_settings_sql returns correct SQL components.
     */
    public function test_get_settings_sql() {
        $result = quizaccess_startlimit::get_settings_sql(1);

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
        $this->assertEquals('qa_sl.startlimit', $result[0]);
        $this->assertStringContainsString('LEFT JOIN {quizaccess_startlimit}', $result[1]);
        $this->assertIsArray($result[2]);
    }

    /**
     * Test save_settings updates existing record.
     */
    public function test_save_settings_updates_existing_record() {
        global $DB;
        $this->resetAfterTest();

        // Create existing record.
        $DB->insert_record('quizaccess_startlimit', (object) [
            'quizid' => 1,
            'startlimit' => 1800,
        ]);

        $quiz = new stdClass();
        $quiz->id = 1;
        $quiz->startlimit = 3600;

        quizaccess_startlimit::save_settings($quiz);

        $record = $DB->get_record('quizaccess_startlimit', ['quizid' => 1]);
        $this->assertEquals(3600, $record->startlimit);
    }

    /**
     * Test save_settings creates new record when none exists.
     */
    public function test_save_settings_creates_new_record() {
        global $DB;
        $this->resetAfterTest();

        // Ensure no record exists.
        $DB->delete_records('quizaccess_startlimit', ['quizid' => 1]);

        $quiz = new stdClass();
        $quiz->id = 1;
        $quiz->startlimit = 3600;

        quizaccess_startlimit::save_settings($quiz);

        $record = $DB->get_record('quizaccess_startlimit', ['quizid' => 1]);
        $this->assertNotFalse($record);
        $this->assertEquals(3600, $record->startlimit);
    }

    /**
     * Test delete_settings removes record from database.
     */
    public function test_delete_settings_removes_record() {
        global $DB;
        $this->resetAfterTest();

        // Create record to delete.
        $DB->insert_record('quizaccess_startlimit', (object) [
            'quizid' => 1,
            'startlimit' => 3600,
        ]);

        $quiz = new stdClass();
        $quiz->id = 1;

        quizaccess_startlimit::delete_settings($quiz);

        $record = $DB->get_record('quizaccess_startlimit', ['quizid' => 1]);
        $this->assertFalse($record);
    }

    /**
     * Test constructor sets startlimit property correctly.
     */
    public function test_constructor_sets_startlimit() {
        $this->resetAfterTest();

        $quiz = new stdClass();
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $startlimit = 3600;
        $rule = new quizaccess_startlimit($quizobj, time(), $startlimit);

        // Use reflection to access private property.
        $reflection = new ReflectionClass($rule);
        $property = $reflection->getProperty('startlimit');
        $property->setAccessible(true);

        $this->assertEquals($startlimit, $property->getValue($rule));
    }

    /**
     * Test edge case: prevent_new_attempt at exact deadline.
     */
    public function test_prevent_new_attempt_at_exact_deadline() {
        $this->resetAfterTest();

        $timeopen = time() - 3600; // 1 hour ago.
        $timenow = $timeopen + 3600; // Exactly at deadline.
        $startlimit = 3600; // 1 hour limit.

        $quiz = new stdClass();
        $quiz->timeopen = $timeopen;
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = new quizaccess_startlimit($quizobj, $timenow, $startlimit);

        $this->assertFalse($rule->prevent_new_attempt(0, new stdClass()));
    }

    /**
     * Test edge case: prevent_new_attempt one second past deadline.
     */
    public function test_prevent_new_attempt_one_second_past_deadline() {
        $this->resetAfterTest();

        $timeopen = time() - 3601; // 1 hour and 1 second ago.
        $timenow = $timeopen + 3601; // One second past deadline.
        $startlimit = 3600; // 1 hour limit.

        $quiz = new stdClass();
        $quiz->timeopen = $timeopen;
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);

        $rule = new quizaccess_startlimit($quizobj, $timenow, $startlimit);

        $result = $rule->prevent_new_attempt(0, new stdClass());
        $this->assertNotFalse($result);
    }
}
