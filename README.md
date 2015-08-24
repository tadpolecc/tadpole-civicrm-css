# tadpole-civicrm-css
Tadpole's CiviCRM css override that allows the theme to control the CSS on frontend CiviCRM pages.

This plugin replaces the core civicrm css file with it's own.

This plugin supports 4.4, 4.5 and 4.6

Version 1.2 is based on the civicrm.css from the 4.6 release


#Overides
Starting in V 1.1 you can now override this plugins CSS with a custom one from your theme.  This makes use of the tc_civicss_override filter

Example Code:

```function tc_civicrm_theme_css( ) {
    $tc_css = get_bloginfo( 'stylesheet_directory' ) .'/includes/civicrm.css';

    return $tc_css;
    }

add_filter( 'tc_civicss_override', 'tc_civicrm_theme_css' ); ```