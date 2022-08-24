<?php

namespace Drupal\specbee_timezone\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "timezone_block",
 *   admin_label = @Translation("Timezone Block"),
 * )
 */
class timezone_block extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
	 $config = \Drupal::config('specbee_timezone.adminsettings');
	 $country = $config->get('country');
	 $city = $config->get('city');
	 $timezone = $config->get('timezone');
	 $current_timestamp = \Drupal::time()->getCurrentTime();    
	 $date = \Drupal::service('date.formatter')->format($current_timestamp, 'custom', 'dS M Y - h:i A', $timezone);
     //print_r($country);exit;
    return [
      '#theme' => 'specbee_timezone',
	  '#country' => $country,
      '#city' => $city,
      '#date' => $date
    ];
  }
  
  /**
   * @return int
   */
  public function getCacheMaxAge() {
    return 0;
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['my_block_settings'] = $form_state->getValue('my_block_settings');
  }
}