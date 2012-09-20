PayPal Mobile Plugin Installation Instructions
==============================================
<sup> Powered by [ezimerchant](http://ezimerchant.com/)</sup><br>
 <sup>OsCommerce 2.2+ instructions</sup>

1. Install the <a href="https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/library_plugins_oscommerce">Paypal OsCommercce Express Checkout</a> plugin if you do not already have it.

1. Click the 'ZIP' button at the top of this page to download the plugin.

2. If you haven't already setup PayPal Express Checkout inside your OsCommerce installation, please follow these instructions, if you have already done so, please skip to step 3:
    + a. Login into your PayPal account
    + b. Under the 'My Account' tab, click 'Profile'
    + c. Under the 'Account Information' section, click the 'Request API credentials' link or 'API Access' link.
    + d. Under Option 2 on the next screen, click 'View API Signature' or 'Request API credentials'. You may need to click 'Agree and Submit'
    + e. You will use these details on the page to fill out the API credentials in OsCommerce. You should see API Username, API Password and Signature.
    + f. Login to OsCommerce
    + g. Go to Modules -> Payment and click on PayPal Express checkout.
    + h. Use the details from step 2e. and copy and paste the details accross. 
    + i. Hit Save.

3. Unpack the contents of the plugin into the catalog folder of your webserver directory. mobile.php will be in the in catalog directory, while the 'mobile' folder will be a subdirectory within that catalog folder. When you extract the zip, it will create a directory for the files called something like "PayPal-Mobile-Plugin-OsCommerce". You must move the files out of this directory in order for the plugin to work. 

4. Make a backup your current .htaccess file inside your public hosting directory - if you have one.

5. Merge mobile.htaccess file with your existing .htaccess file (if you already have one). This contains the mobile user agent detection.

6. Check the site is still functional on your desktop computer.

7. Check the site on your phone and test the transaction flow.

Revert Installation Instructions
--------------------------------

1. Remove the changes to the .htacess file that you have made. Or use the backed up .htaccess to overwrite the changes. This should restore previous functionality in itself.

### Optional Steps


2. Remove the mobile.php file in the root of your public hosting directory.

3. Remove the mobile subdirectory uploaded previously.