<?php

namespace Eni\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eni\MainBundle\Entity\Promotion;

class LoadPromotionData extends AbstractFixture implements OrderedFixtureInterface {

	public function getOrder() {
		return 1;
	}

	public function load(ObjectManager $oManager) {
		$oPromotion1 = new Promotion();
		$oPromotion1->setLibelle('CDI8');
		$oManager->persist($oPromotion1);
		$this->addReference('promotion-CDI8', $oPromotion1);

		$oPromotion2 = new Promotion();
		$oPromotion2->setLibelle('CDI9');
		$oManager->persist($oPromotion2);
		$this->addReference('promotion-CDI9', $oPromotion2);

		$oManager->flush();
	}
}
