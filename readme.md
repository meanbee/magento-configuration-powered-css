# Meanbee Config Powered CSS Magento Extension

The aim of this extension is to provide magento frontend developers with a performant way of modifying page styles that are dependent on settings in admin. 

E.g. background images on a product page (with retina versions) that can be uploaded in admin.  Avoid inline style blocks and instead be able to output a CSS file. 

## Requirements

The user stories that this extension should achieve and maintain are as follows.

- As a store owner, I wish to be able to upload images in admin that change the site design.
- As a developer, I wish to providing retina images to website visitors and maintaining a performant system, i.e. minimise inline styles and HTTP requests.

## Technical Requirements

- Add a CSS file to head block
    - CSS file must not exist in repository.
- Trigger CSS File Regeneration
    - The CSS file should be generated on clicking of "Publish" button in cache management.
- Generates CSS File
    - CSS file should be in a directory which can be written to be the web. 
        - While there was a preference for media, we have chosen skin to maintain compatibility with CSS merging.
    - CSS file will be plain CSS and will have no interaction with frontend build tools.
    - CSS file will be generated with a custom block and template.
        - Each theme can then have it’s own template file if required.
        - This does mean the CSS would need regenerating if theme was changed on the store. 
    - The template will use getStoreConfig calls (supported by block function)
- There should be a different CSS file for each store to accommodate changing values on different store views.

## Development Setup

This extension provides a modman file for further development.  [Modman](https://github.com/colinmollenhour/modman) is an easy way to install magento extensions via symlink. 

	modman init
    modman clone git@github.com:meanbee/magento-configuration-powered-css.git

## Components

The observer `Meanbee_ConfigPoweredCss_Model_Observer_AddCss` adds the CSS file to the head block (or another block as specified in system configuration.

`Meanbee_ConfigPoweredCss_Model_Css` is responsible for writing to file. The content of which comes from `Meanbee_ConfigPoweredCss_Block_Css` and associated template `meanbee/configpoweredcss/css.phtml`.

