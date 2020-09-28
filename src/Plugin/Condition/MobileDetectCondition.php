<?php

namespace Drupal\context_mobile_condition\Plugin\Condition;

use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Mobile_Detect;

/**
 * Provides a 'Mobile Detect' condition.
 *
 * @Condition(
 *    id = "mobile_detect_condition",
 *    label = @Translation("Mobile detect condition"),
 * )
 */
class MobileDetectCondition extends ConditionPluginBase implements ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, array $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $configuration = $this->getConfiguration();
    $form['mobile_detect_condition'] = [
      '#title' => $this->t('Mobile detect'),
      '#type' => 'checkboxes',
      '#description' => $this->t('Nothing checked is samething as everything is checked.'),
      '#default_value' => isset($configuration['mobile_detect_condition']) ? $configuration['mobile_detect_condition'] : [],
      '#options' => [
        'is_mobile' => $this->t('Mobile Device'),
        'is_tablet' => $this->t('Tablet Device'),
        'is_computer' => $this->t('Computer Device'),
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->configuration['mobile_detect_condition'] = $form_state->getValue('mobile_detect_condition');
    parent::submitConfigurationForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function summary() {
    return $this->t('Select type');
  }

  /**
   * {@inheritdoc}
   */
  public function evaluate() {
    $configuration = $this->getConfiguration();
    $detector = new Mobile_Detect();
    $is_mobile = $detector->isMobile();
    $is_tablet = $detector->isTablet();
    $is_computer = !$is_mobile && !$is_tablet;

    $configuration_values = $configuration['mobile_detect_condition'];
    if (!$configuration_values['is_computer'] && !$configuration_values['is_mobile'] && !$configuration_values['is_tablet']) {
      return TRUE;
    }

    if ($configuration_values['is_computer'] && $is_computer) {
      return TRUE;
    }
    elseif ($configuration_values['is_mobile'] && $is_mobile) {
      return TRUE;
    }
    elseif ($configuration_values['is_tablet'] && $is_tablet) {
      return TRUE;
    }

    return FALSE;
  }

}
