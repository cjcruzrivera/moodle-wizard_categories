# moodle-wizard_categories
Plugin for moodle that facilitates the creation, modification and deletion of categories and qualification items of a course using AJAX

To install
* Clone wizard
~~~
$ cd moodle/
$ git clone https://github.com/cjcruzrivera/moodle-wizard_categories.git grade/edit/wizard_categories/
~~~
* Add access
> Copiar la siguiente instrucción en la linea 2953 del archivo  
/grade/lib.php

~~~
self::$managesetting['wizardgradebooksetup'] = new grade_plugin_info('wizard_setup',
                new moodle_url('/grade/edit/wizard_categories/index.php', array('id' => $courseid)),
                get_string('gradebooksetup', 'core_wizardcategories'));
~~~

> Copiar la siguiente instrucción en la linea 2953 del archivo  
lib/navigationlib.php
~~~
// Check if we can view the gradebook's setup page to load the wizard
        if ($adminoptions->gradebook) {
            $url = new moodle_url('/grade/edit/wizard_categories/index.php', array('id' => $course->id));
            $coursenode->add(get_string('gradebooksetup', 'core_wizardcategories'), $url, self::TYPE_SETTING,
                null, 'gradebooksetup', new pix_icon('i/settings', ''));
        }
~~~