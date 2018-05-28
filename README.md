Loewenstark_MixedFixed
=====================
- Mixed content (http <=> https) cleaning for product - , category description, CMS page and CMS block.
- More info: [Mixed Content](https://developers.google.com/web/fundamentals/security/prevent-mixed-content/what-is-mixed-content) 

- Example in Chrome Console:

![alt text](https://github.com/adamvarga/Loewenstark_MixedFixed/blob/master/mixed_content_error.png)

- With this module you have the possibility to change the http prefix to https.

Installation Instructions
-------------------------
1. Install the extension via GitHub, and deploy with modman or with composer.
2. Clear the cache, logout from the admin panel and then login again.
3. Cleaning start at System -> Configuration -> Loewenstark -> Mixed Content
4. Please make a database dump!
5. After successful cleaning, a success - message will appear.

![alt text](https://github.com/adamvarga/Loewenstark_MixedFixed/blob/master/mixedfixed_setup.png)


Uninstallation
--------------
1. Remove all extension files from your Magento installation OR
2. Modman remove Loewenstark_MixedFixed & modman clean

Support
-------
If you have any issues with this extension, open an issue on [GitHub](https://github.com/adamvarga).

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Developer
---------
Adam Varga