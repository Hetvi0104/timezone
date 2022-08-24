<?php  
/**  
 * @file  
 * Contains Drupal\specbee_timezone\Form\TimezoneForm.  
 */  
namespace Drupal\specbee_timezone\Form;  
use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;  
  
class TimezoneForm extends ConfigFormBase {  
  /**  
   * {@inheritdoc}  
   */  
  protected function getEditableConfigNames() {  
    return [  
      'specbee_timezone.adminsettings',  
    ];  
  }  
  
  /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {  
    return 'timezone_form';  
  }  
  
  /**  
   * {@inheritdoc}  
   */  
  public function buildForm(array $form, FormStateInterface $form_state) {  
    $config = $this->config('specbee_timezone.adminsettings');  
  
    $form['country'] = [  
      '#type' => 'textfield',  
      '#title' => $this->t('Country'),  
      '#description' => $this->t('Please enter the name of your country'),  
      '#default_value' => $config->get('country'),  
    ];

    $form['city'] = [  
      '#type' => 'textfield',  
      '#title' => $this->t('City'),  
      '#description' => $this->t('Please enter the name of your city'),  
      '#default_value' => $config->get('city'),  
    ];
	
	$form['timezone_options'] = [
      '#type' => 'value',
      '#value' => array('Options' => t('Options in the select list'),
                    'America/Chicago' => t('America/Chicago'),
                    'America/New_York' => t('America/New York'),
					'Asia/Tokyo' => t('Asia/Tokyo'),
					'Asia/Dubai' => t('Asia/Dubai'),
					'Asia/Kolkata' => t('Asia/Kolkata'),
					'Europe/Amsterdam' => t('Europe/Amsterdam'),
					'Europe/Oslo' => t('Europe/Oslo'),
					'Europe/London' => t('Europe/London'))
    ];

    $form['timezone'] = [
      '#title' => t('Select timezone'),
      '#type' => 'select',
      '#description' => "Select the timezone.",
      '#options' => $form['timezone_options']['#value'],
	  '#default_value' => $config->get('timezone'),
    ];
  
    return parent::buildForm($form, $form_state);  
  }
  
   /**  
   * {@inheritdoc}  
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {  
    parent::submitForm($form, $form_state);  
  
    $this->config('specbee_timezone.adminsettings')  
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))	  
      ->save();  
  }  
}  