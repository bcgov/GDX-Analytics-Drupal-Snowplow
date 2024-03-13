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
      '#type' => 'textfield',
      '#title' => $this->t('Collector Environment'),
      '#default_value' => $config->get('gdx_collector_mode'),
      '#description' => $this->t('Enter the value for the Snowplow endpoint as provided to you. Do not include "https://" or "http://"'),
      '#maxlength' => 128,
      '#size' => 60,
      '#required' => TRUE,
    ];
    $form['gdx_analytics_snowplow_script_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Snowplow tracking script URI'),
      '#default_value' => $config->get('gdx_analytics_snowplow_script_uri'),
      '#description' => $this->t('Enter the URL of the Snowplow Library as provided to you. This should be a full URL including "https://" or "http://"'),
      '#maxlength' => 256,
      '#size' => 60,
      '#required' => TRUE,
    ];
    $form['gdx_analytics_app_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('App ID'),
      '#default_value' => $config->get('gdx_analytics_app_id'),
      '#description' => $this->t('Enter the value of the App ID for your site as provided to you.'),
      '#maxlength' => 256,
      '#size' => 60,
      '#required' => TRUE,
    ];
    $form['gdx_analytics_search_path'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search Path'),
      '#default_value' => $config->get('gdx_analytics_search_path'),
      '#description' => $this->t('If you are using a search module other than Standard Search, change this search path to the path you require.'),
      '#maxlength' => 256,
      '#size' => 60,
      '#required' => TRUE,
    ];
    $form['gdx_analytics_snowplow_version'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Snowplow Search Event'),
      '#default_value' => $config->get('gdx_analytics_snowplow_version'),
      '#description' => $this->t('If checked, Snowplow will track the searches performed on the website.'),
      '#size' => 60,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    // Validate the search path to ensure it starts with '/'.
    $search_path = $form_state->getValue('gdx_analytics_search_path');
    if (!empty($search_path) && substr($search_path, 0, 1) !== '/') {
      $form_state->setErrorByName('gdx_analytics_search_path', $this->t('The Search Route must start with "/".'));
    }

    // Validate the Snowplow tracking script URI to ensure it's a complete URL with 'http://' or 'https://'.
    $script_uri = $form_state->getValue('gdx_analytics_snowplow_script_uri');
    if (!empty($script_uri) && !filter_var($script_uri, FILTER_VALIDATE_URL) && substr($script_uri, 0, 1) !== 'http') {
      $form_state->setErrorByName('gdx_analytics_snowplow_script_uri', $this->t('The Snowplow tracking script URI must be a complete URL starting with "http://" or "https://".'));
    }

    // Validate the collector mode to ensure it doesn't start with 'http://' or 'https://'.
    $collector_mode = $form_state->getValue('gdx_collector_mode');
    if (!empty($collector_mode) && (strpos($collector_mode, 'http://') === 0 || strpos($collector_mode, 'https://') === 0)) {
      $form_state->setErrorByName('gdx_collector_mode', $this->t('The Collector Environment should not include "http://" or "https://".'));
    }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    try {
      // Save the form values to configuration.
      $this->config('gdx_analytics_drupal_snowplow.settings')
        ->set('gdx_collector_mode', $form_state->getValue('gdx_collector_mode'))
        ->set('gdx_analytics_snowplow_version', $form_state->getValue('gdx_analytics_snowplow_version'))
        ->set('gdx_analytics_snowplow_script_uri', $form_state->getValue('gdx_analytics_snowplow_script_uri'))
        ->set('gdx_analytics_app_id', $form_state->getValue('gdx_analytics_app_id'))
        ->set('gdx_analytics_search_path', $form_state->getValue('gdx_analytics_search_path'))
        ->save();

      // Drupal will provide "The configuration options have been saved." message.
    }
    catch (\Exception $e) {
      // Log the exception and display a message.
      \Drupal::logger('gdx_analytics_drupal_snowplow')->error('An error occurred while saving settings: @message', ['@message' => $e->getMessage()]);
      $this->messenger()->addError($this->t('An error occurred while saving settings.'));
    }
  }

}
