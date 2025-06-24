[![img](https://img.shields.io/badge/Lifecycle-Experimental-339999)]
## GDX-Analytics-Drupal-Snowplow

The GDX Analytics Drupal Snowplow module installs and runs Snowplow 
Javascript web trackers and provides an interface to configure them.
  
## Requirements  

This module requires Drupal 10. Backwards compatibility tests are also conducted for Drupal 9.

## Project Status

This project is currently under development and actively supported by the GDX Analytics Team.

This version: 4.0.0

This version, tested in Drupal 10, adds the option to declare a specific Search Key. The module looks for the Search Path(s) to trigger a search event and extracts the search terms from the URI based on the defined Search Key. It's important to note that this is a breaking feature, as previous version extracted search terms from the first key-value pair in the URI.

Older versions:

3.3.0: Drupal 10 version with multiple (comma-separated) search paths available. It is possible to configure the module to trigger a search event coming from different search paths.

3.2.0: Drupal 10 version with collector field validation updates.

3.1.0: Drupal 10 version compatible with Drupal search modules, including Search API. There are no hard-coded configurations anymore. The module looks for the Search Path to trigger a search event and extracts the search terms from the first key-value pair of the URI.

3.0.0: Drupal 10 version, backward tested with Drupal 9 & 8. This version reverts to using Drupal standard search and is not compatible with Search API.

2.0.0: Drupal 9 version with clean-up configuration page and a toggle for search/no-search. This version works with Drupal Search API but not the Standard Search.

1.0.0: First working version. The Drupal 8 module has been revised to work with Drupal 9, utilizing hard-coded configuration.
  

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
    
Use this configuration page to set the Collector Environment, Tracking Script URI, App ID, Search Path and Search Key.

Use the values provided by The GDX Analytics Team for:

- Collector Environment
- Snowplow tracking script URI
- App ID

If the Snowplow Search Event is enabled, the module looks for the Search Path to trigger a search event and extracts the search terms from the URI using the defined Search Key:

- Search Path = Enter the search path(s) required to trigger a search event. If you want to use multiple paths, use comma-separated values, e.g, "/search1, /search2".

- Search Key = Enter the search key required to extract search terms. If there are multiple copies of the same key in the URI, the module will concatenate all key values to the list of search terms. For example, the search terms extracted from "/search/node?keys=value1&keys=value2" will be (value1, value2) when the Search Path is set to "/search" and the Search Key is set to "keys".

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
