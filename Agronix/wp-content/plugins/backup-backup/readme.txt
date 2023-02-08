=== Backup Migration ===
Contributors: Migrate
Tags: Backup, Migration, Migrate, Backups, Restore, All In One, Duplicate, Clone, Import, Export, Transfer
Requires at least: 4.6
Tested up to: 6.1.1
Stable tag: 1.2.7
License: GPLv3
Requires PHP: 5.6

Backup Migrate Restore

== Description ==

**Try it out on your free dummy site: Click here => [https://tastewp.com/plugins/backup-backup](https://demo.tastewp.com/bmi).**
(this trick works for all plugins in the WP repo - just replace "wordpress" with "tastewp" in the URL)

Creating a backup of your site has never been easier!

Simply install the plugin, click on "Create backup now" - done.

You can also schedule backups, e.g. define that a backup should be taken automatically every week (or every day/month).

Use a wide choice of configuration options:

- Define exactly which files / databases should be in the backup, which not
- Define where the backup will be stored (as of now, only local option is available, but we'll expand this soon)
- Define what name your backup should have, in which instances you should receive a notification email, and much more

This plugin is all in one solution if you need to migrate your site to another host or just restore the local backup.

Note: This (free) version is limited to backups of 2GB in size. For unlimited sizes, please have a look at the [Premium Plugin](https://backupbliss.com).

If any questions come up, please ask us in the [Support Forum](https://wordpress.org/support/plugin/backup-backup) - we're always happy to help!

== Frequently Asked Questions ==

= How do I create my first backup? =

Click on “Create backup now” on the settings page of the Backup Migration plugin.

Backup Migration will by default create a backup that contains everything from your site, except the Backup Migration plugin’s own backups and WordPress installation - if you want to include the WordPress installation as well, tick the checkbox in the section “What will be backed up?”.

You can download backup or migrate your backup (use the plugin as a WordPress duplicator) immediately after the backup has been created.

= How do I restore a backup? =

- If your backup is **located on your site**: Go to the Backup Migration plugin screen, then to the Manage & Restore Backup(s) tab where you have your backups list, click on the Restore button next to the backup you would like to restore.

- If your backup is **located on another site**: Go to the Backup Migration plugin screen on site #1, then to the Manage & Restore Backup(s) tab where you have the backups list, click on the “Copy Link”-button in the “Actions”-column. Go to the Backup Migration plugin screen on site #2, then to the Manage & Restore Backup(s) tab, click on “Super-quick migration”, paste the copied link, and hit the “Restore now!” button. This process will first import backup then restore it, i.e. Backup Migrate also serves as backup importer.

- If your backup is *located on another device*: Go to the Backup Migration plugin screen, then to the Manage & Restore Backup(s) tab, and click on the “Upload backup files” button. After the upload, click on the Restore button next to the backup you would like to restore.

= How do I migrate or clone my site? =

Migrate (or clone) a WordPress site by creating a full backup on the site that you want to migrate (clone) - site #1.

- To transfer website **directly from site #1 to site #2**: Go to the Backup Migration plugin screen on site #1, then to the Manage & Restore Backup(s) tab where you have the backups list, click on the Copy Link button in the Actions column. Go to the Backup Migration plugin screen on site #2, then to the Manage & Restore Backup(s) tab, click on “Super-quick migration”, paste the copied link, and hit the “Restore now!” button. Make sure that the backup file on site #1 is accessible by setting “Accessible via direct link?” to “Yes” in the plugin section “Where shall the backup(s) be stored?”

- To migrate the website **indirectly**: Go to the Backup Migration plugin screen, then to the Manage & Restore Backup(s) tab, and click on the “Upload backup files” button. After the upload, click on the Restore button next to the backup you would like to restore.

= Where can I find my backups? =

Backup Migration allows you to download backups, migrate backups, or delete backups directly from the plugin screen Manage & Restore Backup(s). By default, the migrator plugin will store a backup to /wordpress/wp-content/backup-migration but you can change the backup location to anywhere you please.

= How to run automatic backups? =

Enabling automatic backups is done on the Backup Migration plugin’s home screen, just next to the “Create backup now!” button. Auto backup can run on a monthly, weekly, or daily basis. You can set the exact time (and day) and how many automatic backups would you like to keep in the same Backup Migration plugin section. We recommend that you optimize the number of backups that will be kept according to available space.

= How big are backup files? =

Backup file size depends on the criteria you select on the “What will be backed up?” section of the Backup Migration plugin. There you can see file/folder size calculations as you Save your settings. Usually, WordPress’ Uploads folder is the heaviest, while Databases are the lightest. If you are looking to save up space, you might want to deselect Plugins and WordPress installation folders, as you can usually download those anytime from WP sources.

= Is the backup creation and site migration free? =

Yes. You can create full site backups, automatic backups, and migrate your site (duplicate site) free of charge. [Backup Migration Pro](https://sellcodes.com/oZxnXtc2) provides more sophisticated filters and selections of files that will be included/excluded from backups (affecting backup size), faster backup creation times, number of external backup storage locations, backup encryption, backup file compression methods, advanced backup triggers, additional backup notifications by email, priority support, and more.

= Is cloud backup available? =
Backup to cloud are some of the upcoming features, that will be available,
In Free version: Google Drive, FTP, Amazon S3, Rackspace, DreamObjects, Openstack and
In Premium version: Google cloud, SFTP/SCP, Microsoft Azure, OneDrive, Backblaze, and more.

= How are you better than other backup/migration plugins?  =
Besides having the most intuitive interface and smoothest user experience, Backup Migration plugin will always strive to give you more than any competitor:
- Updraftplus: They charge for migration, with our plugin it's free;
- All-in-One WP Migration: In the free version, compared to our plugin - they don’t have selective/partial backups; they lack advanced options and each external storage is on a separate extension plugin; they have no automatic backups;
- Duplicator: In the free version, compared to our plugin - they have no selective backups, exclusion rules, no automatic backups and no migration;
- WPvivid: In the free version, compared to our plugin - they don’t have selective/partial backups, exclusion rules, or automatic backups;
- BackWPup: In the free version, compared to our plugin - they lack restore options, backups are slower, automatic backups are dependant on wp cron;
- Backup Guard:  In the free version, compared to our plugin - they have no selective backups, exclusion rules; no direct migration;
- XCloner: Automatic backups are dependant on wp cron; full restore not available on a local server;
- Total Upkeep: They lack the advanced selective backups and exclusion rules, lacks a monthly backup schedule

= How to upload my backup file? =
Uploading a backup can be simply done by navigating to the Manage & Restore Backup(s) section of the BM plugin (tab on the right side). There you have “Upload backup file” button, after clicking on it, you need to select a proper backup that is made by this plugin only. You cannot use backups from other plugins (to restore those, go back to those plugins and restore them this way). If you use “Super-quick migration” (section b), your backup will ba automaticaly uploaded. If you are having trouble uploading the backup file, go bac and ensure that the folder designated for backups is writtable. You can find the backup destination in plugin section “Where shall the backup(s) be stored?

= Is the plugin also available in my language? =
So far we have translated the plugin into these languages:

Arabic: [إنشاء نسخة احتياطية واستعادة النسخ الاحتياطية وترحيل المواقع. أفضل مكون إضافي لمواقع الترحيل والاستنساخ!](https://ar.wordpress.org/plugins/backup-backup/)
Chinese (China): [创建备份、还原备份和迁移站点。 迁移和克隆网站的最佳插件！](https://cn.wordpress.org/plugins/backup-backup/)
Croatian: [Izradite sigurnosnu kopiju, vratite sigurnosne kopije i migrirajte web-mjesta. Najbolji dodatak za migraciju i kloniranje web stranica!](https://hr.wordpress.org/plugins/backup-backup/)
Dutch: [Maak back-ups, herstel back-ups en migreer sites. De beste plug-in voor het migreren en klonen van websites!](https://nl.wordpress.org/plugins/backup-backup/)
English: [Create a backup, restore backups and migrate a website. The best plugin for migration and to clone a website](https://wordpress.org/plugins/backup-backup/)
Finnish: [Luo varmuuskopio, palauta varmuuskopiot ja siirrä sivustot. Paras laajennus sivustojen siirtoon ja kloonaukseen!](https://fi.wordpress.org/plugins/backup-backup/)
French (France): [Créez des sauvegardes, restaurez des sauvegardes et migrez des sites. Le meilleur plugin pour les sites Web de migration et de clonage !](https://fr.wordpress.org/plugins/backup-backup/)
German: [Erstellen Sie Backups, stellen Sie Backups wieder her und migrieren Sie Websites. Das beste Plugin für Migrations- und Klon-Websites!](https://de.wordpress.org/plugins/backup-backup/)
Greek: [Δημιουργία αντιγράφων ασφαλείας, επαναφορά αντιγράφων ασφαλείας και μετεγκατάσταση τοποθεσιών. Το καλύτερο πρόσθετο για μετανάστευση και κλωνοποίηση ιστοσελίδων!](https://el.wordpress.org/plugins/backup-backup/)
Hungarian: [Biztonsági másolat készítése, biztonsági másolatok visszaállítása és webhelyek migrálása. A legjobb bővítmény a webhelyek migrációjához és klónozásához!](https://hu.wordpress.org/plugins/backup-backup/)
Indonesian: [Buat cadangan, pulihkan cadangan, dan migrasikan situs. Plugin terbaik untuk migrasi dan kloning situs web!](https://id.wordpress.org/plugins/backup-backup/)
Italian: [Crea backup, ripristina backup e migra i siti. Il miglior plugin per la migrazione e la clonazione di siti web!](https://it.wordpress.org/plugins/backup-backup/)
Persian: [ایجاد نسخه پشتیبان، بازیابی نسخه پشتیبان، و مهاجرت سایت ها. بهترین افزونه برای مهاجرت و شبیه سازی وب سایت ها!](https://fa.wordpress.org/plugins/backup-backup/)
Polish: [Twórz kopie zapasowe, przywracaj kopie zapasowe i przenoś witryny. Najlepsza wtyczka do migracji i klonowania stron internetowych!](https://pl.wordpress.org/plugins/backup-backup/)
Portuguese (Brazil): [Crie backup, restaure backups e migre sites. O melhor plugin para migração e clonagem de sites!](https://br.wordpress.org/plugins/backup-backup/)
Russian: [Создавайте резервные копии, восстанавливайте резервные копии и переносите сайты. Лучший плагин для миграции и клонирования сайтов!](https://ru.wordpress.org/plugins/backup-backup/)
Spanish: [Cree copias de seguridad, restaure copias de seguridad y migre sitios. ¡El mejor complemento para sitios web de migración y clonación!](https://es.wordpress.org/plugins/backup-backup/)
Turkish: [Yedekleme oluşturun, yedeklemeleri geri yükleyin ve site taşıyın. Websitesi taşımaya ve klonlamaya yönelik en iyi eklentidir!](https://tr.wordpress.org/plugins/backup-backup/)
Vietnamese: [Tạo sao lưu, khôi phục các bản sao lưu và di chuyển các trang web. Plugin tốt nhất để di chuyển và sao chép các trang web!](https://vi.wordpress.org/plugins/backup-backup/)

== Screenshots ==
1. Backup Migration plugin front
2. What will be backed up
3. Backup in progress
4. Backup finished
5. Manage & Restore backups
6. Restoring in progress
7. Restore finished

== Installation ==

= Admin Installer via search =
1. Visit the Add New plugin screen and select "Author" from the dropdown near search input
2. Search for "Migrate"
3. Find "Backup Migration" and click the "Install Now" button.
4. Activate the plugin.
5. The plugin should be shown below settings menu.

= Admin Installer via zip =
1. Visit the Add New plugin screen and click the "Upload Plugin" button.
2. Click the "Browse..." button and select the zip file of our plugin.
3. Click "Install Now" button.
4. Once uploading is done, activate Backup Migration.
5. The plugin should be shown below the settings menu.


== Changelog ==

= 1.2.7 =
* Adjusted PHP compatibility

= 1.2.6 =
* Fixed wrong version tag in v1.2.5 (hotfix)

= 1.2.5 =
* Added black-friday theme (only for that period)
* Fixed automatic backup for premium extension (sites above 2 GB)
* Fixed error handling after database export (timeout detection)
* Tested up to WordPress 6.1.1

= 1.2.4 =
* Fixed issue with restoration when site was restored on same domain but different server
* Improved force-stop functionality, it will now clean-up temporary theme after failed restoration
* Added directory check of temporary theme during restoration

= 1.2.3 =
* Permanently excluded link files from the backup (directories and files)
* Permanently excluded non-readable files from the backup to prevent errors.
* Applied above exclusion rules to file size calculator in plugin settings
* Removed unused debug dd() function to prevent conflicts
* Adjusted bytes to read converter to display proper size value on string data
* Changed action hook of plugin's settings – script and style
* Fixed issues with notices/warnings of unaccessible variables (backup)
* Set new database export engine as default (v4, requires at least v1.2.2 to restore)
* Added possibility to disable space check step, not recommend but may help in some cases
* Updated out of the box backup paths of other plugins - exclusion rules (5 new)
* Fixed temporary files clean-up after restoration (fail and successful)
* Modified default size of query output – new value: 2000
* Added support for batching to search & replace step (restoration/migration)
* Added new option for search & replace, allows to set page size – default 300
* Removed unused deactivation module from source code
* Added hints of how to properly create support topic
* Fixed close button for restoration/migration process error window
* Adjusted style of logs for database (now current table will be displayed as step)
* Fixed percentages above 100% for database table progress in logs
* Adjusted old v3 database engine to support new search replace method
* Added automatic temporary theme for the time of restoration/migration
* All other plugins will be now automatically disabled during db migration/restoration
* Fixed rare issue when wp-config.php was empty after restoration
* Fixed issues with database restoration of tables with columns using reserved names (like "key")
* Fixed issues with search & replace of tables with columns using reserved names (like "key")
* Added improvements for restoration at TasteWP.com
* Updated v3 restoration engine (old backups) to not activate problematic plugins
* Added batching for database export during backup process (only alternate backup methods)
* Added option which allows to toggle batching technique of database export (disabled by default)
* Fully tested on WordPress 6.1 with PHP 7.4, 8.0 and 8.1
* Fixed Super-Quick Migration automatic restoration continuation
* Fixed download URL and Super-Quick Migration URL displayed after backup process
* Premium: Fixed database table exclusion rules in different backup methods
* Added additional check for non-readable files in legacy backup methods
* Minimized possibility of damaged backup with success window
* Resolved issues with freezing live-log in/with PHP CLI mode
* Fixed multisite restoration while blog domain used www. while new website don't
* Adjusted engine selector for compatibility with older restoration methods
* Adjusted auto-login after restoration to work with forum-like plugins and new version of WP

= 1.2.2 =
* Fixed some plugin conflicts causing styling issues in our plugin
* Removed unnecessary error logging
* Resolved issues with PHP 8 and PHP 8.1 internal log format
* Added more blacklisted tables to restoration process
* Added pre-loader between calculation and backup load
* Added new troubleshooting method, allows to share complete logs with one click
* Added new backup and restoration engine for database (much quicker!)
* Decreased possibility of out of memory issues during URL adjustment
* Improved stability of PHP CLI restoration process
* Fixed issues of too quick restorations, decreasing false-positive errors
* Added handler for browser-side errors, decreasing chance of frozen process
* Fixed issues when log in pop-up was display during or after restoration
* Fixed issues when backed-up wp-config.php was overriding main wp-config.php
* Adjusted log display to be more smooth (no delays, quicker steps update)
* Fixed formatting issues in readme file (FAQ)
* Fixed automatic cleanup of files after migration
* Fixed issue when restoration was not continued after download (Super-Quick Migration)
* Modified error windows for backup and restore process
* Tested with WordPress 6.0.1

= 1.2.1 =
* Adjusted typos in our FAQ for migration process
* Updated blacklist of plugins to activate after migration
* Added blacklist for junk data tables - should significantly speed up restore process in some cases
* Fixed notice messages of non existing temporary files
* Improved latest Search & Replace engine to preform properly on multi-level subdomains
* Tested with WordPress 6.0-beta3
* Added blacklist for binary broken files
* Added flushing of rewrite rules after migration
* Adjusted display of TABs in settings on smaller screens
* Premium: Fixed our settings display issues with PHP 8 and PHP 8.1
* Added option: Select first method of backup (which makes one database file)
* Added option: Removal of all plugins and themes after migration that were not included in the backup

= 1.2.0 =
* New (Premium): Now you can exclude database tables from backup (all methods)
* Added new restoration method
* Fixed issues with header & footer display after migration
* Improved migration performance (speed) up to 80%
* Fixed auto login issues after migration for PHP CLI and normal method
* Added MySQL Version to logging
* Added MySQL Max query size info to logging
* Added new engine for database search & replace
* Renamed all download files and removed all translations of such file names
* Log files are not prepared for our live-chat - so, we can provide better support :)
* New restoration method allows you to protect your site from fatal error after migration
* Plugins that cause errors will be automatically disabled
* Fixed issues with logging and auto login on "no ending slash" browsers/servers
* Fixed issue when user could not access bottom sections of plugin settings
* Fixed display of total queries on slower servers
* Disabled mysqli support for legacy method of backup (now will use native wpdb)
* Incoming in 1.2.1: Select first method of backup (which makes one database file)
* Incoming in 1.2.1: Removal of all plugins and themes after migration that were not included in the backup

= 1.1.9 =
* Fixed compatibility issue with backups made before v1.1.7 (restoration)

= 1.1.8 =
* Fixed issue with restoration due to bug in previous version

= 1.1.7 =
* Tested up with WP Version 5.9 (up to beta 3)
* Fixed restoration issues for Windows and Windows Server
* Fixed notifications via e-mail - now you can receive max 1 e-mail per day
* Adjusted cleanup of restoration files - GC processing
* Fixed restore process request, after Super-Quick Migration (sometimes it was hanging)
* Fixed restoration process via shell due to syntax error
* Adjusted important parts to be compatible with Windows systems
* Modified default value of query output to 300
* By default SQL-Splitting will be enabled since this version (adjusted for all users)
* Removed/fixed unnecessary notices in error log above PHP 7.4
* Added new indicators in restore and backup logs
* Now newly created backups saves WP version of source site
* Restore and backup logs will display version of current backup
* PHP CLI will be disabled by default for new users
* Fixed some JavaScript issues of front-end process manager

= 1.1.6 =
* Plugin tested with PHP 8.1
* Plugin tested with WP Version 5.8.2
* Fixed PHP CLI for sites above 2 GB (premium)
* Modified default settings for new users, to solve most common issues
* Modified default query output to 500 per batch, to solve most common database issue
* Fixed undefined variables of zipping module (PHP 7.4+)
* Fixed backups made with PHP CLI when the ZIP wasn't closed correctly
* Visual updates for our cool banner
* Super-Quick Migration now should work with PHP CLI
* Now WordPress version will be displayed in the logs
* Fixed English typo in logs "enginge" => "engine"
* Added additional sanitization for e-mail, e-mail title and directory (Thank you @Vlad Visse (Patchstack))
* Added version tag

= 1.1.5 =
* Fixed typos in tooltip about queries
* Modified default value of queries

= 1.1.4 =
* Tested up to WordPress 5.8.1
* Fixed warnings in PHP 8 and adjusted ob_clean functions (Thank you @jrevillini)
* Added force stop for restoration and migration process
* Added force stop for backup process (troubleshooting option)
* Added splitting option for restore and migration process
* Fixed STEP display in process window for restore and backup
* Adjusted logs output for restore and backup process
* Updated database engine for export and import using new technique
* Added new option to specify export queries per file and restore batch
* Implemented splitting n into CLI restoration (disabled by default)

= 1.1.3 =
* Fixed PHP CLI migration process (in case of different table prefix)
* Restricted access to global logs
* Restricted access to backup logs
* Added censor for backup name in all log files
* Added censor for sensitive details in global log and others
* Randomize folder name for each site, it will rename old directory as well
* Backup hash name will be now extended up to 16 characters including A-z
* Decreased default database batch size to 250 from 2500 queries
* Added constant ***ABSPATH*** for exclusion rules
* Tested up to WordPress 5.8

= 1.1.2 =
* Added new option which allow to specify own PHP CLI path
* Added possibility to disable PHP CLI for both restore and backup process
* Fixed output data restore process – should not hang up on success
* Fixed output data for backup process – should not hang up on success as well
* Added batching for restore process, should extend execution time
* Increased batch size for huge sites up to 40k files per batch
* Increased default max size of batch from 60 MB to 96 MB
* Fixed issues with PHP CLI when the output was not correct
* Added possibility to download live log of restore process (useful when it hang up)
* Restore process now can calculate file amount before extraction
* Added secret keys for restore process – should be much more secure now
* Added batching for database export, plugin should use maximum execution time now
* Removed debug information in console log (should be in 1.1.1)
* Added batching for files extraction during restore process
* Restore process now shows extraction progress – the process is slower because of it but more stable
* Fixed PHP CLI for premium users where the site is too large
* Fixed SuperQuick Migration via PHP CLI – now the process should continue automatically
* Added notice logging into restore process
* Now restore process will continue on notice like uninitialized classname
* Fixed issue when restore process hangs up (5.6 - 7.4 PHP versions) due to uninitialized classname

= 1.1.1 =
* Modified restore safe limit calculation for better performance
* Fixed issues with restore on PHP 8
* Fixed database restore issues, when the database is damaged
* Adjusted database parser for older MySQL versions
* Updated storage front-end UX

= 1.1.0 =
* Fully tested with WordPress 5.7.2
* Fixed rare notices and warnings of PHP 8
* New database engine for restore and backup process
* Rewritten find and replace method for database migration
* Changed default configuration settings
* Added "insecure download" option for LiteSpeed Web Servers
* Added possibility to run backup or restore process via shell (PHP CLI aka WP CLI)
* Increased support for free users up to 2 GB size of site.
* Final files now will be included in the last batch (for cURL and Browser method)
* Update of success modals (restore & backup)
* New smart PHP CLI detection tool, it will check for valid PHP executable binary file
* Plugin now requires at least PHP CLI of 5.6 version - for older it will run legacy methods
* Fixed automatic backup issue when it was impossible to disable with plugin's options
* Increased stability of hick-ups screens, false positives should not happen now
* Added full support for ZipArchive add-on
* Super-Quick Migration now can run as PHP CLI process (download can't be aborted by Web Server now)
* Backups created with this version are not supported by older versions of this plugin
* Backups created with older versions can be restored with this version (1.1.0) and above
* Newly created backups should not cause fatal errors if they were aborted / killed during restore
* Hardly excluded wp-config.php from backup, can be restored only manually if needed
* Fixed error "Tried to allocate xxx bytes" during migration & backup (tested up to 650 MB database size)
* Excluded other plugins from Backup Migration plugin error log
* Optimized logging for global logs of Backup Migration log - file should be smaller now
* Added new settings in "Other Options" section
* If restore fail the temporary files should be fully cleaned up now

= 1.0.9 =
* Fixed issue of v1.0.8 [Automatic backups does not work]
* Fixed issue of v1.0.8 [Download of backup does not work]

= 1.0.8 =
* Added warnings for huge files (above 60 MB)
* Increased timeout limit
* Now plugin will ignore server abort command (should help in some cases)
* Progress bar won't show the counter if file count isn't known
* Increased default memory to (minimum: 384 MB)
* Added smart chunker for bigger sites (now it's possible to have chunks of 2500 files)
* Improved performance of the backups (should be much faster for sites 3000+ files)
* Database import is now memory friendly (database size can be really big, without error)
* Database export is also chunked for better stability of the backup
* Support for page builders – now cloned site should be perfect mirror
* Quick Migration: Removed timeout for huge files (should download full file now)
* Added better memory calculator, mostly improvement for shared hostings.
* Fixed issues on SunOS with free space calculator.
* Added support for installations not inside root (e.g. domain.tld, domain.tld/wordpress)
* Fixed issue when your database contains '-' character (fetch() function)
* Fixed PclZip issue i.e. "requires at least 18 bytes"
* Fixed BMI\Plugin\Zipper\finfo_open() error
* Premium: Replaced PclZip with more stable & dedicated edition of this module
* Premium: Improved performance of the core overall (smaller size to decrypt)
* Since now only site Administrator can manage backups by default
* Added permission "do_backups" – users with this permissions
* Added new option "Bypass server limits"
* Added support for ZipArchive (only when some bypass function is enabled)
* Added support for PHP Cli - it will be preferred option now

= 1.0.7 =
* Hot fix - Restore process fixed when premium plugin is activated

= 1.0.6 =
* Backup Support for WordPress 5.6
* Backup Support for PHP 8.0
* Fixed issue with completely empty backup files (0 bytes)
* Fixed back up progress (NaN shouldn't display anymore)
* For better backup & network performance decreased amount of calls
* Admin can bypass backup logs protection (File won't expire for them)
* Added update information to downloaded backup and restore logs
* Added some server infos to backup / migration logs
* Support for backup "front-end" errors – for easier debugging
* Server back up errors should be also logged in (limited on LSWS)
* Better back up error logging – global log will contain all errors
* Added back up troubleshooting option: send test email
* Added back up troubleshooting option: fix php_uname warning/error
* Removed back up PHP Errors reports from log files

= 1.0.5 =
* Premium relation
* Translations adjustment
* Load priority change (for better performance of entire website)

= 1.0.4 =
* Removed included PclZip
* Added support for WordPress 4.6
* Support for PHP 5.6
* Rephrased some tooltips to be more clear
* Added support for custom wp-content folder
* Changed excluded files by default

= 1.0.3 =
* Created special htaccess for litespeed
* Added dynamic counter of current file
* Added more info in backup logs

= 1.0.2 =
* Dedicated space checking with dummy file
* Added smart memory manager
* Fixed migration issues (database)
* Fixed backup issues (litespeed users)
* Progress won't hide on front-end error (e.g. lost connection)
* Added more error messages (backup)

= 1.0.1 =
* Changed tooltips background color for better contrast
* Updated some translation strings

= 1.0.0 =
* Initial release

== Upgrade Notice ==
= 1.2.7 =
What's new in 1.2.7?
* Added black-friday theme (only for that period)
* Fixed automatic backup for premium extension (sites above 2 GB)
* Fixed error handling after database export (timeout detection)
* Tested up to WordPress 6.1.1
* Fixed wrong version tag in v1.2.5 (hotfix)
* Adjusted PHP compatibility
