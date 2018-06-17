<?php
/**
 * PHPPerformanceInfo - adds server performance information at the bottom of the page
 *
 * This plugin lets Pico display server performance information using 
 * rudimentary PHP metrics at the bottom of each page generated.
 * Caveats:
 *   1. It works well with the default template but may break others.
 *   2. There are no working profiles yet on how and when this bit of information should be exposed.
 *
 * @author  Loloy D, based on the dummy plugin demo by Daniel Rudolf
 * @link    http://picocms.org
 * @license http://opensource.org/licenses/MIT The MIT License
 * @version 1.0
 */
final class PHPPerformanceInfo extends AbstractPicoPlugin
{
    /**
     * This plugin is enabled by default?
     *
     * @see AbstractPicoPlugin::$enabled
     * @var boolean
     */
    protected $enabled = false;

    /**
     * This plugin depends on ...
     *
     * @see AbstractPicoPlugin::$dependsOn
     * @var string[]
     */
    protected $dependsOn = array();

    /**
     * Triggered after Pico has rendered the page
     *
     * @param  string &$output contents which will be sent to the user
     * @return void
     */
    public function onPageRendered(&$output)
    {
        $server_performance_information = "<hr/><h4>Server Performance Information</h4>";
        $val_memory_get_usage = memory_get_usage();
        $unit=array('b','kb','mb','gb','tb','pb');
        $mem_size = @round($val_memory_get_usage/pow(1024,($i=floor(log($val_memory_get_usage,1024)))),2).' '.$unit[$i];
        $server_performance_information .= "PHP memory usage: " . $mem_size . " [" . $val_memory_get_usage . "]<br/>\n";
        $val_memory_get_usage = memory_get_usage(TRUE);
        $mem_size = @round($val_memory_get_usage/pow(1024,($i=floor(log($val_memory_get_usage,1024)))),2).' '.$unit[$i];
        $server_performance_information .= "PHP allocated memory including unused pages: " . $mem_size . " [" . $val_memory_get_usage . "]<br/>\n";
        $server_performance_information .= "PHP memory limit configuration: " . ini_get("memory_limit")  . "<br/>\n";
        $processing_time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
        $server_performance_information .= "PHP processing time: {$processing_time} seconds";
        
        $delimiter_glue = "        </div>\n    </footer>\n</body>\n</html>";
        $output_parts = explode($delimiter_glue, $output);
        array_push ($output_parts, $server_performance_information);
        if (count($output_parts) > 3) {
            $output = implode($delimiter_glue, $output_parts);
        } else {
            $output = implode($output_parts);    
        }
        $output .= $delimiter_glue;
    }
}
