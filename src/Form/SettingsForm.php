<?php

namespace Drupal\gdx_analytics_drupal_snowplow\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SettingsForm.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'gdx_analytics_drupal_snowplow.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'gdx_analytics_drupal_snowplow_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('gdx_analytics_drupal_snowplow.settings');

    $form['gdx_collector_mode'] = [
      '#type' => 'radios',
      '#title' => $this->t('Select Collector Environment'),
      '#default_value' => $config->get('gdx_collector_mode'),
      '#options' => array(
        0 => $this->t(' Development'),
        1 => $this->t(' Production'),
      )
    ]; 
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('gdx_analytics_drupal_snowplow.settings')
      ->set('gdx_collector_mode', $form_state->getValue('gdx_collector_mode'))
      ->save();
  }

}
