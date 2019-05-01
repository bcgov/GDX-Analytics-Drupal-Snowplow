CONTENTS OF THIS FILE
---------------------
   
 * Introduction
---------------

  The GDX Analytics Drupal Snowplow module installs and runs Snowplow 
  Javascript web trackers, and provides an interface to configure them.

 * Requirements
 
 * Recommended modules

 * Installation
 ------------
 
 * Install as you would normally install a contributed Drupal module. Visit:
   https://www.drupal.org/documentation/install/modules-themes/modules-7
   for further information.

   1) In your drupal installation, change directories to your sites/modules/custom folder.
   2) Clone the project from github: https://github.com/bcgov/GDX-Analytics-Drupal-Snowplow
   3) Install the module in admin » extend
   4) Navigate to admin » config » gdx_analytics_drupal_snowplow » config_settings and enter
      the collector environment, snowplow version number, and snowplow tracking script uri.

 * Configuration

  * Configure settings in Administration » Configuration » System 
    » GDX Analytics Drupal Snowplow » Config_settings:

    Use this Configuration Page to set the collector version, script version, and specify
    the uri of the tracking script.
 
 * Troubleshooting
 
 * FAQ

 * Maintainers
 -------------

   Current Maintainers
   * Brendan Jennings (bjenning) - https://www.drupal.org/u/bjenning
