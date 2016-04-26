# Gravity Forms Protected Downloads

# This Plugin is under active development and not yet functional

## Overview

Add gated content downloads, requiring users to complete a Gravity Form to trigger downloads. Displays a download button that opens a modal form required for completing the download. A "Download" post type is included with the plugin, with a file field for selecting PDFs or other gated content downloads.


### Installation - WP Directory Download
1. Upload the plugin directory to the wp-content/plugins/ directory
2. Activate the plugin through the Plugins menu in WordPress

### Installation - Git Clone
1. Clone the repository to your site plugins directory
2. Run `composer install`
3. Activate the plugin through the Plugins menu in WordPress


### Usage
1. Add or choose an existing required Gravity Form for users to complete. Downloads can be configured to use any existing form, so different downloads may have different required forms.
2. Optionally, add a field to the form to store the download that the user is requesting.
3. Add a download post, and add a file from your media library using the included file custom field.
4. To add a download button, insert the shortcode manually, or use the "Add Download" button above the content editor to configure a shortcode.


#### Filters

- **Post Type Arguments:** `gfpd_posttype_args($args)`
- **Media Button Text:** `gfpd_media_button_text($text)`
- **Shortcode Builder Modal Header Text:** `gfpd_media_button_modal_text($text)`