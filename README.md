elementary-stats
================

elementary os stats from Launchpad. You can see the official page [here](http://stats.elementaryos.org) and the dev page [here](http://elementarybugs.org).

* List amount of bugs every day and show them in a graph
* A backup is done every day in ```data_backup.csv```

===

#### Ideas

* Seriously, do all the job in PHP, and let Python away
* Remove limitations (see below)
* Add more graphes: blueprints ?
* Add total bounties

===

#### Requirements

* PHP >= 5.x
* Python >= 2.7.x
    * urllib
    * os
    * datetime
    * sys
    * shutil

===

#### Installation

Copy/paste sources on your server and let it roll !

===

#### Limitations

Update is done only when the first user of the day display the page

===

#### Credits

* [elementary team](http://elementaryos.org)
* [elementary os french community](http://www.elementaryos-fr.org/) for all their advices and comments
* dajool for [isfreyareleasedyet sources](https://bitbucket.org/brejoc/isisisreleasedyet.com)

===

#### Libraries & Frameworks used

* [jQuery 1.11.0](https://jquery.com/)
* [Google Charts API](https://developers.google.com/chart/)
* [Bootstrap 3.2.0](http://getbootstrap.com/m)
* [normalize.css](https://github.com/necolas/normalize.css/)
* [jquery-csv](https://code.google.com/p/jquery-csv/)
