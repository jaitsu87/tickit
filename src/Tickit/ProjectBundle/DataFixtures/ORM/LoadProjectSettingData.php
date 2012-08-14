<?php

namespace Tickit\ProjectBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Tickit\ProjectBundle\Entity\ProjectSetting;


class LoadProjectSettingData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Loads default project settings into the application database
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $setting1 = new ProjectSetting();
        $setting1->setName('Auto-create code reviews on patch commits');
        $setting1->setDefaultValue('0');
        $manager->persist($setting1);

        $setting2 = new ProjectSetting();
        $setting2->setName('Maximum hours per week');
        $setting2->setDefaultValue('0');
        $manager->persist($setting2);

        //add more project settings here

        $manager->flush();
    }

    /**
     * Returns the order number for this set of fixtures
     *
     * @return int|void
     */
    public function getOrder()
    {
        return 10;
    }

}