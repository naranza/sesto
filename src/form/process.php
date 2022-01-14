<?php
/* =============================================================================
 * Naranza Sesto <http://sesto.naranza.com>
 * Copyright (c) 2009-20 Andrea Davanzo
 * License BSD 3-clause. See the LICENSE file distributed with this source code.
 * ========================================================================== */

declare(strict_types = 1);

require_once SESTO_DIR . '/form/filter.php';
require_once SESTO_DIR . '/form/validate.php';

function sesto_form_process(array $description, array $input, array $context = []): array
{
  $missing = [];
  $errors = [];
  $cleaned = [];
  $processed = $input;
  /* cleaning */
  foreach (array_keys($processed) as $field) {
    if (!isset($description[$field])) {
      $cleaned[$field] = $processed[$field];
      unset($processed[$field]);
    }
  }

  $autofilled = [];
  foreach ($description as $field => $data) {
    $field_exists = array_key_exists($field, $processed);
    $field_required = $data['required'] ?? true;
    $autofilled[$field] = false;

    /* filling */
    if ((bool) ($data['autofill'] ?? false)) {
      if ($field_exists) {
        $processed[$field] = $processed[$field];
      } else {
        $processed[$field] = false;
        $autofilled[$field] = true;
      }
      $field_exists = true;
    }

    /* compose */
    if ('' !== ($data['composed_as'] ?? '')) {
      $processed[$field] = $data['composed_as'];
      foreach($data['composed_by'] ?? [] as $composed_field) {
        $processed[$field] = str_replace(
          '{' . $composed_field . '}',
          (array_key_exists($composed_field, $processed) ? $processed[$composed_field] : ''),
          $processed[$field]);
      }
      $field_exists = true;
    }

    $field_empty = $field_exists ? '' == $processed[$field] : false;
    /* filter */
    if ($field_exists) {
      if ([] !== ($data['filters_if_empty'] ?? []) && $field_empty) {
        $index = 'filters_if_empty';
      } else {
        $index = 'filters';
      }
      $processed[$field] = sesto_form_filter($data[$index] ?? [], $processed[$field]);
    }
    /* missing and errors */
    if ($autofilled[$field] && $field_required) {
      /* missing */
      $missing[$field] = $data['missing_message'] ?? 'Missing field';
    } else if ($field_exists) {
      /* validate */
      if (null !== ($data['rules_if_empty'] ?? null) && $field_empty) {
        $index = 'rules_if_empty';
      } else {
        $index = 'rules';
      }
      if((!$field_required && !$field_empty) || $field_required) {
        $error = sesto_form_validate(
          $data[$index] ?? [],
          $processed[$field],
          array_merge(
            [ 'input' => $input, 'processed' => $processed ],
            $context)
          );
        if ('' !== $error) {
          $errors[$field] = $error;
        }
      }
    }
  }
  return [$missing, $errors, $processed, $cleaned];
}

