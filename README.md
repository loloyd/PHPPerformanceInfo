# PHPPerformanceInfo

## Purpose

PHPPerformanceInfo is a Pico CMS plugin that adds server performance information at the bottom of the page.  It displays rudimentary PHP metrics at the bottom of each generated page.

## Installation Instructions

### Via Download

1. Download https://github.com/loloyd/distributables/raw/master/picocms-plugins/PHPPerformanceInfo.tar.gz or browse https://github.com/loloyd/distributables/blob/master/picocms-plugins/PHPPerformanceInfo.tar.gz and click on the Download link.
2. Extract the contents of PHPPerformanceInfo.tar.gz onto the Pico CMS plugins directory `(webroot)/plugins/.`.  Replace `(webroot)` with the correct localized resource location of your Pico CMS setup.  At correct installation, the following set of files should be found:

`(webroot)/plugins/PHPPerformanceInfo/PHPPerformanceInfo.php
(webroot)/plugins/PHPPerformanceInfo/README.md
(webroot)/plugins/PHPPerformanceInfo/LICENSE.md`

3. Enable the plugin by adding the following line in the Pico CMS configuration file `(webroot)/config/config.php`:

`$config['PHPPerformance.enabled'] = true;`

### Using Git

1. Using a command line terminal shell console, issue the following commands.  Replace `(webroot)` with the correct localized resource location of your Pico CMS setup.

`$ cd (webroot)/plugins
$ git clone https://github.com/loloyd/PHPPerformanceInfo.git`

2. Enable the plugin by adding the following line in the Pico CMS configuration file `(webroot)/config/config.php`:

`$config['PHPPerformance.enabled'] = true;`

## Disabling Instructions

Disable the plugin by changing the appropriate configuration line in the Pico CMS configuration file `(webroot)/config/config.php` into:

`$config['PHPPerformance.enabled'] = false;`

## Removal Instructions

1. Follow the **Disabling Instructions** above.
2. Delete the directory `(webroot)/plugins/PHPPerformanceInfo`.

## Known Limitations

1. It works well with the default template but may break others.  This plugin works this way - after final page rendering, it attempts to find the following bit of text, which is conventionally the last part of the default template in a Pico CMS rendered page:

`        </div>
    </footer>
</body>
</html>`

In coding terms, this is equivalent to:

`        </div>\n    </footer>\n</body>\n</html>`

The plugin then chops off that bit of text but remembers all the instances where it has been found.  Remembering where that bit of text was found is useful in instances where the text was found in multiple instances from the rendered page for later reassembly.

At the last instance found, the plugin adds the server performance information using rudimentary PHP metrics.  This part of the plugin can be easily modified by the end-user.

The plugin then glues back the rendered page with the bit of text found initially above.

If the plugin did not initially find the bit of text above, it still adds the server performance information and then adds the bit of text as specified above.  This is the case where the plugin would break rendered pages from non-conventional templates.

2. There are no working profiles yet on how and when the server performance information is going to be exposed.  In an ideal production scenario, it would be prudent to show the server performance information in selected pages only, combined with access restrictions.  This design consideration is part of the future direction for this plugin.

## Publisher Information and Miscellaneous Details

Author: Loloy D, based on the dummy plugin demo by Daniel Rudolf
Version: 1.0
Link to plugin: http://github.com/loloyd/PHPPerformanceInfo
Link to Loloy D's website: http://loloyd.com/
License: http://opensource.org/licenses/MIT The MIT License
Link to Pico CMS: http://picocms.org/
