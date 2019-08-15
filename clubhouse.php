<?php

require_once 'clubhouse.civix.php';
use CRM_Clubhouse_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function clubhouse_civicrm_config(&$config) {
  _clubhouse_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function clubhouse_civicrm_xmlMenu(&$files) {
  _clubhouse_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function clubhouse_civicrm_install() {
  _clubhouse_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function clubhouse_civicrm_postInstall() {
  _clubhouse_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function clubhouse_civicrm_uninstall() {
  _clubhouse_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function clubhouse_civicrm_enable() {
  _clubhouse_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function clubhouse_civicrm_disable() {
  _clubhouse_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function clubhouse_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _clubhouse_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function clubhouse_civicrm_managed(&$entities) {
  _clubhouse_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function clubhouse_civicrm_caseTypes(&$caseTypes) {
  _clubhouse_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function clubhouse_civicrm_angularModules(&$angularModules) {
  _clubhouse_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function clubhouse_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _clubhouse_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function clubhouse_civicrm_entityTypes(&$entityTypes) {
  _clubhouse_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function clubhouse_civicrm_themes(&$themes) {
  _clubhouse_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 *
function clubhouse_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 *
function clubhouse_civicrm_navigationMenu(&$menu) {
  _clubhouse_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _clubhouse_civix_navigationMenu($menu);
} // */


function clubhouse_civicrm_alterCalculatedMembershipStatus(&$membershipStatus, $arguments, $membership) {
    // echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    // echo "<h1>Membership Status</h1>";
    // var_dump($membershipStatus);
    // echo "<h1>Arguments</h1>";
    // var_dump($arguments);
    // echo "<h1>Membership</h1>";
    // var_dump($membership);

    $result = civicrm_api3('Membership', 'get', [
      'sequential' => 1,
      'id' => $membership['membership_id']
    ]);

    // We can't do anything if the API call doesn't work.
    if ($result['is_error'] != 0) {
      return;
    }

    $membership = reset($result['values']);

    // echo "<h1>Retrieved Membership</h1>";
    // var_dump($membership);

    // If the calculated status matches the recorded status, we have nothing to report.
    // if ($membership['status_id'] == $membershipStatus['id']) {
    //   return;
    // }

    // We need to send the new status to Clubhouse so it can process it.
    $payload = array(
      'contact_id' => $membership['contact_id'],
      'membership_status' => $membershipStatus['name']
    );

    // We also need the keyfob code. Getting this is a pain.
    $result = civicrm_api3('CustomField', 'get', [
      'sequential' => 1,
      'custom_group_id' => "Member_Details",
      'name' => "Keyfob",
    ]);
    $result = reset($result['values']);
    $field_id = $result['id'];

    $result = civicrm_api3('CustomValue', 'get', [
      'sequential' => 1,
      'entity_id' => $membership['contact_id'],
      "return.custom_{$field_id}" => 1
    ]);

    $payload['keyfob_code'] = reset($result['values'])['latest'];

    // If the keyfob code hasn't been set yet, we have nothing to report.
    if (! $payload['keyfob_code']) {
      return;
    }

    echo '<h1>JSON PAYLOAD</h1>';
    var_dump($payload);
}

function clubhouse_civicrm_preProcess($formName, &$form) {
  if ($formName != 'CRM_Contact_Form_Inline_CustomData') {
    return;
  }

  var_dump($form); die;
}
