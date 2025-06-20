[![img](https://img.shields.io/badge/Lifecycle-Experimental-339999)]
## GDX-Analytics-Drupal-Snowplow

The GDX Analytics Drupal Snowplow module installs and runs Snowplow 
Javascript web trackers and provides an interface to configure them.
  
## Requirements  

This module requires Drupal 10. Backwards compatibility tests are also conducted for Drupal 9.

## Project Status

This project is currently under development and actively supported by the GDX Analytics Team.

The current version released is 3.4.0. 

Versions 3.1.0 and later allow the GDX Analytics Drupal Snowplow module to be used alongside other search modules, such as Drupal Search API.
  
## Relevant Repositories
[GDX-Analytics/](https://github.com/bcgov/GDX-Analytics/)

This is the central repository for work by the GDX Analytics Team.

## Installation
 
Install as you would typically install a contributed Drupal module. Visit: https://www.drupal.org/docs/extending-drupal/installing-modules for further information.

Change directories to your sites/modules/custom folder in your drupal installation.
  
Clone the project from GitHub: https://github.com/bcgov/GDX-Analytics-Drupal-Snowplow.
  
Install the module in Administration » Extend. Select the module, then scroll down and click Install.

## Configuration

Configure settings in Administration » Configuration » GDX Analytics Drupal Snowplow settings.
    
Use this configuration page to set the collector environment, tracking script URI, app ID, search path and search key.

The default settings for GDX Analytics development data pipeline are:

- Collector Environment = spm.apps.gov.bc.ca

- Snowplow tracking script URI = https://www2.gov.bc.ca/StaticWebResources/static/sp/sp-2-14-0.js

- App ID = Snowplow_standalone

If the Snowplow Search Event is enabled, the module looks for the Search Path to trigger a search event and extracts the search terms from the URI using the defined Search Key:

- Search Path = Enter the search path(s) required to trigger a search event. If you want to use multiple paths, use comma-separated values (Example: '/search1, /search2'). 

- Search Key = Enter the search key required to extract search terms. If there are multiple copies of the same key in the URI (Example: .../search/node?keys=value1&keys=value2), the module will concatenate all key values to the list of search terms.

In Drupal, the standard search URI has the following structure:

```https://.../search/node?keys=value```

The default Search Path for the module is set to‘/search,’ and the default Search Key is set to ‘keys.’ 

## Getting Help or Reporting an Issue
 
For any questions regarding this project, or for inquiries about starting a new analytics account, please contact the GDX Analytics Team.

## Contributors

The GDX Analytics Team is the main contributor to this project and maintains the code.

## How to Contribute

If you would like to contribute, please see our [CONTRIBUTING](CONTRIBUTING.md) guidelines.

Please note that this project is released with a [Contributor Code of Conduct](CODE_OF_CONDUCT.md). By participating in this project, you agree to abide by its terms.

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
