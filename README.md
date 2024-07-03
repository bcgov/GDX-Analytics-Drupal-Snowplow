[![img](https://img.shields.io/badge/Lifecycle-Experimental-339999)]
## GDX-Analytics-Drupal-Snowplow

  The GDX Analytics Drupal Snowplow module installs and runs Snowplow
  Javascript web trackers and provides an interface to configure them.

## Requirements

  This module requires Drupal 10. Backwards compatibility tests are also conducted for Drupal 9.

## Project Status

This project is currently under development and actively supported by the GDX Analytics Team.

This version (3.1.0) now allows the use of GDX Analytics Drupal Snowplow module with other search modules, including Drupal Search API.

## Relevant Repositories
[GDX-Analytics/](https://github.com/bcgov/GDX-Analytics/)

This is the central repository for work by the GDX Analytics Team.

## Installation

Install as you would normally install a contributed Drupal module. Visit: https://www.drupal.org/docs/extending-drupal/installing-modules for further information.

### Install the module manually

Change directories to your sites/modules/custom folder in your Drupal installation.

Clone the project from github: https://github.com/bcgov/GDX-Analytics-Drupal-Snowplow.

Install the module in Administration » Extend. Select the module, then scroll down and click Install.

### Install the module via composer

  Add the GDX Analytics Drupal Snowplow GitHub repository to your composer.json file:

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/bcgov/GDX-Analytics-Drupal-Snowplow"
        }
    ],

Add the custom module installer path `"web/modules/custom/{$name}": ["type:drupal-module-custom"]` to the "installer-paths" section in your composer.json file:

        "installer-paths": {
            "web/core": ["type:drupal-core"],
            "web/libraries/{$name}": ["type:drupal-library"],
            "web/modules/contrib/{$name}": ["type:drupal-module"],
            "web/modules/custom/{$name}": ["type:drupal-module-custom"],
            "web/profiles/contrib/{$name}": ["type:drupal-profile"],
            "web/themes/contrib/{$name}": ["type:drupal-theme"],
            "drush/Commands/contrib/{$name}": ["type:drupal-drush"]
        },

Run the composer require command to add the module via composer:

`composer require bcgov/gdx_analytics_drupal_snowplow`

Install the module in Administration » Extend. Select the module; then scroll down and click Install.

## Configuration

Configure settings in Administration » Configuration » GDX Analytics Drupal Snowplow settings.

Use this Configuration page to set the collector environment, tracking script URI, app ID and search path.

## Getting Help or Reporting an Issue

For any questions regarding this project, or for inquiries about starting a new analytics account, please contact the GDX Analytics Team.

## Contributors

The GDX Analytics Team are the main contributors to this project and maintain the code.

## How to Contribute

If you would like to contribute, please see our [CONTRIBUTING](CONTRIBUTING.md) guidelines.

Please note that this project is released with a [Contributor Code of Conduct](CODE_OF_CONDUCT.md). By participating in this project you agree to abide by its terms.

## License

Copyright 2018 Province of British Columbia

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and limitations under the License.
