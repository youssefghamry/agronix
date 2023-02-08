<?php

  // Namespace
  namespace BMI\Plugin\Dashboard;

  // Exit on direct access
  if (!defined('ABSPATH')) exit;

  $restoreErrorInstruction = __('Please click on the button below to enable us to investigate.', 'backup-backup');

  $messageRestoreError1 = __("That's unusual! But no worries – we're happy to look into it, and fix it for you (%s1for free!%s2)", 'backup-backup');
  $messageRestoreError1 = str_replace('%s1', '<b>', $messageRestoreError1);
  $messageRestoreError1 = str_replace('%s2', '</b>', $messageRestoreError1);

  $bmiTroubleshootingLogShareInfo = __("You'll share: Website URL, %s1restore logs%s2, our plugin logs & configuration, basic data about your site.", 'backup-backup');
  $bmiTroubleshootingLogShareInfo2 = __("No confidential data such as email gets shared.", 'backup-backup');

  $bmiTroubleshootingLogShareInfo = str_replace('%s1', '<a href="#" class="download-restore-log-url hoverable secondary" download="restore_logs.txt">', $bmiTroubleshootingLogShareInfo);
  $bmiTroubleshootingLogShareInfo = str_replace('%s2', '</a>', $bmiTroubleshootingLogShareInfo);

?>

<div class="modal" id="restore-error-modal">

  <div class="modal-wrapper no-hpad" style="max-width: 900px; max-width: min(900px, 80vw)">
    <a href="#" class="modal-close">×</a>
    <div class="modal-content center">

      <div class="mm60 f30 bold black flex flexcenter mb">
        <img src="<?php echo $this->get_asset('images', 'red-cross.svg'); ?>" alt="red-cross" width="110px">
        <?php _e('Restore failed', 'backup-backup') ?>
      </div>

      <div class="mm60 f22 lh28">
        <?php echo $messageRestoreError1; ?>
      </div>

      <div class="mm60 f22 mbl mtl lh28">
        <?php echo $restoreErrorInstruction; ?>
      </div>

      <div class="mm60">
        <a class="btn inline semibold mm60 f16 bmi-send-troubleshooting-logs" href="#!" target="_blank">
          <?php _e('Share debug infos with BackupBliss team', 'backup-backup') ?>
        </a>
      </div>

      <div class="mm60 f16 lh28 mtl">
        <?php echo $bmiTroubleshootingLogShareInfo; ?><br>
        <?php echo $bmiTroubleshootingLogShareInfo2; ?>
      </div>

      <div class="mm60 f18 center mb mtl">
        <a href="#" class="modal-closer text-muted" data-close="restore-error-modal"><?php _e('Close window', 'backup-backup') ?></a>
      </div>

    </div>
  </div>

</div>
