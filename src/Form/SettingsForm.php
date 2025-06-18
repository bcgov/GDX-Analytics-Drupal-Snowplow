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
      '#required' => true,
    ]; 
    $form['gdx_analytics_snowplow_script_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Snowplow tracking script URI'),
      '#default_value' => $config->get('gdx_analytics_snowplow_script_uri'),
      '#description' => $this->t('Enter the URL of the Snowplow Library as provided to you. This should be a full URL including "https://" or "http://"'),
      '#maxlength' => 256,
      '#size' => 60,
      '#required' => true,
    ];
    $form['gdx_analytics_app_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('App ID'),
      '#default_value' => $config->get('gdx_analytics_app_id'),
      '#description' => $this->t('Enter the value of the App ID for your site as provided to you.'),
      '#maxlength' => 256,
      '#size' => 60,
      '#required' => true,
    ];
    $form['gdx_analytics_search_path'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search Path'),
      '#default_value' => $config->get('gdx_analytics_search_path'),
      '#description' => $this->t('Enter the search path(s) required for your search module. Multiple paths can be separated by commas.'),
      '#maxlength' => 256,
      '#size' => 60,
      '#required' => true,
    ];
    $form['gdx_analytics_search_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search Key'),
      '#default_value' => $config->get('gdx_analytics_search_key'),
      '#description' => $this->t('Enter the search key required for your search module.'),
      '#maxlength' => 256,
      '#size' => 60,
      '#required' => true,
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

    // Validate the search path to ensure each path starts with '/' and contains valid characters.
    $search_path = trim($form_state->getValue('gdx_analytics_search_path'));
    if (!empty($search_path)) {
      // Split search paths, remove whitespace and delete empty paths
      $paths = array_filter(array_map('trim', explode(',', $search_path)));
      // Define regex pattern for valid URL paths.
      $valid_url_path_regex = '/^\/[a-zA-Z0-9\-\._~\/]*$/';
      // Check each path for validity.
      foreach ($paths as $path) {
        // Check for invalid paths and set error message.
        if (!preg_match($valid_url_path_regex, $path)) {
          $error_message = $this->t('Each search route must start with "/" and contain only valid URL characters. Invalid path: %path', ['%path' => $path]);
          $form_state->setErrorByName('gdx_analytics_search_path', $error_message);
          break;
        }
      }
    }

    // Validate search key to ensure it is not empty and contain valid characters
    $search_key = trim($form_state->getValue('gdx_analytics_search_key'));
    $valid_key_regex = '/^[a-zA-Z0-9_-]+$/';
    if (empty($search_key) || !preg_match($valid_key_regex, $search_key)) {
      $form_state->setErrorByName(
        'gdx_analytics_search_key',
        $this->t('Search key cannot be empty and must contain valid characters.')
      );
    }

    // Validate the Snowplow tracking script URI to ensure it's a complete URL with 'http://' or 'https://'.
    $script_uri = $form_state->getValue('gdx_analytics_snowplow_script_uri');
    if (!empty($script_uri) && !filter_var($script_uri, FILTER_VALIDATE_URL) && substr($script_uri, 0, 1) !== 'http') {
      $form_state->setErrorByName('gdx_analytics_snowplow_script_uri', $this->t('The Snowplow tracking script URI must be a complete URL starting with "http://" or "https://".'));
    }

    // Validate the collector environment to ensure it is a valid domain without 'http://' or 'https://'.
    $collector_mode = $form_state->getValue('gdx_collector_mode');
    if (!empty($collector_mode) && !filter_var($collector_mode, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
      $form_state->setErrorByName('gdx_collector_mode', $this->t('The Collector Environment should be a valid domain (must start with an alphanumeric character and contain only alphanumerics or hyphens) without "http://" or "https://".'));
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
        ->set('gdx_analytics_search_key', $form_state->getValue('gdx_analytics_search_key'))
        ->save();
      
      // Drupal will provide "The configuration options have been saved." message

    } catch (\Exception $e) {
      // Log the exception and display a message
      \Drupal::logger('gdx_analytics_drupal_snowplow')->error('An error occurred while saving settings: @message', ['@message' => $e->getMessage()]);
      $this->messenger()->addError($this->t('An error occurred while saving settings.'));
    }
  }
}
