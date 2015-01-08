protocol_translator_radioactivityLab
====================================

A protocol translator for the UQ Radioactivity Lab

Installation:

1. Clone from https://github.com/gateway4labs/protocol_translator_radioactivityLab.git

This protocol translator was developed with Ratchet (http://socketo.me/), a WebSockets library for PHP.
Composer (https://getcomposer.org/) is used to manage the dependencies.

4. Rename ~/src/MyApp/iLab/public/config.php.dist to ~/src/MyApp/iLab/public/config.php

    $ cp src/MyApp/iLab/public/config.php.dist src/MyApp/iLab/public/config.php

5. Configure the database and iLab credentials in config.php

5. cd to Run:

   $ php install.php [db_root_password]

It will download composer to the working directory, install the dependencies, create the database, database user and assign all privileges to the user on the recently created database.


