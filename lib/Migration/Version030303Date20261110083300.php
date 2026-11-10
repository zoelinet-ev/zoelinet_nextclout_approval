<?php

declare(strict_types=1);

/**
 * SPDX-FileCopyrightText: 2026 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\Approval\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\DB\Types;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

class Version030303Date20261110083300 extends SimpleMigrationStep {

	/**
	 * @param Closure(): ISchemaWrapper $schemaClosure
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options): ?ISchemaWrapper {
		$schema = $schemaClosure();

		if ($schema->hasTable('approval_rules')) {
			$table = $schema->getTable('approval_rules');
			if (!$table->hasColumn('notify_requester_only')) {
				$table->addColumn('notify_requester_only', Types::SMALLINT, [
					'notnull' => true,
					'default' => 0,
				]);
			}
		}

		return $schema;
	}
}
