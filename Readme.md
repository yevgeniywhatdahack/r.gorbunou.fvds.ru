# Technical description

## Install

1. Install ACF plugin (Advanced custom plugin)
2. Copy these plugins for plugin directory (wp-content/plugins)
3. Activation plugins
4. Import file with fields in ACF
5. Create pages:
   finish-registration – add on page shortcode [wdhforms mod="finish"]
   projects – add on page shortcode [wdhproject ]
6. Create posts with specialties in content types “WDH specialties”
7. Create posts with teams in content types “WDH team”
8. Make changes to the code with the current IDs of "default specialists" from “WDH team”- those specialists who do not have surnames to indicate their specialty in file /wdh-forms/wdh-forms.php
   <img src="Screenshot 2023-04-14 100955.png">

To set up integration with typeforms, you need to redirect to the page with the plugin (shortcode) with parameters:

- phone
- email
- budget
- platform (array ,)

Twillio key settings are in the same file
