# GDX-Analytics-Drupal-Snowplow
   
## Introduction

  The GDX Analytics Drupal Snowplow module installs and runs Snowplow 
  Javascript web trackers, and provides an interface to configure them.

## Installation
 
  Install as you would normally install a contributed Drupal module. Visit:
  https://www.drupal.org/documentation/install/modules-themes/modules-7
  for further information.

  In your drupal installation, change directories to your sites/modules/custom folder.
  Clone the project from github: https://github.com/bcgov/GDX-Analytics-Drupal-Snowplow.
  Install the module in admin » extend.
  Navigate to admin » config » gdx_analytics_drupal_snowplow » config_settings and enter
  the collector environment, snowplow version number, and snowplow tracking script uri.

## Configuration

  Configure settings in Administration » Configuration » System 
    » GDX Analytics Drupal Snowplow » Config_settings.
    
  Use this Configuration Page to set the collector version, script version, and specify
  the uri of the tracking script.
