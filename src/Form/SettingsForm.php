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
    $form['gdx_development_collector'] = [
      '#type' => 'radio',
      '#title' => $this->t('Development Mode'),
      '#description' => $this->t('Send analytics data to the development collector environment.'),
      '#default_value' => $config->get('gdx_development_collector'),
    ];
    $form['gdx_production_collector'] = [
      '#type' => 'radio',
      '#title' => $this->t('Production Mode'),
      '#description' => $this->t('Send analytics data to the production collector environment.'),
      '#default_value' => $config->get('gdx_production_collector'),
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
      ->set('gdx_development_collector', $form_state->getValue('gdx_development_collector'))
      ->set('gdx_production_collector', $form_state->getValue('gdx_production_collector'))
      ->save();
  }

}
