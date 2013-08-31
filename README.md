European Law Compliance Message
===============================

Revamp for the plugin: [EU Cookie Law Complience Message](http://wordpress.org/plugins/eu-cookie-law-consent).

#List of modifications:

###Plugin

 - Encapsulated everything into classes.
 - Changed option name to `EUCookieLawCompliance`, so as not to mix with the Locale.
 - JS scripts now being enqueued and localized.
 - Added sanitization to the Settings form.
 - Moved "reset" option inside sanitization.
 - Translation ready (the spanish file contain only some sample translations).
 - Added link to the Plugin's Settings page in Dashboard Plugins page

###JavaScript

 - Moved out CSS from inside JS.
 - Changed Cookie read/write to QuirksMode.
 - Changed Cookie name to `european-law-compliance`.
 - Added Farbtastic color selector.
 - Show/Hide the block Custom Setting based on the dropdown selection (admin area).