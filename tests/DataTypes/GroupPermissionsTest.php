<?php

/**
 * Contains Tests\SmarterU\DataTypes\GroupPermissionsTest.php
 *
 * @author      Will Santanen <will.santanen@thecoresolution.com>
 * @copyright   $year$ Core Business Solutions
 * @license     ??
 * @version     $version$
 * @since       2022/07/21
 */

declare(strict_types=1);

namespace Tests\SmarterU\DataTypes;

use CBS\SmarterU\DataTypes\GroupPermissions;
use CBS\SmarterU\DataTypes\Permission;
use PHPUnit\Framework\TestCase;

/**
 * Tests SmarterU\DataTypes\GroupPermissions;
 */
class GroupPermissionsTest extends TestCase {
    /**
     * Tests agreement between getters and setters.
     */
    public function testAgreement() {
        $groupName = 'phpunit';
        $groupId = 12;

        $permissions = [
            (new Permission())
                ->setAction('Grant')
                ->setCode('MANAGE_GROUP'),
            (new Permission())
                ->setAction('Deny')
                ->setCode('CREATE_COURSE')
        ];

        $groupPermission = (new GroupPermissions())
            ->setGroupName($groupName)
            ->setPermissions($permissions);

        self::assertEquals($groupName, $groupPermission->getGroupName());
        self::assertNull($groupPermission->getGroupId());
        self::assertCount(2, $groupPermission->getPermissions());
        self::assertContains($permissions[0], $groupPermission->getPermissions());
        self::assertContains($permissions[1], $groupPermission->getPermissions());

        // Test that the mutually exclusive properties are mutually exclusive.

        $groupPermission->setGroupId($groupId);
        self::assertEquals($groupId, $groupPermission->getGroupId());
        self::assertNull($groupPermission->getGroupName());

        $groupPermission->setGroupName($groupName);
        self::assertEquals($groupName, $groupPermission->getGroupName());
        self::assertNull($groupPermission->getGroupId());
    }
}
