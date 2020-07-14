INTRODUCTION
------------

The Context Mobile Condition module integrates the Context module and the
PHP Mobile Detect library Mobile_Detect. This module is used for detecting
device types (mobile, tablet and computer). It uses the user-agent string
combined with specific HTTP headers to detect the mobile device type
environment.

* For a full description of this module, visit the project page:
   https://www.drupal.org/project/context_mobile_condition

* To submit bug reports and feature suggestions, or track changes:
   https://www.drupal.org/project/issues/context_mobile_condition


REQUIREMENTS
------------

This module requires the following module and library:

* Context (https://www.drupal.org/project/context)
* Mobile_Detect (https://github.com/serbanghita/Mobile-Detect)


INSTALLATION
------------

 * Install as you would normally install a contributed Drupal module. Visit
   https://www.drupal.org/node/1897420 for further information.


CONFIGURATION
-------------

Enabling this module adds additional Contexts for usage:

 * Mobile Device (mobile, tablet, desktop)

To add a Context, navigate to "Structure > Context" and select an existing
context (or create a new context). The "Conditions" form should now have the
ability to query by "Mobile Device".


MAINTAINERS
-----------

Current maintainers:
 * Paulo Henrique Cota Starling - https://www.drupal.org/u/paulocs
