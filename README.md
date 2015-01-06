protocol_translator_radioactivityLab
====================================

A protocol translator for the UQ Radioactivity Lab

Installation:

1. Clone from https://github.com/gateway4labs/protocol_translator_radioactivityLab.git

This protocol translator was developed with Ratchet (http://socketo.me/), a WebSockets library for PHP.
Composer (https://getcomposer.org/) is used to manage the dependencies.

2. cd to protocol_translator_radioactivityLab and install Composer by downloading the latest composer.phar

3. Run:

  $ php composer.phar install

It will download all the dependencies

4. Check the ~/src/MyApp/iLab/config.ini and choose your database credentials

5. cd to ~/src and Run:

   $ php install.php [root_user] [root_password]

It will create the database, database user and assign all privileges to the user on the recently created database.


