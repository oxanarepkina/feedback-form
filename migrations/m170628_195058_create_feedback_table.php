<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feedback`.
 */
class m170628_195058_create_feedback_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('feedback', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'phone' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'comment' => $this->text()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('feedback');
    }
}
