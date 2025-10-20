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

require_once($CFG->dirroot . '/mod/quiz/accessrule/accessrulebase.php');

/**
 * Quiz access rule to enforce a time limit for starting an attempt.
 *
 * This rule restricts students from starting an attempt after a specified period
 * from when the quiz is opened.
 */
class quizaccess_startlimit extends quiz_access_rule_base {
    /** @var int $startlimit The maximum allowed time (in seconds) to start the attempt after the quiz opens. */
    protected int $startlimit;

    /**
     * Factory method to create the rule object.
     *
     * Returns null if the rule does not apply (quiz time not set or user can ignore time limits).
     *
     * @param quiz $quizobj The quiz object.
     * @param int $timenow Current timestamp.
     * @param bool $canignoretimelimits Whether the user can ignore time limits.
     * @return self|null
     */
    public static function make(quiz $quizobj, $timenow, $canignoretimelimits): ?self {
        global $DB;

        if (empty($quizobj->get_quiz()->timeopen) || $canignoretimelimits) {
            return null;
        }

        $record = $DB->get_record('quizaccess_startlimit', ['quizid' => $quizobj->get_quizid()]);
        if (!$record || empty($record->startlimit)) {
            return null;
        }

        return new self($quizobj, $timenow, $record->startlimit);
    }

    /**
     * Constructor.
     *
     * @param quiz $quizobj The quiz object.
     * @param int $timenow Current timestamp.
     * @param int $startlimit The maximum allowed start time in seconds.
     */
    public function __construct($quizobj, $timenow, $startlimit) {
        parent::__construct($quizobj, $timenow);
        $this->startlimit = $startlimit;
    }

    /**
     * Checks if a new attempt should be prevented.
     *
     * {@inheritdoc}
     * @param int $numprevattempts the number of previous attempts this user has made.
     * @param object $lastattempt information about the user's last completed attempt.
     * @return string false if access should be allowed, a message explaining the
     *       reason if access should be prevented.
     */
    public function prevent_new_attempt($numprevattempts, $lastattempt) {
        $quiz = $this->quiz;

        if (empty($quiz->timeopen) || empty($this->startlimit)) {
            return false;
        }

        $deadline = $quiz->timeopen + $this->startlimit;
        if ($this->timenow > $deadline) {
            return get_string('starttime_expired', 'quizaccess_startlimit');
        }

        return false;
    }

    /**
     * Checks if the quiz is finished due to the start time limit.
     *
     * {@inheritdoc}
     * @param int $numprevattempts the number of previous attempts this user has made.
     * @param object $lastattempt information about the user's last completed attempt.
     * @return bool true if this rule means that this user will never be allowed another
     *  attempt at this quiz.
     */
    public function is_finished($numprevattempts, $lastattempt): bool {
        $quiz = $this->quiz;

        if (empty($quiz->timeopen) || empty($this->startlimit)) {
            return false;
        }

        $deadline = $quiz->timeopen + $this->startlimit;
        if ($this->timenow > $deadline) {
            return true;
        }

        return false;
    }

    /**
     * Returns a description of the rule for display on the quiz page.
     *
     * {@inheritdoc}
     */
    public function description() {
        $quiz = $this->quizobj->get_quiz();
        $limit = (int) $quiz->startlimit;

        if ($limit > 0) {
            return get_string('starttimewithin', 'quizaccess_startlimit', format_time($limit));
        }

        return null;
    }

    /**
     * {@inheritdoc}
     * @param mod_quiz_mod_form $quizform the quiz settings form that is being built.
     * @param MoodleQuickForm $mform the wrapped MoodleQuickForm.
     */
    public static function add_settings_form_fields(mod_quiz_mod_form $quizform, MoodleQuickForm $mform) {
        $mform->addElement('duration', 'startlimit', get_string('startlimit', 'quizaccess_startlimit'), [
            'optional' => true,
        ]);
        $mform->addHelpButton('startlimit', 'startlimit', 'quizaccess_startlimit');
    }

    /**
     * {@inheritdoc}
     * @param int $quizid the id of the quiz we are loading settings for. This
     *      can also be accessed as quiz.id in the SQL. (quiz is a table alisas for {quiz}.)
     */
    public static function get_settings_sql($quizid) {
        return ['qa_sl.startlimit', 'LEFT JOIN {quizaccess_startlimit} qa_sl ON qa_sl.quizid = quiz.id', []];
    }

    /**
     * {@inheritdoc}
     * @param object $quiz the data from the quiz form, including $quiz->id
     *       which is the id of the quiz being saved.
     */
    public static function save_settings($quiz) {
        global $DB;

        $record = $DB->get_record('quizaccess_startlimit', ['quizid' => $quiz->id]);

        if ($record) {
            $record->startlimit = $quiz->startlimit;
            $DB->update_record('quizaccess_startlimit', $record);
        } else {
            $DB->insert_record('quizaccess_startlimit', (object) [
                'quizid' => $quiz->id,
                'startlimit' => $quiz->startlimit,
            ]);
        }
    }

    /**
     * {@inheritdoc}
     * @param object $quiz the data from the database, including $quiz->id
     *       which is the id of the quiz being deleted.
     */
    public static function delete_settings($quiz) {
        global $DB;
        $DB->delete_records('quizaccess_startlimit', ['quizid' => $quiz->id]);
    }
}
