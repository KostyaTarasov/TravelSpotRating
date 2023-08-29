<?php

/**
 * @var $message string|\Services\Message\Message
 */
if ($message instanceof \MyProject\Services\Message\Message) {
  $type = $message->getType();
  $text = $message->getText();
?>
  <div class="alert alert-<?= $type ?> notice">
    <?= $text ?>
  </div>
<?php } ?>