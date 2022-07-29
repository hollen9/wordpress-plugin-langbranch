<?php
/**
* Plugin Name: LangBranch Shortcode
* Plugin URI: http://hollen9.com/
* Description: Display correspond strings based on current get_locale();
* Version: 1.0.1
* Author: Hollen9
* Author URI: http://hollen9.com/
**/

if (!function_exists('langbranch_normalize_empty_atts')) {
    function langbranch_normalize_empty_atts ($atts) {
        foreach ($atts as $attribute => $value) {
            if (is_int($attribute)) {
                unset($atts[$attribute]);
                if ($value === null || $value === "") {
                } else {
                    $atts[strtolower($value)] = true;
                }   
            }
        }
        return $atts;
    }
}

if (!function_exists('langbranch_trim_html_br_tag')) { 
    function langbranch_trim_html_br_tag($html) {
        return trim(preg_replace('/^(<br\s*\/?>)*|(<br\s*\/?>)*$/i', '', $html));
    }
}

if (!function_exists('langbranch_function')) { 
    /**@example <caption>
     * [langbranch zh_TW]
     * 僅在中文顯示
     * [/langbranch][langbranch en_US]
     * 僅在英文顯示
     * [/langbranch][langbranch en_US zh_TW]
     * 僅在中 或 英文顯示
     * [/langbranch]
     * </caption>
     * */
    function langbranch_function($atts, $content, $tag) {
        $atts = langbranch_normalize_empty_atts($atts);
        
        $html = null;
        $locale = strtolower(get_locale());
        // $aio_flag = $atts['aio'];
        
        if (array_key_exists('aio', $atts) || $content === null || $content === "") {
            // ==[Branch Mode]==
            $doneOrAborted = false;
            $matched_locale = strtolower($locale);
            $deep_limit = 5;
            $current_deep = -1;
            //return 'matched_locale = ' . $matched_locale;
            while (!$doneOrAborted) {
                
                if ($current_deep > $deep_limit) {
                    if ($html === null) {
                        $html = "null";
                    }
                    $html .= "[LangBranch][ERR] Too many loops! ($current_deep)";
                    $doneOrAborted = true;
                    break;
                }
                $current_deep++;
                foreach($atts as $key => $value) {
                    $lower_key = strtolower($key);
                    // $debug_log .= "$key is at $value <br\>";
                    if ($matched_locale == $lower_key) {
                        $html = $value;
                        $strlen_value = strlen($value);
                        if ($strlen_value === 2 || ($strlen_value === 5 && substr($value, 2, 1) === '_')) {
                            $matched_locale = strtolower($value);
                            continue;
                        } else {
                            $doneOrAborted = true;
                        }
                    }
                }
            }
        } else if($atts[$locale]) {
            $html = $content;
        } else {
            $html = '';
        }
    
        $html = langbranch_trim_html_br_tag($html);
    
        if ($html !== '') {
            return '<div class="langbranch">' . $html . '</div>';
        }
    }
}

add_shortcode('langbranch', 'langbranch_function');

?>