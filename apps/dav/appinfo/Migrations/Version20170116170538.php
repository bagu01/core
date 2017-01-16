<?php

namespace OCA\dav\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170116170538 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
		$prefix = $this->connection->getPrefix();

		// install
		if (!$schema->hasTable("${prefix}properties")) {
			$table = $schema->createTable("${prefix}properties");
			$table->addOption('collate', 'utf8_bin');
			$table->addColumn('id', 'bigint', [
				'autoincrement' => true,
				'notnull' => true,
				'length' => 20,
			]);
			$table->addColumn('file_id', 'bigint', [
				'notnull' => true,
				'length' => 20,
			]);
			$table->addColumn('propertyname', 'string', [
				'notnull' => true,
				'length' => 256,
				'default' => '',
			]);
			$table->addColumn('propertyvalue', 'string', [
				'notnull' => true,
				'length' => 256,
			]);
			$table->setPrimaryKey(['id']);
			$table->addIndex(['file_id'], 'fileid_index');
		} else {
	       // Update from 9.1
			// TODO: Introduce file_id
			// TODO: drop userid and propertypath
		}

		if (!$schema->hasTable("${prefix}addressbooks")) {
			$table = $schema->createTable("${prefix}addressbooks");
			$table->addOption('collate', 'utf8_bin');
			$table->addColumn('id', 'bigint', [
				'autoincrement' => true,
				'notnull' => true,
				'length' => 20,
			]);
			$table->addColumn('principaluri', 'string', [
				'length' => 256,
			]);
			$table->addColumn('displayname', 'string', [
				'length' => 256,
			]);
			$table->addColumn('uri', 'string', [
				'length' => 256,
			]);
			$table->addColumn('description', 'string', [
				'length' => 256,
			]);
			$table->addColumn('synctoken', 'integer', [
				'notnull' => true,
				'default' => 1,
				'unsigned' =>true,
			]);
			$table->setPrimaryKey(['id']);
			$table->addUniqueIndex(['principaluri', 'uri'], 'addressbook_index');
		}

		if (!$schema->hasTable("${prefix}cards")) {
			$table = $schema->createTable("${prefix}cards");
			$table->addOption('collate', 'utf8_bin');
			$table->addColumn('id', 'bigint', [
				'autoincrement' => true,
				'notnull' => true,
				'length' => 20,
			]);
			$table->addColumn('addressbookid', 'integer', [
				'notnull' => true,
				'default' => 0,
			]);
			$table->addColumn('carddata', 'blob', [
			]);
			$table->addColumn('uri', 'string', [
				'length' => 256,
			]);
			$table->addColumn('lastmodified', 'integer', [
				'length' => 11,
				'unsigned' =>true,
			]);
			$table->addColumn('etag', 'string', [
				'length' => 32,
			]);
			$table->addColumn('size', 'integer', [
				'length' => 11,
				'notnull' => true,
				'unsigned' =>true,
			]);
		}

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
