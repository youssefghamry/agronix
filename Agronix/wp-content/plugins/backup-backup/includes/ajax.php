<?php

  // Namespace
  namespace BMI\Plugin;

  // Exit on direct access
  if (!defined('ABSPATH')) exit;

  // Uses
  use BMI\Plugin\Backup_Migration_Plugin as BMP;
  use BMI\Plugin\BMI_Logger as Logger;
  use BMI\Plugin\Checker\BMI_Checker as Checker;
  use BMI\Plugin\Checker\System_Info as SI;
  use BMI\Plugin\CRON\BMI_Crons as Crons;
  use BMI\Plugin\Dashboard as Dashboard;
  use BMI\Plugin\Extracter\BMI_Extracter as Extracter;
  use BMI\Plugin\Progress\BMI_MigrationProgress as MigrationProgress;
  use BMI\Plugin\Progress\BMI_ZipProgress as Progress;
  use BMI\Plugin\Scanner\BMI_BackupsScanner as Backups;
  use BMI\Plugin\Scanner\BMI_FileScanner as Scanner;
  use BMI\Plugin\Zipper\BMI_Zipper as Zipper;
  use BMI\Plugin\PHPCLI\Checker as PHPCLICheck;

  /**
   * Ajax Handler for BMI
   */
  class BMI_Ajax {
    public function __construct() {

      // Return if it's not post
      if (empty($_POST)) {
        return;
      }

      // Sanitize User Input
      $this->post = BMP::sanitize($_POST);

      // Log Handler Call (Verbose)
      Logger::debug(__("Running POST Function: ", 'backup-backup') . $this->post['f']);

      // Create backup folder
      if (!file_exists(BMI_BACKUPS)) {
        mkdir(BMI_BACKUPS, 0755, true);
      }

      // Handle User Request If Known And Sanitize Response
      if ($this->post['f'] == 'scan-directory') {
        BMP::res($this->dirSize());
      } elseif ($this->post['f'] == 'create-backup') {
        BMP::res($this->prepareAndMakeBackup());
      } elseif ($this->post['f'] == 'reset-latest') {
        BMP::res($this->resetLatestLogs());
      } elseif ($this->post['f'] == 'get-current-backups') {
        BMP::res($this->getBackupsList());
      } elseif ($this->post['f'] == 'restore-backup') {
        BMP::res($this->restoreBackup());
      } elseif ($this->post['f'] == 'is-running-backup') {
        BMP::res($this->isRunningBackup());
      } elseif ($this->post['f'] == 'stop-backup') {
        BMP::res($this->stopBackup());
      } elseif ($this->post['f'] == 'download-backup') {
        BMP::res($this->handleQuickMigration());
      } elseif ($this->post['f'] == 'migration-locked') {
        BMP::res($this->isMigrationLocked());
      } elseif ($this->post['f'] == 'upload-backup') {
        BMP::res($this->handleChunkUpload());
      } elseif ($this->post['f'] == 'delete-backup') {
        BMP::res($this->removeBackupFile());
      } elseif ($this->post['f'] == 'save-storage') {
        BMP::res($this->saveStorageConfig());
      } elseif ($this->post['f'] == 'save-file-config') {
        BMP::res($this->saveFilesConfig());
      } elseif ($this->post['f'] == 'save-other-options') {
        BMP::res($this->saveOtherOptions());
      } elseif ($this->post['f'] == 'store-config') {
        BMP::res($this->saveStorageTypeConfig());
      } elseif ($this->post['f'] == 'unlock-backup') {
        BMP::res($this->toggleBackupLock(true));
      } elseif ($this->post['f'] == 'lock-backup') {
        BMP::res($this->toggleBackupLock(false));
      } elseif ($this->post['f'] == 'get-dynamic-names') {
        BMP::res($this->getDynamicNames());
      } elseif ($this->post['f'] == 'reset-configuration') {
        BMP::res($this->resetConfiguration());
      } elseif ($this->post['f'] == 'get-site-data') {
        BMP::res($this->getSiteData());
      } elseif ($this->post['f'] == 'send-test-mail') {
        BMP::res($this->sendTestMail());
      } elseif ($this->post['f'] == 'calculate-cron') {
        BMP::res($this->calculateCron());
      } elseif ($this->post['f'] == 'dismiss-error-notice') {
        BMP::res($this->dismissErrorNotice());
      } elseif ($this->post['f'] == 'fix_uname_issues') {
        BMP::res($this->fixUnameFunction());
      } elseif ($this->post['f'] == 'revert_uname_issues') {
        BMP::res($this->revertUnameProcess());
      } elseif ($this->post['f'] == 'continue_restore_process') {
        BMP::res($this->continueRestoreProcess());
      } elseif ($this->post['f'] == 'htaccess-litespeed') {
        BMP::res($this->fixLitespeed());
      } elseif ($this->post['f'] == 'force-backup-to-stop') {
        BMP::res($this->forceBackupToStop());
      } elseif ($this->post['f'] == 'force-restore-to-stop') {
        BMP::res($this->forceRestoreToStop());
      } elseif ($this->post['f'] == 'send-troubleshooting-logs') {
        BMP::res($this->sendTroubleshootingDetails());
      } elseif ($this->post['f'] == 'log-sharing-details') {
        BMP::res($this->logSharing());
      } elseif ($this->post['f'] == 'get-latest-backup') {
        BMP::res($this->getLatestBackupFile());
      } elseif ($this->post['f'] == 'debugging') {
        BMP::res($this->debugging());
      } else {
        do_action('bmi_premium_ajax', $this->post);
      }

    }

    public function siteURL() {
      $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
      $domainName = $_SERVER['HTTP_HOST'];

      return $protocol . $domainName;
    }

    public function checkIfPHPCliExist(&$logger) {

      if (defined('BMI_CLI_ENABLED')) {
        if (BMI_CLI_ENABLED === false) {
          $logger->log(__('PHP CLI is disabled manually, plugin will omit all PHP CLI steps.', 'backup-backup'), 'warn');
          return false;
        }
      }

      $logger->log(__('Looking for PHP CLI executable file.', 'backup-backup'), 'step');
      require_once BMI_INCLUDES . '/cli/php_cli_finder.php';
      $checker = new PHPCLICheck();
      $result = $checker->findPHP();

      if ($result === false) {

        if (!defined('BMI_CLI_ENABLED')) define('BMI_CLI_ENABLED', false);
        if (!defined('BMI_CLI_EXECUTABLE')) define('BMI_CLI_EXECUTABLE', false);
        if ($checker->ini_disabled === true) {
          $logger->log(__('PHP CLI is disabled in your php.ini file, the process may be unstable.', 'backup-backup'), 'warn');
        } else {
          $logger->log(__('Could not find proper PHP CLI executable, this process may be unstable.', 'backup-backup'), 'warn');
        }

        return false;

      } else {

        if (!defined('BMI_CLI_ENABLED')) define('BMI_CLI_ENABLED', true);
        if (!defined('BMI_CLI_EXECUTABLE')) define('BMI_CLI_EXECUTABLE', $result['executable']);

        $logger->log(__('PHP CLI Filename: ', 'backup-backup') . basename($result['executable']), 'info');
        $logger->log(__('PHP CLI Version: ', 'backup-backup') . $result['version'] . ' ' . $result['brand'], 'info');
        $logger->log(__('PHP CLI Memory limit: ', 'backup-backup') . $result['memory'], 'info');
        $logger->log(__('PHP CLI Execution limit: ', 'backup-backup') . $result['max_exec'], 'info');
        $logger->log(__('We properly detected PHP CLI executable file.', 'backup-backup'), 'success');

        return $result;

      }

    }

    public function dirSize() {

      // Require File Scanner
      require_once BMI_INCLUDES . '/scanner/files.php';

      // Folder
      $f = $this->post['folder'];

      // Bytes
      $bytes = 0;
      $bm = BMP::fixSlashes(BMI_BACKUPS);

      if ($f == 'plugins') {
        $bytes = Scanner::scanFilesWithIgnore(BMP::fixSlashes(WP_PLUGIN_DIR), ['backup-backup', 'backup-backup-pro'], $bm);
      } elseif ($f == 'uploads') {
        $bytes = Scanner::scanFiles(BMP::fixSlashes(WP_CONTENT_DIR) . DIRECTORY_SEPARATOR . 'uploads', $bm);
      } elseif ($f == 'themes') {
        $bytes = Scanner::scanFiles(BMP::fixSlashes(WP_CONTENT_DIR) . DIRECTORY_SEPARATOR . 'themes', $bm);
      } elseif ($f == 'contents_others') {
        $bytes = Scanner::scanFilesWithIgnore(untrailingslashit(BMP::fixSlashes(WP_CONTENT_DIR)), ['uploads', 'themes', 'plugins'], $bm);
      } elseif ($f == 'wordpress') {
        $bytes = Scanner::scanFilesWithIgnore(BMP::fixSlashes(ABSPATH), [BMP::fixSlashes(WP_CONTENT_DIR)], $bm);
      }

      return [ 'bytes' => $bytes, 'readable' => BMP::humanSize($bytes) ];

    }

    public function backupErrorHandler() {
      set_error_handler(function ($errno, $errstr, $errfile, $errline) {

        if (strpos($errstr, 'deprecated') !== false) return;
        if (strpos($errstr, 'php_uname') !== false) return;
        if ((strpos($errstr, 'backup-migration') !== false) && (strpos($errstr, 'backup-backup') !== false)) return;

        if ($errno != E_ERROR && $errno != E_CORE_ERROR && $errno != E_COMPILE_ERROR && $errno != E_USER_ERROR && $errno != E_RECOVERABLE_ERROR) {

          if (strpos($errfile, 'backup-backup') === false && strpos($errfile, 'backup-migration') === false) return;
          Logger::error(__('There was an error before request shutdown (but it was not logged to restore log)', 'backup-backup'));
          Logger::error(__('Error message: ', 'backup-backup') . $errstr);
          Logger::error(__('Error file/line: ', 'backup-backup') . $errfile . '|' . $errline);
          return;

        }
        if (strpos($errfile, 'backup-backup') === false) {
          Logger::error(__("Restore process was not aborted because this error is not related to Backup Migration.", 'backup-backup'));
          $this->migration_progress->log(__("There was an error not related to Backup Migration Plugin.", 'backup-backup'), 'warn');
          $this->migration_progress->log(__("Message: ", 'backup-backup') . $errstr, 'warn');
          $this->migration_progress->log(__("Backup will not be aborted because of this.", 'backup-backup'), 'warn');
          return;
        }
        if (strpos($errstr, 'unlink(') !== false) {
          Logger::error(__("Restore process was not aborted due to this error.", 'backup-backup'));
          Logger::error($errstr);
          return;
        }
        if (strpos($errfile, 'pclzip') !== false) {
          Logger::error(__("Restore process was not aborted due to this error.", 'backup-backup'));
          Logger::error($errstr);
          return;
        }
        if (strpos($errstr, 'rename(') !== false) {
          Logger::error(__("Restore process was not aborted due to this error.", 'backup-backup'));
          Logger::error($errstr);
          $this->migration_progress->log(__("Cannot move: ", 'backup-backup') . $errstr, 'warn');
          return;
        }

        $this->zip_progress->log(__("There was an error during backup:", 'backup-backup'), 'error');
        $this->zip_progress->log(__("Message: ", 'backup-backup') . $errstr, 'error');
        $this->zip_progress->log(__("File/line: ", 'backup-backup') . $errfile . '|' . $errline, 'error');
        $this->zip_progress->log(__('Unfortunately we had to remove the backup (if partly created).', 'backup-backup'), 'error');

        $backup = $GLOBALS['bmi_current_backup_name'];
        $backup_path = BMI_BACKUPS . DIRECTORY_SEPARATOR . $backup;
        if (file_exists($backup_path)) @unlink($backup_path);
        if (file_exists(BMI_BACKUPS . DIRECTORY_SEPARATOR . '.running')) @unlink(BMI_BACKUPS . DIRECTORY_SEPARATOR . '.running');
        if (file_exists(BMI_BACKUPS . DIRECTORY_SEPARATOR . '.abort')) @unlink(BMI_BACKUPS . DIRECTORY_SEPARATOR . '.abort');

        $this->zip_progress->log(__("Aborting backup...", 'backup-backup'), 'step');
        $this->zip_progress->log(__("#002", 'backup-backup'), 'end-code');
        $this->zip_progress->end();

        $GLOBALS['bmi_error_handled'] = true;
        BMP::res(['status' => 'error', 'error' => $errstr]);
        exit;

      }, E_ALL);
    }

    public function migrationErrorHandler() {
      set_exception_handler(function ($exception) {
        $this->migration_progress->log(__("Restore exception: ", 'backup-backup') . $exception->getMessage(), 'warn');
        Logger::log(__("Restore exception: ", 'backup-backup') . $exception->getMessage());
      });
    }

    public function migrationExceptionHandler() {
      set_error_handler(function ($errno, $errstr, $errfile, $errline) {

        if (strpos($errstr, 'deprecated') !== false) return;
        if (strpos($errstr, 'php_uname') !== false) return;
        if ($errno == E_NOTICE) return;
        if ($errno != E_ERROR && $errno != E_CORE_ERROR && $errno != E_COMPILE_ERROR && $errno != E_USER_ERROR && $errno != E_RECOVERABLE_ERROR) {
          if (strpos($errfile, 'backup-backup') === false && strpos($errfile, 'backup-migration') === false) return;
          Logger::error(__('There was an error before request shutdown (but it was not logged to restore log)', 'backup-backup'));
          Logger::error(__('Error message: ', 'backup-backup') . $errstr);
          Logger::error(__('Error file/line: ', 'backup-backup') . $errfile . '|' . $errline);
          return;
        }

        Logger::error(__("There was an error/warning during restore process:", 'backup-backup'));
        Logger::error(__("Message: ", 'backup-backup') . $errstr);
        Logger::error(__("File/line: ", 'backup-backup') . $errfile . '|' . $errline);

        if (strpos($errfile, 'backup-backup') === false) {
          Logger::error(__("Restore process was not aborted because this error is not related to Backup Migration.", 'backup-backup'));
          $this->migration_progress->log(__("There was an error not related to Backup Migration Plugin.", 'backup-backup'), 'warn');
          $this->migration_progress->log(__("Message: ", 'backup-backup') . $errstr, 'warn');
          $this->migration_progress->log(__("Backup will not be aborted because of this.", 'backup-backup'), 'warn');
          return;
        }
        if (strpos($errstr, 'unlink(') !== false) {
          Logger::error(__("Restore process was not aborted due to this error.", 'backup-backup'));
          Logger::error($errstr);
          return;
        }
        if (strpos($errfile, 'pclzip') !== false) {
          Logger::error(__("Restore process was not aborted due to this error.", 'backup-backup'));
          Logger::error($errstr);
          return;
        }
        if (strpos($errstr, 'rename(') !== false) {
          Logger::error(__("Restore process was not aborted due to this error.", 'backup-backup'));
          Logger::error($errstr);
          $this->migration_progress->log(__("Cannot move: ", 'backup-backup') . $errstr, 'warn');
          return;
        }

        $this->migration_progress->log(__("There was an error during restore process:", 'backup-backup'), 'error');
        $this->migration_progress->log(__("Message: ", 'backup-backup') . $errstr, 'error');
        $this->migration_progress->log(__("File/line: ", 'backup-backup') . $errfile . '|' . $errline, 'error');

        if (file_exists(BMI_BACKUPS . DIRECTORY_SEPARATOR . '.migration_lock')) @unlink(BMI_BACKUPS . DIRECTORY_SEPARATOR . '.migration_lock');

        $this->migration_progress->log(__("Aborting restore process...", 'backup-backup'), 'step');

        if (isset($GLOBALS['bmi_current_tmp_restore']) && !empty($GLOBALS['bmi_current_tmp_restore'])) {

          $this->migration_progress->log(__("Cleaning up exported files...", 'backup-backup'), 'step');

          $tmp_unique = $GLOBALS['bmi_current_tmp_restore_unique'];
          $dir = $GLOBALS['bmi_current_tmp_restore'];
          $it = new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS);
          $files = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::CHILD_FIRST);

          $this->migration_progress->log(__('Removing ', 'backup-backup') . iterator_count($files) . __(' files', 'backup-backup'), 'INFO');
          foreach ($files as $file) {
            if ($file->isDir()) {
              @rmdir($file->getRealPath());
            } else {
              @unlink($file->getRealPath());
            }
          }

          @rmdir($dir);

          $config_file = untrailingslashit(ABSPATH) . DIRECTORY_SEPARATOR . 'wp-config.' . $tmp_unique . '.php';
          if (file_exists($config_file)) @unlink($config_file);

        }

        $this->migration_progress->log(__("#002", 'backup-backup'), 'end-code');
        $this->migration_progress->end();

        $GLOBALS['bmi_error_handled'] = true;
        BMP::res(['status' => 'error', 'error' => $errstr]);
        exit;

      }, E_ALL);
    }

    public function backupExceptionHandler() {
      set_exception_handler(function ($exception) {
        $this->zip_progress->log(__("Exception: ", 'backup-backup') . $exception->getMessage(), 'warn');
        Logger::log(__("Exception: ", 'backup-backup') . $exception->getMessage());
      });
    }

    public function resetLatestLogs() {

      // Restore htaccess
      BMP::fixLitespeed();
      BMP::revertLitespeed();

      // Check time if not bugged
      if (file_exists(BMI_BACKUPS . '/.running') && (time() - filemtime(BMI_BACKUPS . '/.running')) > 65) {
        if (file_exists(BMI_BACKUPS . '/.running')) @unlink(BMI_BACKUPS . '/.running');
        if (file_exists(BMI_BACKUPS . '/.abort')) @unlink(BMI_BACKUPS . '/.abort');
      }

      // Check if backup is not in progress
      if (file_exists(BMI_BACKUPS . '/.running')) {
        return ['status' => 'msg', 'why' => __('Backup process already running, please wait till it complete.', 'backup-backup'), 'level' => 'warning'];
      }

      // Require logs
      require_once BMI_INCLUDES . '/progress/zip.php';
      require_once BMI_INCLUDES . '/progress/migration.php';

      // Write initial
      $zip_progress = new Progress('', 0);
      $zip_progress->start();
      $zip_progress->log(__("Initializing backup...", 'backup-backup'), 'step');
      $zip_progress->progress('0/100');
      $zip_progress->end();

      // Write initial
      $migration = new MigrationProgress(false);
      $migration->start();
      $migration->log(__('Initializing restore process', 'backup-backup'), 'STEP');
      $migration->progress('0');
      $migration->end();

      // Return done
      return ['status' => 'success'];
    }

    public function makeBackupName() {
      $name = Dashboard\bmi_get_config('BACKUP:NAME');

      $hash = BMP::randomString(16);
      $name = str_replace('%hash', $hash, $name);
      $name = str_replace('%Y', date('Y'), $name);
      $name = str_replace('%M', date('M'), $name);
      $name = str_replace('%D', date('D'), $name);
      $name = str_replace('%d', date('d'), $name);
      $name = str_replace('%j', date('j'), $name);
      $name = str_replace('%m', date('m'), $name);
      $name = str_replace('%n', date('n'), $name);
      $name = str_replace('%Y', date('Y'), $name);
      $name = str_replace('%y', date('y'), $name);
      $name = str_replace('%a', date('a'), $name);
      $name = str_replace('%A', date('A'), $name);
      $name = str_replace('%B', date('B'), $name);
      $name = str_replace('%g', date('g'), $name);
      $name = str_replace('%G', date('G'), $name);
      $name = str_replace('%h', date('h'), $name);
      $name = str_replace('%H', date('H'), $name);
      $name = str_replace('%i', date('i'), $name);
      $name = str_replace('%s', date('s'), $name);
      $name = str_replace('%s', date('s'), $name);

      $i = 2;
      $tmpname = $name;

      while (file_exists($tmpname . '.zip')) {
        $tmpname = $name . '_' . $i;
        $i++;
      }

      $name = $tmpname . '.zip';

      $GLOBALS['bmi_current_backup_name'] = $name;
      return $name;
    }

    public function fixUnameFunction() {
      $file = trailingslashit(ABSPATH) . 'wp-admin/includes/class-pclzip.php';
      $backup = trailingslashit(ABSPATH) . 'wp-admin/includes/class-pclzip-backup.php';

      // Make backup
      if (!file_exists($backup)) {
        @copy($file, $backup);
      }

      // Replace deprecated php_uname function which is mostly disabled and cause errors
      $replace = file_get_contents($file);
      $replace = str_replace('php_uname()', '(DIRECTORY_SEPARATOR === "/" ? "linux" : "windows")', $replace);
      file_put_contents($file, $replace);
      return ['status' => 'success'];
    }

    public function revertUnameProcess() {
      $file = trailingslashit(ABSPATH) . 'wp-admin/includes/class-pclzip.php';
      $backup = trailingslashit(ABSPATH) . 'wp-admin/includes/class-pclzip-backup.php';
      if (file_exists($backup)) {
        if (file_exists($file)) @unlink($file);
        @copy($backup, $file);
      }
      return ['status' => 'success'];
    }

    public function prepareAndMakeBackup($cron = false) {

      global $wp_version;

      // Require File Scanner
      require_once BMI_INCLUDES . '/progress/zip.php';
      require_once BMI_INCLUDES . '/check/checker.php';

      // CLI Handler
      $cliHandler = trailingslashit(sanitize_text_field(BMI_INCLUDES)) . 'cli-handler.php';

      // Backup name
      if (defined('BMI_CLI_ARGUMENT') && !empty(BMI_CLI_ARGUMENT)) {
        $name = BMI_CLI_ARGUMENT;
      } else {
        $name = $this->makeBackupName();
      }

      // Progress & Logs
      $cliRunning = (defined('BMI_USING_CLI_FUNCTIONALITY') && BMI_USING_CLI_FUNCTIONALITY === true) ? true : false;
      $zip_progress = new Progress($name, 100, 0, $cron, !$cliRunning);
      $zip_progress->start();

      // PHP CLI Check
      $isCLI = false;
      $cli_lock = BMI_BACKUPS . '/.backup_lock_cli';
      $cli_lock_end = BMI_BACKUPS . '/.backup_lock_cli_end';

      if (!defined('BMI_USING_CLI_FUNCTIONALITY') || BMI_USING_CLI_FUNCTIONALITY === false) {

        $cli_result = $this->checkIfPHPCliExist($zip_progress);
        if ($cli_result !== false && BMI_FUNCTION_NORMAL === true) {

          $res = null;
          @exec(BMI_CLI_EXECUTABLE . ' -f "' . $cliHandler . '" bmi_backup ' . $name . ' > /dev/null &', $res);
          $res = implode("\n", $res);

          sleep(3);

          if (file_exists($cli_lock_end) && (time() - filemtime($cli_lock_end)) < 10) {

            if (file_exists($cli_lock_end)) @unlink($cli_lock_end);
            return ['status' => 'success', 'filename' => $name];
            exit;

          }

          if (!file_exists($cli_lock) || (time() - filemtime($cli_lock)) > 10) {

            if (!file_exists(BMI_BACKUPS . '/.abort') || (time() - filemtime(BMI_BACKUPS . '/.abort')) > 10) {

              $zip_progress->log(__("Something went wrong in PHP CLI process, backup will be continued with legacy methods.", 'backup-backup'), 'warn');
              if (file_exists($cli_lock)) @unlink($cli_lock);

            } else {

              $zip_progress->log(__("Backup will not be continued due to manual abort by user.", 'backup-backup'), 'warn');
              if (file_exists($cli_lock)) @unlink($cli_lock);
              return ['status' => 'msg', 'why' => __('Backup process aborted.', 'backup-backup'), 'level' => 'info'];

            }

          } else {

            return ['status' => 'background', 'filename' => $name];

          }

        } else {

          if (BMI_FUNCTION_NORMAL !== true) {
            $zip_progress->log(__("PHP CLI will not run due to user settings in plugin other options.", 'backup-backup'), 'warn');
          } else {
            $zip_progress->log(__("PHP CLI file cannot be executed due to unknown reason.", 'backup-backup'), 'warn');
          }

        }

      } else {

        if (defined('BMI_USING_CLI_FUNCTIONALITY') && BMI_USING_CLI_FUNCTIONALITY === true) {

          $isCLI = true;
          $zip_progress->log(__("Backup via PHP CLI initialized successfully.", 'backup-backup'), 'success');
          touch($cli_lock);

        }

      }

      // Just in case (e.g. syntax error, we can close the file correctly)
      $GLOBALS['bmi_backup_progress'] = $zip_progress;

      // Logs
      $zip_progress->log(__("Initializing backup...", 'backup-backup'), 'step');
      $zip_progress->log((__("Backup & Migration version: ", 'backup-backup') . BMI_VERSION), 'info');
      // $zip_progress->log(__("Site which will be backed up: ", 'backup-backup') . $this->siteURL(), 'info');
      $zip_progress->log(__("Site which will be backed up: ", 'backup-backup') . site_url(), 'info');
      $zip_progress->log(__("PHP Version: ", 'backup-backup') . PHP_VERSION, 'info');
      $zip_progress->log(__("WP Version: ", 'backup-backup') . $wp_version, 'info');
      $zip_progress->log(__("MySQL Version: ", 'backup-backup') . $GLOBALS['wpdb']->db_version(), 'info');
      $zip_progress->log(__("MySQL Max Length: ", 'backup-backup') . $GLOBALS['wpdb']->get_results("SHOW VARIABLES LIKE 'max_allowed_packet';")[0]->Value, 'info');
      if (isset($_SERVER['SERVER_SOFTWARE']) && !empty($_SERVER['SERVER_SOFTWARE'])) {
        $zip_progress->log(__("Web server: ", 'backup-backup') . $_SERVER['SERVER_SOFTWARE'], 'info');
      } else {
        $zip_progress->log(__("Web server: Not available", 'backup-backup'), 'info');
      }
      $zip_progress->log(__("Max execution time (in seconds): ", 'backup-backup') . @ini_get('max_execution_time'), 'info');

      if (defined('BMI_DB_MAX_ROWS_PER_QUERY')) {
        $zip_progress->log(__('Max rows per query (this site): ', 'backup-backup') . BMI_DB_MAX_ROWS_PER_QUERY, 'info');
      }

      $zip_progress->log(__("Checking if backup dir is writable...", 'backup-backup'), 'info');

      if (defined('BMI_BACKUP_PRO')) {
        if (BMI_BACKUP_PRO == 1) {
          $zip_progress->log(__("Premium plugin is enabled and activated", 'backup-backup'), 'info');
        } else {
          $zip_progress->log(__("Premium version is enabled but not active, using free plugin.", 'backup-backup'), 'warn');
        }
      }

      // Error handler
      $zip_progress->log(__("Initializing custom error handler", 'backup-backup'), 'info');
      $this->zip_progress = &$zip_progress;
      $this->backupErrorHandler();
      $this->backupExceptionHandler();

      // Checker
      $checker = new Checker($zip_progress);

      if (!is_writable(dirname(BMI_BACKUPS))) {

        // Abort backup
        $zip_progress->log(__("Backup directory is not writable...", 'backup-backup'), 'error');
        $zip_progress->log(__("Path: ", 'backup-backup') . BMI_BACKUPS, 'error');

        // Close backup
        if (file_exists(BMI_BACKUPS . '/.running')) @unlink(BMI_BACKUPS . '/.running');
        if (file_exists(BMI_BACKUPS . '/.abort')) @unlink(BMI_BACKUPS . '/.abort');
        if ($isCLI === true && file_exists($cli_lock)) @unlink($cli_lock);

        // Log and close log
        $zip_progress->log('#002', 'END-CODE');
        $zip_progress->end();

        if ($isCLI === true) touch($cli_lock_end);
        $this->actionsAfterProcess();

        // Return error
        return ['status' => 'error'];
      } else {
        $zip_progress->log(__("Yup it is writable...", 'backup-backup'), 'success');
      }

      if (!file_exists(BMI_BACKUPS)) @mkdir(BMI_BACKUPS, true);

      // Get file names (huge list mostly)
      if ($fgwp = Dashboard\bmi_get_config('BACKUP:FILES') == 'true') {
        $zip_progress->log(__("Scanning files...", 'backup-backup'), 'step');
        $files = $this->scanFilesForBackup($zip_progress);
        $files = $this->parseFilesForBackup($files, $zip_progress, $cron);
      } else {
        $zip_progress->log(__("Omitting files (due to settings)...", 'backup-backup'), 'warn');
        $files = [];
      }

      // If only database backup
      if (!isset($this->total_size_for_backup)) $this->total_size_for_backup = 0;
      if (!isset($this->total_size_for_backup_in_mb)) $this->total_size_for_backup_in_mb = 0;

      // Check if there is enough space
      $bytes = intval($this->total_size_for_backup * 1.2);
      $zip_progress->log(__("Checking free space, reserving...", 'backup-backup'), 'step');
      if ($this->total_size_for_backup_in_mb >= BMI_REV * 1000) {

        // Abort backup
        $zip_progress->log(__("Aborting backup...", 'backup-backup'), 'step');
        $zip_progress->log(str_replace('%s', BMI_REV, __("Site weights more than %s GB.", 'backup-backup')), 'error');

        // Close backup
        if (file_exists(BMI_BACKUPS . '/.running')) @unlink(BMI_BACKUPS . '/.running');
        if (file_exists(BMI_BACKUPS . '/.abort')) @unlink(BMI_BACKUPS . '/.abort');
        if ($isCLI === true && file_exists($cli_lock)) @unlink($cli_lock);

        // Log and close log
        $zip_progress->log('#100', 'END-CODE');
        $zip_progress->end();

        if ($isCLI === true) touch($cli_lock_end);
        $this->actionsAfterProcess();

        // Return error
        return ['status' => 'error', 'bfs' => true];
      }

      $isSpaceCheckDisabled = Dashboard\bmi_get_config('OTHER:BACKUP:SPACE:CHECKING');

      if ($isSpaceCheckDisabled) {

        $zip_progress->log(__("Free space checking is disabled by user in settings...", 'backup-backup'), 'warn');
        $zip_progress->log(__("Backup will continue, trusting there is enough space...", 'backup-backup'), 'warn');

      } else {

        if (!$checker->check_free_space($bytes)) {

          // Abort backup
          $zip_progress->log(__("Aborting backup...", 'backup-backup'), 'step');
          $zip_progress->log(__("There is no space for that backup, checked: ", 'backup-backup') . ($bytes) . __(" bytes", 'backup-backup'), 'error');

          // Close backup
          if (file_exists(BMI_BACKUPS . '/.running')) @unlink(BMI_BACKUPS . '/.running');
          if (file_exists(BMI_BACKUPS . '/.abort')) @unlink(BMI_BACKUPS . '/.abort');
          if ($isCLI === true && file_exists($cli_lock)) @unlink($cli_lock);

          // Log and close log
          $zip_progress->log('#002', 'END-CODE');
          $zip_progress->end();

          if ($isCLI === true) touch($cli_lock_end);
          $this->actionsAfterProcess();

          // Return error
          return ['status' => 'error'];
        } else {
          $zip_progress->log(__("Confirmed, there is more than enough space, checked: ", 'backup-backup') . ($bytes) . __(" bytes", 'backup-backup'), 'success');
          $zip_progress->bytes = $this->total_size_for_backup;
        }

      }

      if (Dashboard\bmi_get_config('BACKUP:DATABASE') != 'true') {

        // $zip_progress->log(__("Database won't be backed-up due to user settings, omitting...", 'backup-backup'), 'info');
        // Commented as message will be shown in database backup module

      }

      // Log and set files length
      $zip_progress->log(__("Scanning done - found ", 'backup-backup') . sizeof($files) . __(" files...", 'backup-backup'), 'info');
      $zip_progress->files = sizeof($files);

      // Make Backup
      $zip_progress->log(__("Backup initialized...", 'backup-backup'), 'success');
      $zip_progress->log(__("Initializing archiving system...", 'backup-backup'), 'step');

      return $this->createBackup($files, ABSPATH, $name, $zip_progress, $cron, $isCLI);
    }

    public function fixLitespeed() {
      BMP::fixLitespeed();

      return ['status' => 'success'];
    }

    public function revertLitespeed() {
      BMP::revertLitespeed();

      return ['status' => 'success'];
    }

    public function createBackup($files, $base, $name, &$zip_progress, $cron = false, $isCLI = false) {

      // Require File Zipper
      require_once BMI_INCLUDES . '/zipper/zipping.php';

      // CLI locks
      $cli_lock = BMI_BACKUPS . '/.backup_lock_cli';
      $cli_lock_end = BMI_BACKUPS . '/.backup_lock_cli_end';

      // Backup name
      $backup_path = BMI_BACKUPS . '/' . $name;

      // Check time if not bugged
      if (file_exists(BMI_BACKUPS . '/.running') && (time() - filemtime(BMI_BACKUPS . '/.running')) > 65) {
        if (file_exists(BMI_BACKUPS . '/.running')) @unlink(BMI_BACKUPS . '/.running');
        if (file_exists(BMI_BACKUPS . '/.abort')) @unlink(BMI_BACKUPS . '/.abort');
        if ($isCLI === true && file_exists($cli_lock)) @unlink($cli_lock);
        if ($isCLI === true && file_exists($cli_lock_end)) @unlink($cli_lock_end);
      }

      // Mark as in progress
      if (!file_exists(BMI_BACKUPS . '/.running')) {
        touch(BMI_BACKUPS . '/.running');
        if ($isCLI === true) touch($cli_lock);
      } else {
        return ['status' => 'msg', 'why' => __('Backup process already running, please wait till it complete.', 'backup-backup'), 'level' => 'warning'];
      }

      // Initialized
      $zip_progress->log(__("Archive system initialized...", 'backup-backup'), 'success');

      // Make ZIP
      $zipper = new Zipper();
      $zippy = $zipper->makeZIP($files, $backup_path, $name, $zip_progress, $cron);
      if (!$zippy) {

        // Make sure it's open
        $zip_progress->start();

        // Abort backup
        $zip_progress->log(__("Aborting backup...", 'backup-backup'), 'step');

        // Close backup
        if (file_exists(BMI_BACKUPS . '/.running')) @unlink(BMI_BACKUPS . '/.running');
        if (file_exists(BMI_BACKUPS . '/.abort')) @unlink(BMI_BACKUPS . '/.abort');
        if ($isCLI === true && file_exists($cli_lock)) @unlink($cli_lock);

        // Log and close log
        $zip_progress->log('#002', 'END-CODE');
        $zip_progress->end();

        if ($isCLI === true) touch($cli_lock_end);

        // Return error
        if (file_exists($backup_path)) @unlink($backup_path);

        $this->actionsAfterProcess();
        return ['status' => 'error'];
      }

      // Backup aborted
      if (file_exists(BMI_BACKUPS . '/.abort')) {

        // Make sure it's open
        $zip_progress->start();

        if (file_exists($backup_path)) @unlink($backup_path);
        if (file_exists(BMI_BACKUPS . '/.running')) @unlink(BMI_BACKUPS . '/.running');
        if (file_exists(BMI_BACKUPS . '/.abort')) @unlink(BMI_BACKUPS . '/.abort');
        if ($isCLI === true && file_exists($cli_lock)) @unlink($cli_lock);

        // Log and close log
        $zip_progress->log(__("Backup process aborted.", 'backup-backup'), 'warn');
        $zip_progress->log('#002', 'END-CODE');
        $zip_progress->end();

        if ($isCLI === true) touch($cli_lock_end);
        Logger::log(__("Backup process aborted.", 'backup-backup'));

        $this->actionsAfterProcess();
        return ['status' => 'msg', 'why' => __('Backup process aborted.', 'backup-backup'), 'level' => 'info'];
      }

      if (!file_exists($backup_path)) {

        // Make sure it's open
        $zip_progress->start();

        // Abort backup
        $zip_progress->log(__("Aborting backup...", 'backup-backup'), 'step');
        $zip_progress->log(__("There is no backup file...", 'backup-backup'), 'error');
        $zip_progress->log(__("We could not find backup file when it already should be here.", 'backup-backup'), 'error');
        $zip_progress->log(__("This error may be related to missing space. (filled during backup)", 'backup-backup'), 'error');
        $zip_progress->log(__("Path: ", 'backup-backup') . $backup_path, 'error');

        // Close backup
        if (file_exists(BMI_BACKUPS . '/.running')) @unlink(BMI_BACKUPS . '/.running');
        if (file_exists(BMI_BACKUPS . '/.abort')) @unlink(BMI_BACKUPS . '/.abort');
        if ($isCLI === true && file_exists($cli_lock)) @unlink($cli_lock);

        // Log and close log
        $zip_progress->log('#002', 'END-CODE');
        $zip_progress->end();

        if ($isCLI === true) touch($cli_lock_end);
        $this->actionsAfterProcess();

        // Return error
        return ['status' => 'error'];
      }

      // End zip log
      $zip_progress->log(__("New backup created and its name is: ", 'backup-backup') . $name, 'success');
      $zip_progress->log('#001', 'END-CODE');
      $zip_progress->end();

      if ($isCLI === true) touch($cli_lock_end);

      // Unlink progress
      if (file_exists(BMI_BACKUPS . '/.running')) @unlink(BMI_BACKUPS . '/.running');
      if (file_exists(BMI_BACKUPS . '/.abort')) @unlink(BMI_BACKUPS . '/.abort');
      if ($isCLI === true && file_exists($cli_lock)) @unlink($cli_lock);

      // Return
      Logger::log(__("New backup created and its name is: ", 'backup-backup') . $name);

      $GLOBALS['bmi_error_handled'] = true;

      $this->actionsAfterProcess(true);
      return ['status' => 'success', 'filename' => $name, 'root' => plugin_dir_url(BMI_ROOT_FILE)];

    }

    public function continueRestoreProcess() {

      // BMI_RESTORE_SECRET

    }

    public function getBackupsList() {

      // Require File Scanner
      require_once BMI_INCLUDES . '/scanner/backups.php';

      // Get backups
      $backups = new Backups();
      $manifests = $backups->getAvailableBackups();

      // Return files
      return ['status' => 'success', 'backups' => $manifests];
    }

    public function sendTestMail() {

      $email = Dashboard\bmi_get_config('OTHER:EMAIL') != false ? Dashboard\bmi_get_config('OTHER:EMAIL') : get_bloginfo('admin_email');
      $subject = __('Backup Migration – Example email', 'backup-backup');
      $message = __('This is a test email sent by the Backup Migration plugin via Troubleshooting options!', 'backup-backup');

      try {

        if (wp_mail($email, $subject, $message)) return [ 'status' => 'success' ];
        else return ['status' => 'error'];

      } catch (\Exception $e) {

        return ['status' => 'error'];

      } catch (\Throwable $e) {

        return ['status' => 'error'];

      }

    }

    public function restoreBackup() {

      global $wp_version;

      // Require File Scanner
      require_once BMI_INCLUDES . '/zipper/zipping.php';
      require_once BMI_INCLUDES . '/extracter/extract.php';
      require_once BMI_INCLUDES . '/progress/migration.php';
      require_once BMI_INCLUDES . '/check/checker.php';

      // Make AutoLogin possible
      $ip = '127.0.0.1';
      if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
      } else {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        if ($ip === false) {
          if (isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
        }
      }
      $autoLoginMD = time() . '_' . $ip . '_' . '4u70L051n';

      // Progress & lock file
      $lock = BMI_BACKUPS . '/.migration_lock';
      $lock_cli = BMI_BACKUPS . '/.migration_lock_cli';
      $autologin_file = BMI_BACKUPS . '/.autologin';
      $lock_cli_end = BMI_BACKUPS . '/.migration_lock_ended';
      $progress = BMI_BACKUPS . '/latest_migration_progress.log';
      $cli_last_download = BMI_BACKUPS . '/.cli_download_last';

      $ignoreRunCheck = ((isset($this->post['ignoreRunning']) && $this->post['ignoreRunning'] == 'true') ? true : false);
      $isCLIRunning = (defined('BMI_USING_CLI_FUNCTIONALITY') && BMI_USING_CLI_FUNCTIONALITY === true) ? true : false;
      if ($isCLIRunning) $ignoreRunCheck = false;

      if (file_exists($lock) && (time() - filemtime($lock)) < 65 && !$ignoreRunCheck) {
        return ['status' => 'msg', 'why' => __('The restore process is currently running, please wait till it end or once the lock file expire.', 'backup-backup'), 'level' => 'warning'];
      }

      // Check if download was via CLI
      if ($this->post['file'] == '.cli_download' && file_exists($cli_last_download)) {
        $this->post['file'] = file_get_contents($cli_last_download);
        if (file_exists($cli_last_download)) @unlink($cli_last_download);
      }

      // Logs
      $migration = new MigrationProgress($this->post['remote']);
      $migration->start();

      if ($ignoreRunCheck) {

        $migration->mute();

      }

      // Check PHP CLI
      if ((!defined('BMI_USING_CLI_FUNCTIONALITY') || BMI_USING_CLI_FUNCTIONALITY === false) && (!defined('BMI_CLI_REQUEST') || BMI_CLI_REQUEST === false)) {

        $cli_result = $this->checkIfPHPCliExist($migration);

        if ($cli_result !== false) {

          $cliHandler = trailingslashit(sanitize_text_field(BMI_INCLUDES)) . 'cli-handler.php';
          $backupName = sanitize_text_field($this->post['file']);
          $remoteType = 'false';
          if ($this->post['remote'] == 'true' || $this->post['remote'] === true) $remoteType = 'true';
          if (file_exists($lock_cli_end)) @unlink($lock_cli_end);

          $res = null;
          @exec(BMI_CLI_EXECUTABLE . ' -f "' . $cliHandler . '" bmi_restore ' . $backupName . ' ' . $remoteType . ' > /dev/null &', $res);
          $res = implode("\n", $res);

          sleep(3);

          if (file_exists($lock_cli_end) && (time() - filemtime($lock_cli_end)) < 10) {

            // Put autologin
            file_put_contents($autologin_file, $autoLoginMD);
            touch($autologin_file);

            return ['status' => 'cli', 'login' => explode('_', $autoLoginMD)[0], 'url' => site_url()];
            exit;

          }

          if (!file_exists($lock_cli) || (time() - filemtime($lock_cli)) > 10) {

            $progressFile = null;
            $migration->log(__('No response from PHP CLI - plugin will try to recover the migration with traditional restore.', 'backup-backup'), 'warn');
            if (file_exists($lock_cli)) @unlink($lock_cli);

          } else {

            $progressFile = null;

            // $migration->log(__('PHP CLI responded with correct code - we will continue via PHP CLI.', 'backup-backup'), 'info');
            // $migration->end();

            // Put autologin
            file_put_contents($autologin_file, $autoLoginMD);
            touch($autologin_file);

            return ['status' => 'cli', 'login' => explode('_', $autoLoginMD)[0], 'url' => site_url()];
            exit;

          }

        } else {

          if (file_exists($lock_cli)) @unlink($lock_cli);

        }

      } else {

        if (defined('BMI_USING_CLI_FUNCTIONALITY') && BMI_USING_CLI_FUNCTIONALITY === true) {
          $migration->log(__('PHP CLI: Restore process initialized, restoring...', 'backup-backup'), 'success');
          touch($lock_cli);
        } else {
          $migration->log(__('Restore process initialized, restoring (non-cli mode)...', 'backup-backup'), 'success');
        }

      }

      // Just in case (e.g. syntax error, we can close the file correctly)
      $GLOBALS['bmi_migration_progress'] = $migration;

      // Checker
      $checker = new Checker($migration);
      $zipper = new Zipper();

      // Handle remote
      if ($this->post['file']) {
        $migration->log(__('Restore process responded', 'backup-backup'), 'SUCCESS');
      }

      // Make lock file
      $migration->log(__('Locking migration process', 'backup-backup'), 'SUCCESS');
      touch($lock);

      // Initializing
      $migration->log(__('Initializing restore process', 'backup-backup'), 'STEP');
      $migration->log((__("Backup & Migration version: ", 'backup-backup') . BMI_VERSION), 'info');

      // Error handler
      $migration->log(__("Initializing custom error handler", 'backup-backup'), 'info');

      // Error handler
      $this->migration_progress = &$migration;
      $this->migrationErrorHandler();
      $this->migrationExceptionHandler();

      // $migration->log(__("Site which will be restored: ", 'backup-backup') . $this->siteURL(), 'info');
      $migration->log(__("Site which will be restored: ", 'backup-backup') . site_url(), 'info');
      $migration->log(__("PHP Version: ", 'backup-backup') . PHP_VERSION, 'info');
      $migration->log(__("WP Version: ", 'backup-backup') . $wp_version, 'info');
      $migration->log(__("MySQL Version: ", 'backup-backup') . $GLOBALS['wpdb']->db_version(), 'info');
      $migration->log(__("MySQL Max Length: ", 'backup-backup') . $GLOBALS['wpdb']->get_results("SHOW VARIABLES LIKE 'max_allowed_packet';")[0]->Value, 'info');
      if (isset($_SERVER['SERVER_SOFTWARE']) && !defined('BMI_USING_CLI_FUNCTIONALITY')) {
        $migration->log(__("Web server: ", 'backup-backup') . $_SERVER['SERVER_SOFTWARE'], 'info');
      } else {
        $migration->log(__("Web server: Not available", 'backup-backup'), 'info');
      }
      $migration->log(__("Max execution time (in seconds): ", 'backup-backup') . @ini_get('max_execution_time'), 'info');

      if (defined('BMI_BACKUP_PRO')) {
        if (BMI_BACKUP_PRO == 1) {
          $migration->log(__("Premium plugin is enabled and activated", 'backup-backup'), 'info');
        } else {
          $migration->log(__("Premium version is enabled but not active, using free plugin.", 'backup-backup'), 'warn');
        }
      }

      $migration->log(__("Restore process initialized successfully.", 'backup-backup'), 'success');

      // Check file size
      $zippath = BMP::fixSlashes(BMI_BACKUPS) . DIRECTORY_SEPARATOR . $this->post['file'];
      if (!$ignoreRunCheck) {

        $manifest = $zipper->getZipFileContent($zippath, 'bmi_backup_manifest.json');
        $migration->log(__('Free space checking...', 'backup-backup'), 'STEP');
        $migration->log(__('Checking if there is enough amount of free space', 'backup-backup'), 'INFO');
        if ($manifest) {
          if (isset($manifest->bytes) && $manifest->bytes) {
            $bytes = intval($manifest->bytes * 1.2);
            if (!$checker->check_free_space($bytes)) {
              $migration->log(__('Cannot start migration process', 'backup-backup'), 'ERROR');
              $migration->log(__('Error: There is not enough space on the server, checked: ' . ($bytes) . ' bytes.', 'backup-backup'), 'ERROR');
              $migration->log(__('Aborting...', 'backup-backup'), 'ERROR');
              $migration->log(__('Unlocking migration', 'backup-backup'), 'INFO');

              if (file_exists($lock)) @unlink($lock);
              $migration->log('#004', 'END-CODE');
              $migration->end();

              if ($isCLIRunning == true) touch($lock_cli_end);
              $this->actionsAfterProcess(false, 'migration');

              return ['status' => 'error'];
            } else {
              $migration->log(__('Confirmed, there is enough space on the device, checked: ' . ($bytes) . ' bytes.', 'backup-backup'), 'SUCCESS');
            }
          }
        } else {
          $migration->log(__('Cannot start migration process', 'backup-backup'), 'ERROR');
          $migration->log(__('Error: Could not find manifest in backup, file may be broken', 'backup-backup'), 'ERROR');
          $migration->log(__('Error: Btw. because of this I also cannot check free space', 'backup-backup'), 'ERROR');
          $migration->log(__('Aborting...', 'backup-backup'), 'ERROR');
          $migration->log(__('Unlocking migration', 'backup-backup'), 'INFO');

          if (file_exists($lock)) @unlink($lock);
          $migration->log('#003', 'END-CODE');
          $migration->end();

          if ($isCLIRunning == true) touch($lock_cli_end);
          $this->actionsAfterProcess(false, 'migration');

          return ['status' => 'error'];
        }

      }

      if ($ignoreRunCheck) {

        $migration->unmute();

      }

      // New extracter
      $theTmpName = ((isset($this->post['tmpname'])) ? $this->post['tmpname'] : false);
      $options = ((isset($this->post['options'])) ? $this->post['options'] : []);
      $extracter = new Extracter($this->post['file'], $migration, $theTmpName, $isCLIRunning, $options);

      // Extract
      $theSecret = ((isset($this->post['secret'])) ? $this->post['secret'] : null);
      $isFine = $extracter->extractTo($theSecret);
      if (!$isFine) {
        $migration->log(__('Aborting...', 'backup-backup'), 'ERROR');
        $migration->log(__('Unlocking migration', 'backup-backup'), 'INFO');

        if (file_exists($lock)) @unlink($lock);
        $migration->log('#002', 'END-CODE');
        $migration->end();

        if ($isCLIRunning == true) touch($lock_cli_end);
        $this->actionsAfterProcess(false, 'migration');

        return ['status' => 'error'];
      }

      $migration->progress('100');
      $migration->log(__('Restore process completed', 'backup-backup'), 'SUCCESS');
      $migration->log(__('Finalizing restored files', 'backup-backup'), 'STEP');
      $migration->log(__('Unlocking migration', 'backup-backup'), 'INFO');
      if (file_exists($lock)) @unlink($lock);

      $migration->log('#001', 'END-CODE');
      $migration->end();

      if ($isCLIRunning == true) touch($lock_cli_end);

      // Put autologin
      file_put_contents($autologin_file, $autoLoginMD);
      touch($autologin_file);

      $this->actionsAfterProcess(true, 'migration');
      return ['status' => 'success', 'login' => explode('_', $autoLoginMD)[0], 'url' => site_url()];
    }

    public function isRunningBackup() {
      $this->lock_cli = BMI_BACKUPS . '/.backup_cli_lock';

      // Backup CLI running
      if (file_exists($this->lock_cli) && (time() - filemtime($this->lock_cli)) <= 3600) {
        return ['status' => 'msg', 'why' => __('Backup process already running, please wait till it complete.', 'backup-backup'), 'level' => 'warning'];
      }

      if (file_exists(BMI_BACKUPS . '/.running') && (time() - filemtime(BMI_BACKUPS . '/.running')) <= 65) {
        return ['status' => 'msg', 'why' => __('Backup process already running, please wait till it complete.', 'backup-backup'), 'level' => 'warning'];
      } else {
        return ['status' => 'success'];
      }
    }

    public function stopBackup() {
      if (!file_exists(BMI_BACKUPS . '/.running')) {
        return ['status' => 'msg', 'why' => __('Backup process completed or is not running.', 'backup-backup'), 'level' => 'info'];
      } else {
        if (!file_exists(BMI_BACKUPS . '/.abort')) {
          touch(BMI_BACKUPS . '/.abort');
        }

        return ['status' => 'success'];
      }
    }

    public function isMigrationLocked() {
      $lock = BMI_BACKUPS . '/.migration_lock';
      $lock_cli = BMI_BACKUPS . '/.migration_lock_cli';
      $lock_cli_end = BMI_BACKUPS . '/.migration_lock_ended';

      if ((file_exists($lock) && (time() - filemtime($lock)) < 65) || (file_exists($lock_cli) && (time() - filemtime($lock_cli)) < 7200)) {

        return ['status' => 'msg', 'why' => __('Restore process is currently running, please wait till it complete.', 'backup-backup'), 'level' => 'warning'];

      } else {

        require_once BMI_INCLUDES . '/progress/migration.php';
        $progress = BMI_BACKUPS . '/latest_migration_progress.log';
        $shouldClearLogs = true;

        if (isset($this->post['clearLogs']) && $this->post['clearLogs'] == 'false') {
          $shouldClearLogs = false;
        }

        if ($shouldClearLogs === true) {
          if (file_exists($lock_cli_end) && (time() - filemtime($lock_cli_end)) > 10) {

            $migration = new MigrationProgress();
            $migration->start();
            $migration->log(__('Initializing restore process...', 'backup-backup'), 'STEP');
            $migration->end();

            file_put_contents($progress, '0');

          }
        }

        return ['status' => 'success'];

      }
    }

    public function downloadFile($url, $dest, $progress, $lock) {
      $current_percentage = 0;
      $fp = fopen($dest, 'w+');

      $progressfile = $progress;
      $lockfile = $lock;

      $ch = curl_init(str_replace(' ', '%20', $url));
      curl_setopt($ch, CURLOPT_TIMEOUT, 0);

      curl_setopt($ch, CURLOPT_FILE, $fp);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

      curl_setopt($ch, CURLOPT_NOPROGRESS, false);
      curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, function ($resource, $download_size, $downloaded) use (&$current_percentage, &$lockfile, &$progressfile) {
        if ($download_size > 0) {
          $new_percentage = intval(($downloaded / $download_size) * 100);

          if (intval($current_percentage) != intval($new_percentage)) {
            $current_percentage = $new_percentage;
            file_put_contents($progressfile, $current_percentage);
            touch($lockfile);
          }
        }
      });

      curl_exec($ch);
      $this->lastCurlCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      $error_msg = false;
      if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
      }

      curl_close($ch);
      fclose($fp);

      if ($error_msg) {
        return $error_msg;
      } else {
        return false;
      }
    }

    public function handleQuickMigration() {
      $lock = BMI_BACKUPS . '/.migration_lock';
      if (file_exists($lock) && (time() - filemtime($lock)) < 65) {
        return ['status' => 'msg', 'why' => __('Download process is currently running, please wait till it complete.', 'backup-backup'), 'level' => 'warning'];
      }

      require_once BMI_INCLUDES . '/progress/migration.php';
      require_once BMI_INCLUDES . '/zipper/zipping.php';

      $migration = new MigrationProgress(true);
      $migration->start();

      $tmp_name = 'backup_' . time() . '.zip';

      if (defined('BMI_USING_CLI_FUNCTIONALITY') && BMI_USING_CLI_FUNCTIONALITY === true && defined('BMI_CLI_ARGUMENT')) {
        $url = BMI_CLI_ARGUMENT;
      } else {
        $url = $this->post['url'];
      }

      $dest = BMI_BACKUPS . '/' . $tmp_name;
      $progress = BMI_BACKUPS . '/latest_migration_progress.log';
      $cli_lock = BMI_BACKUPS . '/.cli_download_lock';

      if (!defined('BMI_USING_CLI_FUNCTIONALITY') || BMI_USING_CLI_FUNCTIONALITY === false) {

        $cli_result = $this->checkIfPHPCliExist($migration);
        if ($cli_result !== false) {

          $cliHandler = trailingslashit(sanitize_text_field(BMI_INCLUDES)) . 'cli-handler.php';

          $res = null;
          @exec(BMI_CLI_EXECUTABLE . ' -f "' . $cliHandler . '" bmi_quick_migration "' . $url . '" > /dev/null &', $res);
          $res = implode("\n", $res);

          sleep(2);
          if (file_exists($cli_lock) && (time() - filemtime($cli_lock)) < 10) {

            if (file_exists($cli_lock)) @unlink($cli_lock);
            return [ 'status' => 'cli_download' ];
            exit;

          }

        }

      } else {

        $migration->log(__('Downloading via PHP CLI', 'backup-backup'));
        touch($cli_lock);

      }

      $migration->log(__('Creating lock file', 'backup-backup'));
      file_put_contents($lock, '');
      $migration->log(__('Initializing download process', 'backup-backup'), 'STEP');
      $downstart = microtime(true);
      $migration->log(__('Downloading initialized', 'backup-backup'), 'SUCCESS');
      $migration->log(__('Downloading remote file...', 'backup-backup'), 'STEP');
      $fileError = $this->downloadFile($url, $dest, $progress, $lock);
      $migration->log(__('Unlocking migration', 'backup-backup'), 'INFO');
      if (file_exists($lock)) @unlink($lock);

      if ($fileError) {
        $migration->log(__('Removing downloaded file', 'backup-backup'), 'INFO');
        if (file_exists($dest)) @unlink($dest);
        $migration->log(__('Download error', 'backup-backup'), 'ERROR');

        if (strpos($fileError, 'Failed writing body') !== false) {
          $migration->log(__('Error: There is not enough space on the server', 'backup-backup'), 'ERROR');
        } else {
          $migration->log(__('Error', 'backup-backup') . ': ' . $fileError, 'ERROR');
        }

        $migration->log('#002', 'END-CODE');
        return ['status' => 'error'];
      } else {
        $migration->log(__('Download completed (took: ', 'backup-backup') . (microtime(true) - $downstart) . 's)', 'SUCCESS');
        $migration->log(__('Looking for backup manifest', 'backup-backup'), 'STEP');
        $zipper = new Zipper();
        $content = $zipper->getZipFileContent($dest, 'bmi_backup_manifest.json');
        if ($content) {
          try {
            $i = 1;
            $name = $content->name;
            $prepared_name = $name;
            $migration->log(__('Manifest found remote name: ', 'backup-backup') . $name, 'SUCCESS');

            while (file_exists(BMI_BACKUPS . '/' . $prepared_name)) {
              $prepared_name = substr($name, 0, -4) . '_' . $i . '.zip';
              $i++;
            }

            rename($dest, BMI_BACKUPS . '/' . $prepared_name);
            $migration->log(__('Requesting restore process', 'backup-backup'), 'STEP');
            $migration->progress(0);
            file_put_contents(BMI_BACKUPS . '/' . '.cli_download_last', $prepared_name);

            $migration->log('#205', 'END-CODE');
            return ['status' => 'success', 'name' => $prepared_name];
          } catch (\Exception $e) {
            $migration->log(__('Error: ', 'backup-backup') . $e, 'ERROR');
            $migration->log(__('Removing downloaded file', 'backup-backup'), 'ERROR');
            if (file_exists($dest)) @unlink($dest);

            $migration->log('#002', 'END-CODE');
            return ['status' => 'error'];
          } catch (\Throwable $e) {
            $migration->log(__('Error: ', 'backup-backup') . $e, 'ERROR');
            $migration->log(__('Removing downloaded file', 'backup-backup'), 'ERROR');
            if (file_exists($dest)) @unlink($dest);

            $migration->log('#002', 'END-CODE');
            return ['status' => 'error'];

          }

        } else {

          // $migration->log(__('Error during manifest check: ', 'backup-backup') . print_r($content, true), 'ERROR');
          if ($this->lastCurlCode == '403') {
            $migration->log(__('Backup is not available to download (Error 403).', 'backup-backup'), 'ERROR');
            $migration->log(__('It is restricted by remote server configuration.', 'backup-backup'), 'ERROR');
          } elseif ($this->lastCurlCode == '423') {
            $migration->log(__('Backup is locked on remote site, please unlock remote downloading.', 'backup-backup'), 'ERROR');
            $migration->log(__('You can find the setting in "Where shall the backup(s) be stored?" section.', 'backup-backup'), 'ERROR');
          } elseif ($this->lastCurlCode == '200' || $this->lastCurlCode == '404') {
            $migration->log(__('Backup does not exist under provided URL.', 'backup-backup'), 'ERROR');
            $migration->log(__('Please confirm that you can download the backup file via provided URL.', 'backup-backup'), 'ERROR');
            $migration->log(__('...or the manifest file does not exist in the backup.', 'backup-backup'), 'ERROR');
            $migration->log(__('Missing manifest means that the backup is probably invalid.', 'backup-backup'), 'ERROR');
          } else {
            $migration->log(__('Manifest file does not exist', 'backup-backup'), 'ERROR');
            $migration->log(__('Downloaded backup may be incomplete (missing manifest)', 'backup-backup'), 'ERROR');
            $migration->log(__('...or provided URL is not a direct download of ZIP file.', 'backup-backup'), 'ERROR');
            $migration->log(__('Removing downloaded file', 'backup-backup'), 'ERROR');
          }

          if (file_exists($dest)) @unlink($dest);

          $migration->log('#002', 'END-CODE');
          return ['status' => 'error'];

        }
      }
    }

    public function handleChunkUpload() {
      require_once BMI_INCLUDES . '/uploader/chunks.php';
    }

    public function removeBackupFile() {
      $files = $this->post['filenames'];

      try {
        if (is_array($files)) {
          for ($i = 0; $i < sizeof($files); $i++) {
            $file = $files[$i];
            $file = preg_replace('/\.\./', '', $file);
            if (file_exists(BMI_BACKUPS . '/' . $file)) {
              unlink(BMI_BACKUPS . '/' . $file);
            }
          }
        }
      } catch (\Exception $e) {
        return ['status' => 'error', 'e' => $e];
      } catch (\Throwable $e) {
        return ['status' => 'error', 'e' => $e];
      }

      return ['status' => 'success'];
    }

    public function saveStorageConfig() {
      $dir_path = $this->post['directory']; // STORAGE::LOCAL::PATH
      $accessible = $this->post['access']; // STORAGE::DIRECT::URL
      $curr_path = Dashboard\bmi_get_config('STORAGE::LOCAL::PATH');

      $error = 0;
      $created = false;

      if (!file_exists($dir_path)) {
        $created = true;
        @mkdir($dir_path, 0755, true);
      }

      if (is_writable($dir_path)) {
        if (!Dashboard\bmi_set_config('STORAGE::DIRECT::URL', $accessible)) {
          $error++;
        }
        if (!Dashboard\bmi_set_config('STORAGE::LOCAL::PATH', esc_attr($dir_path))) {
          $error++;
        } else {
          $cur_dir = BMP::fixSlashes($curr_path . DIRECTORY_SEPARATOR . 'backups');
          $new_dir = BMP::fixSlashes($dir_path . DIRECTORY_SEPARATOR . 'backups');

          if ($cur_dir != $new_dir) {
            $scanned_directory = array_diff(scandir($cur_dir), ['..', '.']);
            if (!file_exists($new_dir)) {
              @mkdir($new_dir, 0755, true);
            }
            foreach ($scanned_directory as $i => $file) {
              rename($cur_dir . DIRECTORY_SEPARATOR . $file, $new_dir . DIRECTORY_SEPARATOR . $file);
            }

            @rmdir($cur_dir);
            @rmdir(dirname($cur_dir));

            if (is_dir($curr_path) && file_exists($curr_path)) {
              $left_files = array_diff(scandir($curr_path), ['..', '.']);
              if (sizeof($left_files) == 0) {
                @rmdir($curr_path);
              }
            }
          }
        }
      } else {
        if ($created === true) {
          if (file_exists($dir_path)) @unlink($dir_path);
        }

        return ['status' => 'msg', 'why' => __('Entered path is not writable, cannot be used.', 'backup-backup'), 'level' => 'warning'];
      }

      return ['status' => 'success', 'errors' => $error];
    }

    public function saveOtherOptions() {

      // Errors
      $invalid_email = __('Provided email addess is not valid.', 'backup-backup');
      $title_long = __('Your email title is too long, please change the title (max 64 chars).', 'backup-backup');
      $title_short = __('Your email title is too short, please use longer one (at least 3 chars).', 'backup-backup');
      $title_empty = __('Title field is required, please fill it.', 'backup-backup');
      $email_empty = __('Email field cannot be empty, please fill it.', 'backup-backup');
      $cli_no_exist = __('Path to executable that you provided for PHP CLI does not exist.', 'backup-backup');
      $db_query_too_low = __('The value for query amount cannot be smaller than 15.', 'backup-backup');
      $db_query_too_much = __('The value for query amount cannot be larger than 15000.', 'backup-backup');
      $db_sr_max_too_much = __('The value for search replace max page cannot be smaller than 10.', 'backup-backup');
      $db_sr_max_too_low = __('The value for search replace max page cannot be larger than 30000.', 'backup-backup');

      $email = sanitize_email(trim($this->post['email'])); // OTHER:EMAIL
      $email_title = sanitize_text_field(trim($this->post['email_title'])); // OTHER:EMAIL:TITLE
      $schedule_issues = $this->post['schedule_issues'] === 'true' ? true : false; // OTHER:EMAIL:NOTIS
      $experiment_timeout = $this->post['experiment_timeout'] === 'true' ? true : false; // OTHER:EXPERIMENT:TIMEOUT
      $experiment_timeout_hard = $this->post['experimental_hard_timeout'] === 'true' ? true : false; // OTHER:EXPERIMENT:TIMEOUT:HARD
      $php_cli_manual_path = isset($this->post['php_cli_manual_path']) ? trim($this->post['php_cli_manual_path']) : ''; // OTHER:CLI:PATH
      $php_cli_disable_others = $this->post['php_cli_disable_others'] === 'true' ? true : false; // OTHER:CLI:DISABLE
      $normal_timeout = $this->post['normal_timeout'] === 'true' ? true : false; // OTHER:USE:TIMEOUT:NORMAL
      $insecure_download = $this->post['download_technique'] === 'true' ? true : false; // OTHER:DOWNLOAD:DIRECT
      $db_query_size = isset($this->post['db_queries_amount']) ? trim($this->post['db_queries_amount']) : '2000'; // OTHER:DB:QUERIES
      $db_search_replace_max = isset($this->post['db_search_replace_max']) ? trim($this->post['db_search_replace_max']) : '300'; // OTHER:DB:SEARCHREPLACE:MAX
      $db_restore_splitting = $this->post['bmi-restore-splitting'] === 'true' ? true : false; // OTHER:RESTORE:SPLITTING
      $db_restore_v3_engine = $this->post['bmi-db-v3-restore-engine'] === 'true' ? true : false; // OTHER:RESTORE:DB:V3

      $no_assets_b4_restore = $this->post['remove-assets-before-restore'] === 'true' ? true : false; // OTHER:RESTORE:BEFORE:CLEANUP
      $single_file_db_force = $this->post['bmi-db-single-file-backup'] === 'true' ? true : false; // OTHER:BACKUP:DB:SINGLE:FILE
      $db_batching_backup = $this->post['bmi-db-batching-backup'] === 'true' ? true : false; // OTHER:BACKUP:DB:BATCHING

      $bmi_disable_space_check = $this->post['bmi-disable-space-check-function'] === 'true' ? true : false; // OTHER:BACKUP:SPACE:CHECKING

      $uninstall_config = $this->post['uninstall_config'] === 'true' ? true : false; // OTHER:UNINSTALL:CONFIGS
      $uninstall_backups = $this->post['uninstall_backups'] === 'true' ? true : false; // OTHER:UNINSTALL:BACKUPS

      if ($experiment_timeout_hard === true) {
        $experiment_timeout = false;
      }

      if ($normal_timeout === true) {
        $experiment_timeout = false;
        $experiment_timeout_hard = false;
      }

      if (!is_numeric($db_query_size) || empty($db_query_size)) {
        $db_query_size = "2000";
      }

      if (!is_numeric($db_search_replace_max) || empty($db_search_replace_max)) {
        $db_search_replace_max = "300";
      }

      if (strlen($email) <= 0) {
        return ['status' => 'msg', 'why' => $email_empty, 'level' => 'warning'];
      }
      if (strlen($email_title) <= 0) {
        return ['status' => 'msg', 'why' => $title_empty, 'level' => 'warning'];
      }
      if (strlen($email_title) > 64) {
        return ['status' => 'msg', 'why' => $title_long, 'level' => 'warning'];
      }
      if (strlen($email_title) < 3) {
        return ['status' => 'msg', 'why' => $title_short, 'level' => 'warning'];
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['status' => 'msg', 'why' => $invalid_email, 'level' => 'warning'];
      }
      if ($php_cli_manual_path != '' && !file_exists($php_cli_manual_path)) {
        return ['status' => 'msg', 'why' => $cli_no_exist, 'level' => 'warning'];
      }
      if (intval($db_query_size) > 15000) {
        return ['status' => 'msg', 'why' => $db_query_too_much, 'level' => 'warning'];
      }
      if (intval($db_query_size) < 15) {
        return ['status' => 'msg', 'why' => $db_query_too_low, 'level' => 'warning'];
      }
      if (intval($db_search_replace_max) > 30000) {
        return ['status' => 'msg', 'why' => $db_sr_max_too_much, 'level' => 'warning'];
      }
      if (intval($db_search_replace_max) < 10) {
        return ['status' => 'msg', 'why' => $db_sr_max_too_low, 'level' => 'warning'];
      }

      $error = 0;
      if (!Dashboard\bmi_set_config('OTHER:EMAIL', $email)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:EMAIL:TITLE', $email_title)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:EMAIL:NOTIS', $schedule_issues)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:CLI:PATH', $php_cli_manual_path)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:CLI:DISABLE', $php_cli_disable_others)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:EXPERIMENT:TIMEOUT', $experiment_timeout)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:EXPERIMENT:TIMEOUT:HARD', $experiment_timeout_hard)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:USE:TIMEOUT:NORMAL', $normal_timeout)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:RESTORE:DB:V3', $db_restore_v3_engine)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:DB:QUERIES', $db_query_size)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:DB:SEARCHREPLACE:MAX', $db_search_replace_max)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:DOWNLOAD:DIRECT', $insecure_download)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:UNINSTALL:CONFIGS', $uninstall_config)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:UNINSTALL:BACKUPS', $uninstall_backups)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:RESTORE:SPLITTING', $db_restore_splitting)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:BACKUP:DB:SINGLE:FILE', $single_file_db_force)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:BACKUP:DB:BATCHING', $db_batching_backup)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:BACKUP:SPACE:CHECKING', $bmi_disable_space_check)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('OTHER:RESTORE:BEFORE:CLEANUP', $no_assets_b4_restore)) {
        $error++;
      }

      return ['status' => 'success', 'errors' => $error];
    }

    public function saveStorageTypeConfig() {

      // Errors
      $name_empty = __('Name is required, please fill the input.', 'backup-backup');
      $name_long = __('Your name is too long, please change the name.', 'backup-backup');
      $name_short = __('Your name is too short, please create longer one.', 'backup-backup');
      $name_space = __('Please, do not use spaces in file name.', 'backup-backup');
      $name_forbidden = __('Your name contains character(s) that are not allowed in file names: ', 'backup-backup');

      $forbidden_chars = ['/', '\\', '<', '>', ':', '"', "'", '|', '?', '*', '.', ';', '@', '!', '~', '`', ',', '#', '$', '&', '=', '+'];
      $name = trim($this->post['name']); // BACKUP:NAME

      if (strlen($name) == 0) {
        return ['status' => 'msg', 'why' => $name_empty, 'level' => 'warning'];
      }
      if (strlen($name) > 40) {
        return ['status' => 'msg', 'why' => $name_long, 'level' => 'warning'];
      }
      if (strlen($name) < 3) {
        return ['status' => 'msg', 'why' => $name_short, 'level' => 'warning'];
      }
      if (strpos($name, ' ') !== false) {
        return ['status' => 'msg', 'why' => $name_space, 'level' => 'warning'];
      }

      for ($i = 0; $i < sizeof($forbidden_chars); ++$i) {
        $char = $forbidden_chars[$i];
        if (strpos($name, $char) !== false) {
          return ['status' => 'msg', 'why' => $name_forbidden . $char, 'level' => 'warning'];
        }
      }

      $error = 0;
      if (!Dashboard\bmi_set_config('BACKUP:NAME', $name)) {
        $error++;
      }

      return ['status' => 'success', 'errors' => $error];
    }

    public function saveFilesConfig() {
      $db_group = $this->post['database_group']; // BACKUP:DATABASE
      $files_group = $this->post['files_group']; // BACKUP:FILES

      $fgp = $this->post['files-group-plugins']; // BACKUP:FILES::PLUGINS
      $fgu = $this->post['files-group-uploads']; // BACKUP:FILES::UPLOADS
      $fgt = $this->post['files-group-themes']; // BACKUP:FILES::THEMES
      $fgoc = $this->post['files-group-other-contents']; // BACKUP:FILES::OTHERS
      $fgwp = $this->post['files-group-wp-install']; // BACKUP:FILES::WP

      $file_filters = $this->post['files_by_filters']; // BACKUP:FILES::FILTER
      $ffs = $this->post['ex_b_fs']; // BACKUP:FILES::FILTER:SIZE
      $ffsizemax = $this->post['BFFSIN']; // BACKUP:FILES::FILTER:SIZE:IN
      $ffn = $this->post['ex_b_names']; // BACKUP:FILES::FILTER:NAMES
      $ffp = $this->post['ex_b_fpaths']; // BACKUP:FILES::FILTER:FPATHS
      $ffd = $this->post['ex_b_dpaths']; // BACKUP:FILES::FILTER:DPATHS

      $dbeg = $this->post['db-exclude-tables-group']; // BACKUP:DATABASE:EXCLUDE
      $dbet = $this->post['db-excluded-tables']; // BACKUP:DATABASE:EXCLUDE:LIST

      $existant = [];
      $parsed = [];
      $ffnames = $this->post['dynamic-names']; // BACKUP:FILES::FILTER:NAMES:IN
      $ffpnames = array_unique($this->post['dynamic-fpaths-names']); // BACKUP:FILES::FILTER:FPATHS:IN
      $ffdnames = array_unique($this->post['dynamic-dpaths-names']); // BACKUP:FILES::FILTER:DPATHS:IN

      if (is_array($dbet) || is_object($dbet)) {
        if (sizeof($dbet) == 1 && $dbet[0] == 'empty') {
          $dbet = [];
        }
      }

      if ($dbeg === 'true') $dbeg = true;
      else $dbeg = false;

      $max = sizeof($ffpnames);
      for ($i = 0; $i < $max; ++$i) {
        if (!is_string($ffpnames[$i]) || trim(strlen($ffpnames[$i])) <= 1) {
          array_splice($ffpnames, $i, 1);
          $i--;
          $max--;
        }
      }

      $max = sizeof($ffdnames);
      for ($i = 0; $i < $max; ++$i) {
        if (!is_string($ffdnames[$i]) || trim(strlen($ffdnames[$i])) <= 1) {
          array_splice($ffdnames, $i, 1);
          $i--;
          $max--;
        }
      }

      for ($i = 0; $i < sizeof($ffnames); ++$i) {
        $row = $ffnames[$i];
        $txt = array_key_exists('txt', $row) ? "" . $row['txt'] . "" : false;
        $pos = array_key_exists('pos', $row) ? $row['pos'] : false;
        $whr = array_key_exists('whr', $row) ? $row['whr'] : false;

        if ($txt === false || $pos === false || $whr === false) {
          continue;
        }
        if (trim(strlen($txt)) <= 0) {
          continue;
        }
        if (!in_array($pos, ["1", "2", "3"])) {
          continue;
        }
        if (!in_array($whr, ["1", "2"])) {
          continue;
        }
        if (in_array($txt . $pos . $whr, $existant)) {
          continue;
        } else {
          $existant[] = $txt . $pos . $whr;
        }

        $parsed[] = ['txt' => $txt, 'pos' => $pos, 'whr' => $whr];
      }

      if ($ffs == 'true' && !is_numeric($ffsizemax)) {
        return ['status' => 'msg', 'why' => __('Entred file size limit, is not correct number.', 'backup-backup'), 'level' => 'warning'];
      }

      $error = 0;
      if (!Dashboard\bmi_set_config('BACKUP:DATABASE', $db_group)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('BACKUP:FILES', $files_group)) {
        $error++;
      }

      if (!Dashboard\bmi_set_config('BACKUP:FILES::PLUGINS', $fgp)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('BACKUP:FILES::UPLOADS', $fgu)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('BACKUP:FILES::THEMES', $fgt)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('BACKUP:FILES::OTHERS', $fgoc)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('BACKUP:FILES::WP', $fgwp)) {
        $error++;
      }

      if (!Dashboard\bmi_set_config('BACKUP:FILES::FILTER', $file_filters)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('BACKUP:FILES::FILTER:SIZE', $ffs)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('BACKUP:FILES::FILTER:NAMES', $ffn)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('BACKUP:FILES::FILTER:FPATHS', $ffp)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('BACKUP:FILES::FILTER:DPATHS', $ffd)) {
        $error++;
      }

      if (!Dashboard\bmi_set_config('BACKUP:FILES::FILTER:SIZE:IN', $ffsizemax)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('BACKUP:FILES::FILTER:NAMES:IN', $parsed)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('BACKUP:FILES::FILTER:FPATHS:IN', $ffpnames)) {
        $error++;
      }
      if (!Dashboard\bmi_set_config('BACKUP:FILES::FILTER:DPATHS:IN', $ffdnames)) {
        $error++;
      }

      if (defined('BMI_BACKUP_PRO') && BMI_BACKUP_PRO == 1) {
        if (!Dashboard\bmi_set_config('BACKUP:DATABASE:EXCLUDE', $dbeg)) {
          $error++;
        }
        if (!Dashboard\bmi_set_config('BACKUP:DATABASE:EXCLUDE:LIST', $dbet)) {
          $error++;
        }
      }

      // return array('status' => 'msg', 'why' => __('Entred path is not writable or does not exist.', 'backup-backup'), 'level' => 'warning');

      return ['status' => 'success', 'errors' => $error];
    }

    public function scanFilesForBackup(&$progress) {
      require_once BMI_INCLUDES . '/scanner/files.php';

      // Use filters?
      $is = Dashboard\bmi_get_config('BACKUP:FILES::FILTER') === 'true' ? true : false;

      // Get settings form config
      $fgp = Dashboard\bmi_get_config('BACKUP:FILES::PLUGINS');
      $fgt = Dashboard\bmi_get_config('BACKUP:FILES::THEMES');
      $fgu = Dashboard\bmi_get_config('BACKUP:FILES::UPLOADS');
      $fgoc = Dashboard\bmi_get_config('BACKUP:FILES::OTHERS');
      $fgwp = Dashboard\bmi_get_config('BACKUP:FILES::WP');
      $dpathsis = Dashboard\bmi_get_config('BACKUP:FILES::FILTER:DPATHS') === 'true' ? true : false;
      $dpaths = Dashboard\bmi_get_config('BACKUP:FILES::FILTER:DPATHS:IN');
      $dynamesis = Dashboard\bmi_get_config('BACKUP:FILES::FILTER:NAMES') === 'true' ? true : false;
      $dynames = Dashboard\bmi_get_config('BACKUP:FILES::FILTER:NAMES:IN');
      $dynparsed = [];

      // Filter dynames to for smaller size
      if ($is && $dynamesis) {
        for ($i = 0; $i < sizeof($dynames); ++$i) {
          $s = $dynames[$i];
          if ($s->whr == '2') {
            $dynparsed[] = ['s' => $s->txt, 'w' => $s->pos, 'z' => strlen($s->txt)];
          }
        }
      }

      // Set exclusion rules
      $ignored_folders_default = [];
      if ($is && $dynamesis) {
        BMP::merge_arrays($ignored_folders_default, $dynparsed);
      }
      $ignored_folders = $ignored_folders_default;
      $ignored_paths_default = [BMI_CONFIG_DIR, BMI_BACKUPS, BMI_ROOT_DIR];
      $ignored_paths_default[] = "***ABSPATH***/wp-content/ai1wm-backups";
      $ignored_paths_default[] = "***ABSPATH***/wp-content/uploads/wp-clone";
      $ignored_paths_default[] = "***ABSPATH***/wp-content/updraft";
      $ignored_paths_default[] = "***ABSPATH***/wp-content/backups-dup-pro";
      $ignored_paths_default[] = "***ABSPATH***/wp-content/wpvividbackups";
      $ignored_paths_default[] = "***ABSPATH***/wp-content/backup-guard";
      $ignored_paths_default[] = "***ABSPATH***/wp-content/backups-dup-lite";
      if (defined('BMI_PRO_ROOT_DIR')) $ignored_paths_default[] = BMI_PRO_ROOT_DIR;
      if ($is && $dpathsis) {
        BMP::merge_arrays($ignored_paths_default, $dpaths);
      }
      $ignored_paths = $ignored_paths_default;

      // Fix slashes for current system (directories)
      for ($i = 0; $i < sizeof($ignored_paths); ++$i) {
        $ignored_paths[$i] = str_replace('***ABSPATH***', untrailingslashit(ABSPATH), $ignored_paths[$i]);
        $ignored_paths[$i] = BMP::fixSlashes($ignored_paths[$i]);
      }

      // WordPress Paths
      $plugins_path = BMP::fixSlashes(WP_PLUGIN_DIR);
      $themes_path = BMP::fixSlashes(dirname(get_template_directory()));
      $uploads_path = BMP::fixSlashes(wp_upload_dir()['basedir']);
      $wp_contents = BMP::fixSlashes(WP_CONTENT_DIR);
      $wp_install = BMP::fixSlashes(ABSPATH);

      // Getting plugins
      $sfgp = Scanner::equalFolderByPath($wp_install, $plugins_path, $ignored_folders);
      if ($fgp == 'true' && !$sfgp) {
        $plugins_path_files = Scanner::scanFilesGetNamesWithIgnoreFBC($plugins_path, $ignored_folders, $ignored_paths);
      }

      // Getting themes
      $sfgt = Scanner::equalFolderByPath($wp_install, $themes_path, $ignored_folders);
      if ($fgt == 'true' && !$sfgt) {
        $themes_path_files = Scanner::scanFilesGetNamesWithIgnoreFBC($themes_path, $ignored_folders, $ignored_paths);
      }

      // Getting uploads
      $sfgu = Scanner::equalFolderByPath($wp_install, $uploads_path, $ignored_folders);
      if ($fgu == 'true' && !$sfgu) {
        $uploads_path_files = Scanner::scanFilesGetNamesWithIgnoreFBC($uploads_path, $ignored_folders, $ignored_paths);
      }

      // Ignore above paths
      $sfgoc = Scanner::equalFolderByPath($wp_install, $wp_contents, $ignored_folders);
      if ($fgoc == 'true' && !$sfgoc) {

        // Ignore common folders (already scanned)
        $content_folders = [$plugins_path, $themes_path, $uploads_path];
        BMP::merge_arrays($content_folders, $ignored_paths);

        // Getting other contents
        $wp_contents_files = Scanner::scanFilesGetNamesWithIgnoreFBC($wp_contents, $ignored_folders, $content_folders);
      }

      // Ignore contents path
      if ($fgwp == 'true') {

        // Ignore contents file
        $ignored_paths[] = $wp_contents;

        // Getting WP Installation
        $wp_install_files = Scanner::scanFilesGetNamesWithIgnoreFBC($wp_install, $ignored_folders, $ignored_paths);
      }

      // Concat all file paths
      $all_files = [];
      if ($fgp == 'true' && !$sfgp) {
        BMP::merge_arrays($all_files, $plugins_path_files);
        unset($plugins_path_files);
      }

      if ($fgt == 'true' && !$sfgt) {
        BMP::merge_arrays($all_files, $themes_path_files);
        unset($themes_path_files);
      }

      if ($fgu == 'true' && !$sfgu) {
        BMP::merge_arrays($all_files, $uploads_path_files);
        unset($uploads_path_files);
      }

      if ($fgoc == 'true' && !$sfgoc) {
        BMP::merge_arrays($all_files, $wp_contents_files);
        unset($wp_contents_files);
      }

      if ($fgwp == 'true') {
        BMP::merge_arrays($all_files, $wp_install_files);
        unset($wp_install_files);
      }

      return $all_files;
    }

    public function parseFilesForBackup(&$files, &$progress, $cron = false) {
      $is = Dashboard\bmi_get_config('BACKUP:FILES::FILTER') === 'true' ? true : false;
      $acis = (Dashboard\bmi_get_config('BACKUP:FILES::FILTER:FPATHS') === 'true' && $is) ? true : false;
      $ac = Dashboard\bmi_get_config('BACKUP:FILES::FILTER:FPATHS:IN');

      $abis = (Dashboard\bmi_get_config('BACKUP:FILES::FILTER:NAMES') === 'true' && $is) ? true : false;
      $ab = Dashboard\bmi_get_config('BACKUP:FILES::FILTER:NAMES:IN');
      $abres = [];
      $acres = new \stdClass();

      // Local list of permanently blocked files
      if ($acis == false) {
        $acis = true;
        $ac = [
          '***ABSPATH***/wp-content/uploads/wpforms/.htaccess.cpmh3129', // Binary broken file of wpforms
          '***ABSPATH***/wp-content/uploads/gravity_forms/.htaccess.cpmh3129', // Binary broken file of wpforms
          '***ABSPATH***/logs/traffic.html/.md5sums', // Binary broken file of wpforms
          '***ABSPATH***/wp-config.php' // Exclude wp-config.php permanently
        ];
      } else {
        $ac[] = '***ABSPATH***/wp-content/uploads/wpforms/.htaccess.cpmh3129'; // Binary broken file of wpforms
        $ac[] = '***ABSPATH***/logs/traffic.html/.md5sums'; // Binary broken file of wpforms
      }

      $temp_is = false;
      if ($is == false) {
        $temp_is = true;
      }

      if (($is && $acis) || $temp_is) {
        foreach ($ac as $key => $value) {
          $value = str_replace('***ABSPATH***', untrailingslashit(ABSPATH), $value);
          $value = BMP::fixSlashes($value);
          $acres->{$value} = 1;
        }
      }

      if ($is && $abis) {
        for ($i = 0; $i < sizeof($ab); ++$i) {
          $s = $ab[$i];
          if ($s->whr == '1') {
            $abres[] = ['s' => $s->txt, 'w' => $s->pos, 'z' => strlen($s->txt)];
          }
        }
      }

      $limitcrl = 96;
      if (defined('BMI_CLI_ENABLED') && BMI_CLI_ENABLED === true) $limitcrl = 512;
      $first_big = false;
      $sizemax = Dashboard\bmi_get_config('BACKUP:FILES::FILTER:SIZE:IN');
      $usesize = (Dashboard\bmi_get_config('BACKUP:FILES::FILTER:SIZE') === 'true' && $is) ? true : false;
      if (!is_numeric($sizemax)) {
        $usesize = false;
        $sizemax = 99999;
      } else {
        intval($sizemax);
      }

      // If legacy === false it will use background process to bypass the timeout
      if (!defined('BMI_LEGACY_VERSION')) $legacy = true;
      else $legacy = BMI_LEGACY_VERSION;
      if ($legacy && defined('BMI_LEGACY_HARD_VERSION') && !BMI_LEGACY_HARD_VERSION) $legacy = BMI_LEGACY_HARD_VERSION;
      if (defined('BMI_CLI_ENABLED') && defined('BMI_FUNCTION_NORMAL') && BMI_CLI_ENABLED === true && BMI_FUNCTION_NORMAL === true) $legacy = false;

      $total_size = 0;
      $max = $sizemax * (1024 * 1024);
      $maxfor = sizeof($files);

      // Non-legacy variables
      if ($legacy === false) {
        $Hx = trailingslashit(WP_CONTENT_DIR);
        $Hz = trailingslashit(ABSPATH);
        $Hxs = strlen($Hx);
        $Hzs = strlen($Hz);
      }

      // Sort it by size
      if ($legacy === false) {
        usort($files, function ($a, $b) {
          $a = explode(',', $a);
          $last = sizeof($a) - 1;
          $sizea = intval($a[$last]);

          $b = explode(',', $b);
          $last = sizeof($b) - 1;
          $sizeb = intval($b[$last]);

          if ($sizea == $sizeb) return 0;
          if ($sizea < $sizeb) return -1;
          else return 1;
        });
      }

      // Process due to rules
      for ($i = 0; $i < $maxfor; ++$i) {

        // Remove size from path and get the size
        $files[$i] = explode(',', $files[$i]);
        $last = sizeof($files[$i]) - 1;
        $size = intval($files[$i][$last]);
        unset($files[$i][$last]);
        $files[$i] = implode(',', $files[$i]);

        if ($usesize && Scanner::fileTooLarge($size, $max)) {
          $progress->log(__("Removing file from backup (too large) ", 'backup-backup') . $files[$i] . ' (' . number_format(($size / 1024 / 1024), 2) . ' MB)', 'WARN');
          array_splice($files, $i, 1);
          $maxfor--;
          $i--;

          continue;
        }

        if ($abis && Scanner::equalFolder(basename($files[$i]), $abres)) {
          $progress->log(__("Removing file from backup (due to exclude rules): ", 'backup-backup') . $files[$i], 'WARN');
          array_splice($files, $i, 1);
          $maxfor--;
          $i--;

          continue;
        }

        if ($acis && property_exists($acres, $files[$i])) {
          $progress->log(__("Removing file from backup (due to path rules): ", 'backup-backup') . $files[$i], 'WARN');
          array_splice($files, $i, 1);
          $maxfor--;
          $i--;

          continue;
        }

        if ($size === 0) {
          array_splice($files, $i, 1);
          $maxfor--;
          $i--;

          continue;
        }

        if (strpos($files[$i], 'bmi-pclzip-') !== false) {
          array_splice($files, $i, 1);
          $maxfor--;
          $i--;

          continue;
        }

        if ($size > ($limitcrl * (1024 * 1024))) {
          if ($first_big === false) $first_big = $i;
          $progress->log(__("This file is quite big consider to exclude it, if backup fails: ", 'backup-backup') . $files[$i] . ' (' . BMP::humanSize($size) . ')', 'WARN');
        }

        if (($legacy === false && (BMI_FUNCTION_NORMAL === false || (BMI_FUNCTION_NORMAL === true && BMI_CLI_ENABLED === true))) && (!defined('BMI_USING_CLI_FUNCTIONALITY') || BMI_USING_CLI_FUNCTIONALITY === false)) {
          $fx = strpos($files[$i], $Hx);
          $fz = strpos($files[$i], $Hz);

          if ($fx !== false) $files[$i] = substr_replace($files[$i], '@1@', $fx, $Hxs);
          else if ($fz !== false) $files[$i] = substr_replace($files[$i], '@2@', $fz, $Hzs);

          $files[$i] .= ',' . $size;
        }
        $total_size += $size;
      }

      if ($legacy === false && (!defined('BMI_USING_CLI_FUNCTIONALITY') || BMI_USING_CLI_FUNCTIONALITY === false)) {
        $list_file = BMI_INCLUDES . DIRECTORY_SEPARATOR . 'htaccess' . DIRECTORY_SEPARATOR . 'files_latest.list';
        if (file_exists($list_file)) @unlink($list_file);
        $files_list = fopen($list_file, 'a');
        if ($first_big === false) fwrite($files_list, sizeof($files) . "_-1\r\n");
        else fwrite($files_list, sizeof($files) . '_' . $first_big . "\r\n");
        for ($i = 0; $i < sizeof($files); ++$i) {
          fwrite($files_list, $files[$i] . "\r\n");
        }
        fclose($files_list);
        $this->first_big = $first_big;
      }

      $this->total_size_for_backup = $total_size;
      $this->total_size_for_backup_in_mb = ($total_size / 1024 / 1024);

      return $files;
    }

    public function toggleBackupLock($unlock = false) {

      // Require lib
      require_once BMI_INCLUDES . DIRECTORY_SEPARATOR . 'zipper' . DIRECTORY_SEPARATOR . 'zipping.php';

      // Backup name
      $filename = $this->post['filename'];

      // Init Zipper
      $zipper = new Zipper();

      // Path to Backup
      $path = BMI_BACKUPS . DIRECTORY_SEPARATOR . $filename;
      $path_dir = BMP::fixSlashes(dirname($path));

      // Check if file exists
      if (!file_exists($path)) {
        return ['status' => 'fail'];
      }

      // Check if directory is correct
      if ($path_dir != BMP::fixSlashes(BMI_BACKUPS)) {
        return ['status' => 'fail'];
      }

      // Toggle the lock
      $status = $zipper->lock_zip($path, $unlock);

      // Return the status
      return ['status' => ($status ? 'success' : 'fail')];
    }

    public function getDynamicNames() {
      $data = Dashboard\bmi_get_config('BACKUP:FILES::FILTER:NAMES:IN');
      $fpdata = Dashboard\bmi_get_config('BACKUP:FILES::FILTER:FPATHS:IN');
      $fddata = Dashboard\bmi_get_config('BACKUP:FILES::FILTER:DPATHS:IN');

      for ($i = 0; $i < sizeof($fpdata); ++$i) {
        $fpdata[$i] = BMP::fixSlashes($fpdata[$i]);
      }

      for ($i = 0; $i < sizeof($fddata); ++$i) {
        $fddata[$i] = BMP::fixSlashes($fddata[$i]);
      }

      return [
        'status' => 'success',
        'dynamic-fpaths-names' => $fpdata,
        'dynamic-dpaths-names' => $fddata,
        'data' => $data
      ];
    }

    public function resetConfiguration() {
      if (file_exists(BMI_CONFIG_PATH)) {
        @unlink(BMI_CONFIG_PATH);
      }

      // update_option('BMI_LOGS_SHARING_IS_ALLOWED', 'unknown');

      return ['status' => 'success'];
    }

    public function getSiteData() {
      require_once BMI_INCLUDES . DIRECTORY_SEPARATOR . 'check' . DIRECTORY_SEPARATOR . 'system_info.php';
      $bmi = new SI();
      $bmi = $bmi->to_array();

      return ['status' => 'success', 'data' => $bmi];
    }

    public function calculateCron() {
      require_once BMI_INCLUDES . DIRECTORY_SEPARATOR . 'cron' . DIRECTORY_SEPARATOR . 'handler.php';

      $minutes = [];
      $keeps = [];
      $days = [];
      $weeks = [];
      $hours = [];

      for ($i = 1; $i <= 28; ++$i) {
        $days[] = substr('0' . $i, -2);
      }
      for ($i = 1; $i <= 7; ++$i) {
        $weeks[] = $i . '';
      }
      for ($i = 0; $i <= 23; ++$i) {
        $hours[] = substr('0' . $i, -2);
      }
      for ($i = 0; $i <= 55; $i += 5) {
        $minutes[] = substr('0' . $i, -2);
      }
      for ($i = 1; $i <= 20; ++$i) {
        $keeps[] = $i . '';
      }

      $errors = 0;
      if (in_array($this->post['type'], ['month', 'week', 'day'])) {
        if (!Dashboard\bmi_set_config('CRON:TYPE', $this->post['type'])) {
          $errors++;
        }
      }
      if (in_array($this->post['day'], $days)) {
        if (!Dashboard\bmi_set_config('CRON:DAY', $this->post['day'])) {
          $errors++;
        }
      }
      if (in_array($this->post['week'], $weeks)) {
        if (!Dashboard\bmi_set_config('CRON:WEEK', $this->post['week'])) {
          $errors++;
        }
      }
      if (in_array($this->post['hour'], $hours)) {
        if (!Dashboard\bmi_set_config('CRON:HOUR', $this->post['hour'])) {
          $errors++;
        }
      }
      if (in_array($this->post['minute'], $minutes)) {
        if (!Dashboard\bmi_set_config('CRON:MINUTE', $this->post['minute'])) {
          $errors++;
        }
      }
      if (in_array($this->post['keep'], $keeps)) {
        if (!Dashboard\bmi_set_config('CRON:KEEP', $this->post['keep'])) {
          $errors++;
        }
      }

      if ($this->post['enabled'] === 'true') {
        $this->post['enabled'] = true;
      } else {
        $this->post['enabled'] = false;
      }

      if (!Dashboard\bmi_set_config('CRON:ENABLED', $this->post['enabled'])) {
        $errors++;
      }

      if ($errors === 0) {
        $time = Crons::calculate_date([
          'type' => $this->post['type'],
          'week' => $this->post['week'],
          'day' => $this->post['day'],
          'hour' => $this->post['hour'],
          'minute' => $this->post['minute']
        ], time());

        $file = BMI_INCLUDES . DIRECTORY_SEPARATOR . 'htaccess' . DIRECTORY_SEPARATOR . '.plan';
        if (file_exists($file)) {
          $earlier = intval(file_get_contents($file));
        } else {
          $earlier = 0;
        }

        if (!wp_next_scheduled('bmi_do_backup_right_now') || $earlier === 0 || (abs($time - $earlier) >= 15)) {
          wp_clear_scheduled_hook('bmi_do_backup_right_now');
          if ($this->post['enabled'] === true) {
            wp_schedule_single_event($time, 'bmi_do_backup_right_now');
            file_put_contents($file, $time);
          }
        }

        return [
          'status' => 'success',
          'data' => date('Y-m-d H:i:s', $time),
          'currdata' => date('Y-m-d H:i:s')
        ];
      } else {
        return ['status' => 'error'];
      }
    }

    public function dismissErrorNotice() {
      delete_option('bmi_display_email_issues');
    }

    // recursive removal
    private function rrmdir($dir) {

      if (is_dir($dir)) {

        $objects = scandir($dir);
        foreach ($objects as $object) {

          if ($object != "." && $object != "..") {

            if (is_dir($dir . DIRECTORY_SEPARATOR . $object) && !is_link($dir . DIRECTORY_SEPARATOR . $object)) {

              $this->rrmdir($dir . DIRECTORY_SEPARATOR . $object);

            } else {

              @unlink($dir . DIRECTORY_SEPARATOR . $object);

            }

          }

        }

        @rmdir($dir);

      } else {

        if (file_exists($dir) && is_file($dir)) {

          @unlink($dir);

        }

      }

    }

    public function forceBackupToStop() {

      $filesToBeRemoved = [];

      $tmp_dir = BMI_ROOT_DIR . DIRECTORY_SEPARATOR . 'tmp';
      if (!is_dir($tmp_dir)) @mkdir($tmp_dir, 0755, true);

      foreach (scandir($tmp_dir) as $filename) {

        if (in_array($filename, ['.', '..'])) continue;
        $path = BMI_ROOT_DIR . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . $filename;
        $filesToBeRemoved[] = $path;

      }

      $allowedFiles = ['wp-config.php', '.htaccess', '.litespeed', '.default.json'];
      foreach (glob(BMI_INCLUDES . DIRECTORY_SEPARATOR . 'htaccess' . DIRECTORY_SEPARATOR . '.*') as $filename) {

        $basename = basename($filename);

        if (in_array($basename, ['.', '..'])) continue;
        if (is_file($filename) && !in_array($basename, $allowedFiles)) {
          $filesToBeRemoved[] = $filename;
        }

      }

      foreach (glob(BMI_INCLUDES . DIRECTORY_SEPARATOR . 'htaccess' . DIRECTORY_SEPARATOR . 'BMI-*', GLOB_ONLYDIR) as $filename) {

        $basename = basename($filename);

        if (in_array($basename, ['.', '..'])) continue;
        if (is_dir($filename) && !in_array($filename, $allowedFiles)) {
          $filesToBeRemoved[] = $filename;
        }

      }

      foreach (glob(BMI_INCLUDES . DIRECTORY_SEPARATOR . 'htaccess' . DIRECTORY_SEPARATOR . 'bg-BMI-*', GLOB_ONLYDIR) as $filename) {

        $basename = basename($filename);

        if (in_array($basename, ['.', '..'])) continue;
        if (is_dir($filename) && !in_array($filename, $allowedFiles)) {
          $filesToBeRemoved[] = $filename;
        }

      }

      $filesToBeRemoved[] = BMI_BACKUPS . DIRECTORY_SEPARATOR . '.backup_cli_lock';
      $filesToBeRemoved[] = BMI_BACKUPS . DIRECTORY_SEPARATOR . '.backup_cli_lock_ended';
      $filesToBeRemoved[] = BMI_BACKUPS . DIRECTORY_SEPARATOR . '.backup_cli_lock_end';
      $filesToBeRemoved[] = BMI_BACKUPS . DIRECTORY_SEPARATOR . '.running';
      $filesToBeRemoved[] = BMI_INCLUDES . DIRECTORY_SEPARATOR . 'htaccess' . DIRECTORY_SEPARATOR . 'db_tables';
      $filesToBeRemoved[] = BMI_INCLUDES . DIRECTORY_SEPARATOR . 'htaccess' . DIRECTORY_SEPARATOR . 'bmi_backup_manifest.json';
      $filesToBeRemoved[] = BMI_INCLUDES . DIRECTORY_SEPARATOR . 'htaccess' . DIRECTORY_SEPARATOR . 'files_latest.list';

      if (is_array($filesToBeRemoved) || is_object($filesToBeRemoved)) {
        foreach ((array) $filesToBeRemoved as $file) {
          $this->rrmdir($file);
        }
      }

      return ['status' => 'success'];

    }

    public function forceRestoreToStop() {

      $filesToBeRemoved = [];

      $themedir = get_theme_root();
      $tempTheme = $themedir . DIRECTORY_SEPARATOR . 'backup_migration_restoration_in_progress';
      $filesToBeRemoved[] = $tempTheme;

      $tmpDirectory = BMI_ROOT_DIR . DIRECTORY_SEPARATOR . 'tmp';
      if (!is_dir($tmpDirectory)) @mkdir($tmpDirectory, 0755, true);

      foreach (scandir($tmpDirectory) as $filename) {

        if (in_array($filename, ['.', '..'])) continue;
        $path = BMI_ROOT_DIR . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . $filename;
        $filesToBeRemoved[] = $path;

      }

      foreach (glob(untrailingslashit(ABSPATH) . DIRECTORY_SEPARATOR . 'backup-migration_??????????') as $filename) {

        $basename = basename($filename);

        if (is_dir($filename) && !in_array($basename, ['.', '..'])) {
          $filesToBeRemoved[] = $filename;
        }

      }

      $allowedFiles = ['wp-config.php', '.htaccess', '.litespeed', '.default.json'];
      foreach (glob(BMI_INCLUDES . DIRECTORY_SEPARATOR . 'htaccess' . DIRECTORY_SEPARATOR . '.*') as $filename) {

        $basename = basename($filename);

        if (in_array($basename, ['.', '..'])) continue;
        if (is_file($filename) && !in_array($basename, $allowedFiles)) {
          $filesToBeRemoved[] = $filename;
        }

      }

      foreach (glob(BMI_INCLUDES . DIRECTORY_SEPARATOR . 'htaccess' . DIRECTORY_SEPARATOR . 'restore_scan_*') as $filename) {

        $basename = basename($filename);

        if (in_array($basename, ['.', '..'])) continue;
        if (is_file($filename) && !in_array($basename, $allowedFiles)) {
          $filesToBeRemoved[] = $filename;
        }

      }

      foreach (glob(untrailingslashit(ABSPATH) . DIRECTORY_SEPARATOR . 'wp-config.??????????.php') as $filename) {

        $basename = basename($filename);

        if (in_array($basename, ['.', '..'])) continue;
        if (is_file($filename) && !in_array($filename, $allowedFiles)) {
          $filesToBeRemoved[] = $filename;
        }

      }

      $filesToBeRemoved[] = BMI_BACKUPS . DIRECTORY_SEPARATOR . '.migration_lock';
      $filesToBeRemoved[] = BMI_BACKUPS . DIRECTORY_SEPARATOR . '.migration_lock_cli';
      $filesToBeRemoved[] = BMI_BACKUPS . DIRECTORY_SEPARATOR . '.migration_lock_cli_end';
      $filesToBeRemoved[] = BMI_BACKUPS . DIRECTORY_SEPARATOR . '.migration_lock_ended';
      $filesToBeRemoved[] = BMI_BACKUPS . DIRECTORY_SEPARATOR . '.cli_download_last';
      $filesToBeRemoved[] = BMI_BACKUPS . DIRECTORY_SEPARATOR . '.running';
      $filesToBeRemoved[] = BMI_INCLUDES . DIRECTORY_SEPARATOR . 'htaccess' . DIRECTORY_SEPARATOR . '.restore_secret';
      $filesToBeRemoved[] = BMI_INCLUDES . DIRECTORY_SEPARATOR . 'htaccess' . DIRECTORY_SEPARATOR . '.table_map';

      if (is_array($filesToBeRemoved) || is_object($filesToBeRemoved)) {
        foreach ((array) $filesToBeRemoved as $file) {
          $this->rrmdir($file);
        }
      }

      return ['status' => 'success'];

    }

    public function sendTroubleshootingDetails($send_type = 'manual', $triggeredBy = false, $blocking = true) {

      require_once BMI_INCLUDES . DIRECTORY_SEPARATOR . 'check' . DIRECTORY_SEPARATOR . 'system_info.php';
      $bmiSiteData = new SI();
      $bmiSiteData = $bmiSiteData->to_array();

      $latestBackupLogs = 'does_not_exist';
      $latestBackupProgress = 'does_not_exist';
      $latestRestorationLogs = 'does_not_exist';
      $latestRestorationProgress = 'does_not_exist';
      $currentPluginConfig = 'does_not_exist';
      $pluginGlobalLogs = 'does_not_exist';
      $backgroundErrors = 'does_not_exist';

      if (file_exists(BMI_BACKUPS . '/latest.log')) {
        $latestBackupLogs = file_get_contents(BMI_BACKUPS . '/latest.log');
      }

      if (file_exists(BMI_BACKUPS . '/latest_progress.log')) {
        $latestBackupProgress = file_get_contents(BMI_BACKUPS . '/latest_progress.log');
      }

      if (file_exists(BMI_BACKUPS . '/latest_migration.log')) {
        $latestRestorationLogs = file_get_contents(BMI_BACKUPS . '/latest_migration.log');
      }

      if (file_exists(BMI_BACKUPS . '/latest_migration_progress.log')) {
        $latestRestorationProgress = file_get_contents(BMI_BACKUPS . '/latest_migration_progress.log');
      }

      if (file_exists(BMI_CONFIG_DIR . DIRECTORY_SEPARATOR . '/config.json')) {
        $currentPluginConfig = file_get_contents(BMI_CONFIG_DIR . DIRECTORY_SEPARATOR . '/config.json');
      }

      if (file_exists(BMI_CONFIG_DIR . DIRECTORY_SEPARATOR . 'complete_logs.log')) {
        $pluginGlobalLogs = file_get_contents(BMI_CONFIG_DIR . DIRECTORY_SEPARATOR . 'complete_logs.log');
      }

      $backgroundLogsPath = BMI_CONFIG_DIR . DIRECTORY_SEPARATOR . 'background-errors.log';
      if (file_exists($backgroundLogsPath)) {
        if ((filesize($backgroundLogsPath) / 1024 / 1024) <= 4) {
          $backgroundErrors = file_get_contents($backgroundLogsPath);
        } else $backgroundErrors = 'file_too_large';
      }

      $ifCLI = false;
      if (defined('BMI_USING_CLI_FUNCTIONALITY') && BMI_USING_CLI_FUNCTIONALITY === true) {
        $ifCLI = true;
      }

      $logsSourceFrontEnd = 'manual';
      if ($triggeredBy != false) {
        $logsSourceFrontEnd = $triggeredBy;
      }
      if (isset($this->post['source']) && in_array($this->post['source'], ['backup', 'migration'])) {
        $logsSourceFrontEnd = $this->post['source'];
      }

      $url = 'https://' . BMI_API_BACKUPBLISS_PUSH . '/v1' . '/push';
      $response = wp_remote_post($url, array(
        'method' => 'POST',
        'timeout' => 15,
        'blocking' => $blocking,
        'sslverify' => false,
        'send_type' => $send_type,
        'body' => array(
          'admin_url' => admin_url(),
          'home_url' => home_url(),
          'site_url' => get_site_url(),
          'is_multisite' => is_multisite() ? "yes" : "no",
          'is_abspath_writable' => is_writable(ABSPATH) ? "yes" : "no",
          'site_information' => $bmiSiteData,
          'latest_backup_logs' => $latestBackupLogs,
          'latest_backup_progress' => $latestBackupProgress,
          'latest_restoration_logs' => $latestRestorationLogs,
          'latest_restoration_progress' => $latestRestorationProgress,
          'current_plugin_config' => $currentPluginConfig,
          'plugin_global_logs' => $pluginGlobalLogs,
          'background_errors' => $backgroundErrors,
          'triggered_by' => $logsSourceFrontEnd,
          'is_defined' => defined('BMI_BACKUP_PRO') ? 'yes' : 'no',
          'is_cli' => $ifCLI
        )
      ));

      if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        Logger::error($error_message, 'backup-backup');
        return ['status' => 'fail'];
      } else {
        try {
          $body = json_decode($response['body']);
          if (isset($body->code)) {
            return ['status' => 'success', 'code' => sanitize_text_field($body->code)];
          } else {
            return ['status' => 'fail'];
          }
        } catch (\Exception $e) {
          Logger::error(print_r($e, true), 'backup-backup');
          return ['status' => 'fail'];
        } catch (\Throwable $t) {
          Logger::error(print_r($t, true), 'backup-backup');
          return ['status' => 'fail'];
        }
      }

    }

    public function actionsAfterProcess($success = false, $triggeredBy = 'backup') {

      return null;

      // REMOVED CODE:
      // $canShare = BMP::canShareLogsOrShouldAsk();
      // if ($canShare === 'allowed') {
      //
      //   $send_type = 'error';
      //   if ($success) $send_type = 'success';
      //   $this->sendTroubleshootingDetails($send_type, $triggeredBy, false);
      //
      // }

    }

    public function logSharing() {

      $type = $this->post['question'];

      if ($type == 'set_yes') {

        // $isOk = Dashboard\bmi_set_config('LOGS::SHARING', 'yes');
        // update_option('BMI_LOGS_SHARING_IS_ALLOWED', 'yes');
        return ['status' => 'success'];

      } else if ($type == 'set_no') {

        // $isOk = Dashboard\bmi_set_config('LOGS::SHARING', 'no');
        // update_option('BMI_LOGS_SHARING_IS_ALLOWED', 'no');
        return ['status' => 'success'];

      } else if ($type == 'is_allowed') {

        // $canShare = BMP::canShareLogsOrShouldAsk();
        // return ['status' => 'success', 'result' => $canShare];
        return ['status' => 'success', 'result' => 'not-allowed'];

      } else {

        return ['status' => 'fail'];

      }

    }

    public function getLatestBackupFile() {

      $dir = BMI_BACKUPS;
      $backupdir = array_diff(scandir($dir), ['..', '.']);
      $backups = [];
      foreach ($backupdir as $index => $name) {

        $ext = pathinfo($dir . DIRECTORY_SEPARATOR . $name, PATHINFO_EXTENSION);

        if ($ext === 'zip') {
          $backups[] = [
            'cdate' => filemtime($dir . DIRECTORY_SEPARATOR . $name),
            'name' => $name
          ];
        }

      }

      usort($backups, function ($a, $b) {
        if (intval($a['cdate']) < intval($b['cdate'])) return 1;
        else return -1;
      });

      $backups = array_values($backups);

      return $backups[0]['name'];

    }

    public function debugging() {

    }
  }
