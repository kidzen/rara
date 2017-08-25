<?php

use yii\db\Migration;

class m130524_201442_init extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'naraazam',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('naraazam'),
            'email' => 'admin@rekamy.com',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->createTable('{{%account}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(20), // cash / online transfer  / cash out to bank mbb
            'payment_id' => $this->integer(),
            'date' => $this->date()->notNull(),
            'item' => $this->string(50),
            'description' => $this->text(),
            'cash_out' => $this->double(0, 2),
            'cash_in' => $this->double(0, 2),
            'notes' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
                ], $tableOptions);


        $this->createTable('{{%raw_material}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(50),
            'stock' => $this->string(50),
            'description' => $this->text(),
            'brand' => $this->string(50),
            'vendor' => $this->string(50),
            'quantity' => $this->integer(),
            'unit_price' => $this->double(0, 2),
            'notes' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
                ], $tableOptions);

        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(20), //online / walk in
            'order_no' => $this->string(50),
            'order_date' => $this->dateTime(),
            'order_by' => $this->string(50),
            'contact_refference' => $this->string(50),
            'required_date' => $this->dateTime(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
                ], $tableOptions);

        $this->createTable('{{%payment}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(20), //online / walk in
            'order_id' => $this->integer(),
            'deposit' => $this->double(0, 2),
            'deposit_date' => $this->dateTime(),
            'unit_price' => $this->double(0, 2),
            'payment_status' => $this->string(50), //paid / pending / deposited
            'full_payment_date' => $this->dateTime(),
            'description' => $this->text(),
            'notes' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
                ], $tableOptions);

        $this->addForeignKey('account_payment_id', '{{%account}}', 'payment_id', '{{%payment}}', 'id');
        $this->addForeignKey('paymend_order_id', '{{%payment}}', 'order_id', '{{%orders}}', 'id');

        $this->createTable('{{%order_items}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(), //desert / cake / mini kek
            'type' => $this->string(20), //desert / cake / mini kek
            'item' => $this->string(50),
            'description' => $this->text(),
            'quantity' => $this->integer(),
            'quantity_unit' => $this->string(10),
            'weight' => $this->integer(),
            'weight_unit' => $this->string(10),
            'size' => $this->integer(),
            'size_unit' => $this->string(10),
            'unit_price' => $this->double(0, 2),
            'time_required' => $this->time(),
            'notes' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
                ], $tableOptions);
        $this->addForeignKey('order_items_orders_id', '{{%order_items}}', 'order_id', '{{%orders}}', 'id');

        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(20), //desert / cake / mini kek / operation / 
            'stock' => $this->string(50),
            'description' => $this->text(),
            'brand' => $this->string(50),
            'vendor' => $this->string(50),
            'quantity' => $this->integer(),
            'unit_price' => $this->double(0, 2),
            'notes' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
                ], $tableOptions);

        Yii::$app->db->createCommand('INSERT INTO `raradb`.`account`
                                                (`id`,
                                                 `date`,
                                                 `item`,
                                                 `description`,
                                                 `cash_out`,
                                                 `cash_in`,
                                                 `notes`)
                                    SELECT * FROM account2;

                                    INSERT INTO `raradb`.`raw_material`
                                                (`id`,
                                                 `type`,
                                                 `stock`,
                                                 `description`,
                                                 `brand`,
                                                 `vendor`,
                                                 `quantity`,
                                                 `unit_price`,
                                                 `notes`)
                                    SELECT * FROM raw_material2;
        ')->execute();

        Yii::$app->db->createCommand(
                'CREATE VIEW account_report AS ('
                . 'SELECT'
                . '`t1`.`id` AS `id`,`t1`.`date` AS `date`,`t1`.`year` AS `year`,`t1`.`month` AS `month`'
                . ',`t1`.`item` AS `item`,IFNULL(`t1`.`cash_in`,0) AS `cash_in`,IFNULL(`t1`.`cash_out`,0) AS `cash_out`,(IFNULL(`t1`.`cash_in`,0) - IFNULL(`t1`.`cash_out`,0)) AS `margin_income`'
                . ',`t2`.`daily_cash_in` AS `daily_cash_in`,`t2`.`daily_cash_out` AS `daily_cash_out`'
                . ',`t3`.`monthly_cash_in` AS `monthly_cash_in`,`t3`'
                . '.`monthly_cash_out` AS `monthly_cash_out`,`t4`.`yearly_cash_in` AS `yearly_cash_in`,`t4`.`yearly_cash_out` AS `yearly_cash_out`'
                . ' FROM (((('
                . '(SELECT `raradb`.`account`.`id` AS `id`,`raradb`.`account`.`date` AS `date`,`raradb`.`account`.`item` AS `item`,YEAR(`raradb`.`account`.`date`) AS `year`,MONTH(`raradb`.`account`.`date`) AS `month`'
                . ',IFNULL(`raradb`.`account`.`cash_in`,0) AS `cash_in`,IFNULL(`raradb`.`account`.`cash_out`,0) AS `cash_out`,(IFNULL(`raradb`.`account`.`cash_in`,0) - IFNULL(`raradb`.`account`.`cash_out`,0)) AS `margin_income`'
                . ' FROM `raradb`.`account`)) `t1` JOIN (SELECT `raradb`.`account`.`date` AS `DATE`,SUM(`raradb`.`account`.`cash_in`) AS `daily_cash_in`,SUM(`raradb`.`account`.`cash_out`) AS `daily_cash_out`'
                . ' FROM `raradb`.`account` GROUP BY `raradb`.`account`.`date`) `t2` ON((`t2`.`DATE` = `t1`.`date`)))'
                . ' JOIN (SELECT YEAR(`raradb`.`account`.`date`) AS `YEAR`,MONTH(`raradb`.`account`.`date`) AS `MONTH`,SUM(`raradb`.`account`.`cash_in`) AS `monthly_cash_in`,SUM(`raradb`.`account`.`cash_out`) AS `monthly_cash_out`'
                . ' FROM `raradb`.`account` GROUP BY `YEAR`,`MONTH`) `t3` ON(((`t3`.`YEAR` = `t1`.`year`) AND (`t3`.`MONTH` = `t1`.`month`)))) JOIN (SELECT YEAR(`raradb`.`account`.`date`) AS `YEAR`,SUM(`raradb`.`account`.`cash_in`) AS `yearly_cash_in`,SUM(`raradb`.`account`.`cash_out`) AS `yearly_cash_out`'
                . ' FROM `raradb`.`account` GROUP BY `YEAR`) `t4` ON((`t4`.`YEAR` = `t1`.`year`))) ORDER BY `t1`.`date`,`t1`.`id`'
                . ')'
        )->execute();
    }

    public function safeDown() {
        Yii::$app->db->createCommand(
                'DROP VIEW IF EXISTS `account_report`'
        )->execute();
        $this->dropForeignKey('order_items_orders_id', '{{%order_items}}');
        $this->dropForeignKey('account_payment_id', '{{%account}}');
        $this->dropForeignKey('paymend_order_id', '{{%payment}}');
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%account}}');
        $this->dropTable('{{%raw_material}}');
        $this->dropTable('{{%payment}}');
        $this->dropTable('{{%orders}}');
        $this->dropTable('{{%order_items}}');
        $this->dropTable('{{%task}}');
    }

}
