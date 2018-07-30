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
 * The Wizard Gradebook setup page.
 *
 * @package   wizard_categories
 * @copyright  2018 Camilo José Cruz Rivera <cruz.camilo@correounivalle.edu.co>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once 'wizard_lib.php';
require_once($CFG->dirroot . '/grade/export/lib.php');
require_once $CFG->dirroot . '/grade/lib.php';
 $courseid        = required_param('id', PARAM_INT);

$url = new moodle_url('/local/wizardcategories/index.php', array('id' => $courseid));
$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');

/// Make sure they can even access this course
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourseid');
}

require_login($course);
$context = context_course::instance($course->id);
require_capability('moodle/grade:manage', $context);
$PAGE->requires->css('/local/wizardcategories/style/styles_wizard.css', true);

$PAGE->requires->js_call_amd('local_wizardcategories/wizard_categories', 'init');


print_grade_page_head($courseid, 'settings', null, '', false, false, false);
// print_grade_page_head($courseid, 'settings', 'setup', get_string('gradebooksetup', 'grades'));

// Print Table of categories and items
echo $OUTPUT->box_start('gradetreebox generalbox');
$title = get_string('gradebooksetup', 'grades');
echo "<h2>$title</h2>";
$html = getCategoriesandItems($courseid);
echo $html;
// echo $OUTPUT->render_from_template('core_grades_edit/wizard_categories', $tpldata);

echo $OUTPUT->box_end();



echo $OUTPUT->footer();
die;


