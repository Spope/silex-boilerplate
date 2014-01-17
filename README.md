Module:
* Cms
* Login MySQL

To install components :

	composer intall
    npm install

If composer is not installed :

	curl -sS https://getcomposer.org/installer | php

The database is located in **config/db.sql**

Preconfigured Grunt command :

	grunt watch    // will start grunt less on each .less file change.
    grunt compile  // will compile specified js files.

The url to access the admin of the CMS is index.php/admin/cms. Default admin account is admin/password. The default url to disconnect is index.php/admin/disconnect.

Passwords are generated with :

	echo $app['security.encoder.digest']->encodePassword('password', '');