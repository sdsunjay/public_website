DWPACLEC2

DWPACLEC2: Distributed WPA Cracker Leveraging EC2
=================================================

DWPACLEC2
=========

Distributed WPA Cracker Leveraging EC2
--------------------------------------

Motivation
----------

After taking a class in [CUDA](http://en.wikipedia.org/wiki/CUDA) at [Cal Poly](http://www.calpoly.edu/) and reading security research [Thomas Roth](http://www.blackhat.com/html/bh-dc-11/bh-dc-11-archives.html#Roth) paper,
I decided to implement distributed [WPA/2](http://en.wikipedia.org/wiki/Wi-Fi_Protected_Access) cracking on [EC2 GPU instances](http://aws.amazon.com/about-aws/whats-new/2013/11/04/announcing-new-amazon-ec2-gpu-instance-type/).
I discovered this has already been done, but not using a [dictionary attack](http://en.wikipedia.org/wiki/Dictionary_attack).

Description
-----------

There are four EC2 instances required to be running: the master, the database, and the two cracking instances. You start the master program and then the slave programs. The master connects to the slaves and sends them the information needed to crack the WPA/2 password as well as their ranges of passwords (If you have 1 million passwords in the database, slave 1 will get 0 - 500,000 and slave 2 will get 500,000 - 1,000,000). The slaves then query the database to get their batch (batch amount is definined [here](https://github.com/sdsunjay/DWPACLEC2/blob/master/src/slave/headers/common.h)) of passwords. The slaves then get to work generating hashes for each password and seeing if it matches. If it does match, the slave stops working and tells the master the password has been found. When the second slave finishes its batch of passwords and has not found the password, the master will let the slave know the first slave has already found the password and should stop. If neither slave has found the password, they will request another batch of passwords from the database and the process repeats itself until either the password is found or all the passwords in the database has been tried.

Implementation
--------------

*   The Database
    *   Running a [MySQL database](http://en.wikipedia.org/wiki/MySQL) holding a list of possible WPA/2 passwords
    *   Implementation of SQLite Database was never finished

*   The Master
    *   Keeping track of the cracking (slave) instances and if they finish or become unreachable

*   The Slaves
    *   GPU instances that got the handshake info from the master and the wordlist from the database
    *   Used the wordlist to compute a hash and check if it matched the one we were looking for

How To Use
----------

*   Pre
    *   Create 4 AWS EC2 instances
        *   1 small instance for Master
        *   1 small instance for Database
        *   2 GPU instances for Slaves
    *   Clone my git repo onto all instances (use 'git clone https://github.com/sdsunjay/DWPACLEC2.git')
    *   Open necessary ports
    *   Option 1
        *   Use [aircrack-ng](http://www.aircrack-ng.org/) to capture a [WPA/2 handshake](http://security.stackexchange.com/questions/17767/four-way-handshake-in-wpa-personal-wpa-psk). Instructions found [here](http://www.aircrack-ng.org/doku.php?id=cracking_wpa).
        *   On master instance use [this script](https://github.com/sdsunjay/DWPACLEC2/blob/master/src/master/run.sh) to pull the relevant information from the handshake and output to a textfile
    *   Option 2
        *   Simply use [the example](https://github.com/sdsunjay/DWPACLEC2/blob/master/test/sunjay_capture) textfile

*   The Database

*   Create a small EC2 instance
*   Download large WPA password list (for testing purposes, use [this script](https://github.com/sdsunjay/DWPACLEC2/blob/master/src/db/genAllPhone.c))
*   Remove any duplicates from the list
*   Install a MySQL database, use [this script](https://github.com/sdsunjay/DWPACLEC2/blob/master/src/db/genDatabase.cpp) to create everything.
*   To insert additional lists into the database, use [this script](https://github.com/sdsunjay/DWPACLEC2/blob/master/src/db/script.pl)

*   The Master
    *   Create a small EC2 instance
    *   Install Java
    *   Edit config file with information regarding slava and database info

*   The Slave(s)
    *   Create at least two GPU EC2 instance
    *   Use [this script](https://github.com/sdsunjay/DWPACLEC2/blob/master/startupAWS.sh) to setup instance and install CUDA

Outcome
-------

*   Lowered costs and difficulty associated with cracking WPA/2
*   Increased cost to speed ratio

### A complete explanation can be found [here](https://github.com/sdsunjay/DWPACLEC2/blob/master/report/Senior%20Project%20Report/Final%20Senior%20Project%20Report.pdf).

### Author

[Sunjay Dhama](https://sunjaydhama.com)
