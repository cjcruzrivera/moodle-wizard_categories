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
 * Estrategia ASES
 *
 * @author     Camilo José Cruz Rivera
 * @package    block_ases
 * @copyright  2018 Camilo José Cruz Rivera <cruz.camilo@correounivalle.edu.co>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */



function local_wizardcategories_extend_navigation_course($parentnode, $course, $context) {
    global $CFG, $PAGE;

    // Only add this settings item on non-site course pages.
    if (!$PAGE->course or $PAGE->course->id == 1) {
        return;
    }
 
    // Only let users with the appropriate capability see this settings item.
    if (!has_capability('moodle/backup:backupcourse', context_course::instance($PAGE->course->id))) {
        return;
    }
 
        //$strfoo = get_string('foo', 'local_wizardcategories');
        $url = new moodle_url('/local/wizardcategories/index.php', array('id' => $PAGE->course->id));
        $indexnode = navigation_node::create(
            'Wizard Categories Setup',
            $url,
            navigation_node::NODETYPE_LEAF,
            'local_wizardcategories',
            'local_wizardcategories',
            new pix_icon('i/settings', '')
        );
        if ($PAGE->url->compare($url, URL_MATCH_BASE)) {
            $indexnode->make_active();
        }
        $parentnode->add_node($indexnode);
    
}
